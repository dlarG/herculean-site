<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('student.dashboard');
        }

        return view('student.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'student_number' => 'required|string',
            'password'       => 'required|string',
        ]);

        if (Auth::guard('student')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $student = Auth::guard('student')->user();

            // Force password change on first login
            if ($student->must_change_password) {
                return redirect()->route('student.password.change');
            }

            return redirect()->intended(route('student.dashboard'));
        }

        return back()
            ->withErrors(['student_number' => 'Invalid student number or password.'])
            ->onlyInput('student_number');
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }

    public function showChangePasswordForm()
    {
        $student = Auth::guard('student')->user();

        return view('student.auth.change-password', compact('student'));
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password'         => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $student = Auth::guard('student')->user();

        if (!Hash::check($validated['current_password'], $student->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $student->password = $validated['password'];
        $student->must_change_password = false;
        $student->save();

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Password updated successfully. Welcome!');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CoachAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('coach')->check()) {
            return redirect()->route('coach.dashboard');
        }

        return view('coach.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('coach')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $coach = Auth::guard('coach')->user();

            if ($coach->must_change_password) {
                return redirect()->route('coach.password.change');
            }

            return redirect()->intended(route('coach.dashboard'));
        }

        return back()
            ->withErrors(['username' => 'Invalid username or password.'])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('coach')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('coach.login');
    }

    public function showChangePasswordForm()
    {
        return view('coach.auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password'         => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $coach = Auth::guard('coach')->user();

        if (!Hash::check($validated['current_password'], $coach->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $coach->password = $validated['password'];
        $coach->must_change_password = false;
        $coach->save();

        return redirect()
            ->route('coach.dashboard')
            ->with('success', 'Password updated successfully. Welcome!');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'required|string',
        ]);

        if (Auth::guard('student')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

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
}

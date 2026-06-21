<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // تثبيت السيشن
        $request->session()->regenerate();

        // جلب المستخدم بعد تسجيل الدخول
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        // توجيه المستخدم بناءً على الرتبة
        $role = $user->role;

        if ($role === 'admin') {
            return redirect('/index-2');
        }

        if ($role === 'doctor') {
            return redirect('/doctor');
        }

        if ($role === 'patient') {
            return redirect('/patient');
        }

        // المسار الافتراضي في حال عدم وجود رتبة محددة
        return redirect('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
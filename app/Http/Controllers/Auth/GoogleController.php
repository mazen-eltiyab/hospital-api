<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // خطوة 1: تحويل المستخدم لـ Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // خطوة 2: استقبال البيانات من Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(uniqid()), // كلمة مرور عشوائية
                    'role' => 'patient', // Force role to patient
                ]
            );

            Auth::login($user, true);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login failed!');
        }
    }

    public function apiVerifyGoogle(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => bcrypt(uniqid()), 
                'role' => 'patient', 
            ]
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Google login successful',
            'access_token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ], 200);
    }
}

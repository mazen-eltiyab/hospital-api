<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,doctor,patient',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Create specific profile based on role
        if ($request->role === 'doctor') {
            Doctor::create([
                'first_name' => $request->name,
                'username' => $request->name . rand(100, 999),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
            ]);
        } elseif ($request->role === 'patient') {
            Patient::create([
                'first_name' => $request->name,
                'username' => $request->name . rand(100, 999),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['بيانات الدخول غير صحيحة'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $profileImageUrl = null;
        if ($user->role === 'doctor') {
            $avatar = \App\Models\Doctor::where('email', $user->email)->value('avatar');
        } elseif ($user->role === 'patient') {
            $avatar = \App\Models\Patient::where('email', $user->email)->value('avatar');
        }

        if (!empty($avatar)) {
            $profileImageUrl = \Illuminate\Support\Str::startsWith($avatar, ['http://', 'https://']) ? $avatar : asset('storage/' . $avatar);
        }

        $user->profile_image_url = $profileImageUrl;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'تم تسجيل الخروج بنجاح'
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $profileImageUrl = null;
        if ($user->role === 'doctor') {
            $avatar = \App\Models\Doctor::where('email', $user->email)->value('avatar');
        } elseif ($user->role === 'patient') {
            $avatar = \App\Models\Patient::where('email', $user->email)->value('avatar');
        }

        if (!empty($avatar)) {
            $profileImageUrl = \Illuminate\Support\Str::startsWith($avatar, ['http://', 'https://']) ? $avatar : asset('storage/' . $avatar);
        }

        $user->profile_image_url = $profileImageUrl;

        return response()->json([
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = clone $request->user(); 
        $userModel = User::find($user->id);

        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->has('name')) {
            $userModel->name = $request->name;
        }

        $userModel->save();

        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
            $imageUrl = asset('storage/' . $imagePath);
        }

        // Update the specific role profile as well
        if ($userModel->role === 'doctor') {
            $doctor = Doctor::where('email', $userModel->email)->first();
            if ($doctor) {
                if ($request->has('name')) {
                    $doctor->first_name = $request->name;
                }
                if ($request->has('phone')) {
                    $doctor->phone = $request->phone;
                }
                if (isset($imageUrl)) {
                    $doctor->avatar = $imageUrl;
                }
                $doctor->save();
            }
        } elseif ($userModel->role === 'patient') {
            $patient = Patient::where('email', $userModel->email)->first();
            if ($patient) {
                if ($request->has('name')) {
                    $patient->first_name = $request->name;
                }
                if ($request->has('phone')) {
                    $patient->phone = $request->phone;
                }
                if (isset($imageUrl)) {
                    $patient->avatar = $imageUrl;
                }
                $patient->save();
            }
        }

        // Add profile_image to user object dynamically so the frontend receives it
        $userModel->profile_image_url = isset($imageUrl) ? $imageUrl : null;

        return response()->json([
            'message' => 'تم تحديث الملف الشخصي بنجاح',
            'user' => $userModel
        ]);
    }
}

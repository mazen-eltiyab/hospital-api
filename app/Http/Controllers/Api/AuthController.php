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

        // Create specific profile based on role using Mina's schema
        if ($request->role === 'doctor') {
            Doctor::create([
                'user_id' => $user->id,
                'experience' => $request->experience ?? 0,
                'firstname' => $request->name,
                'username' => $request->name . rand(100, 999),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
            ]);
        }
        // Patient profile creation is handled automatically by User::booted() observer in User.php

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
                    $doctor->firstname = $request->name;
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
                    $patient->firstname = $request->name;
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

    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|in:ar,en',
        ]);

        $user = $request->user();
        $userModel = User::find($user->id);
        $userModel->preferred_language = $request->language;
        $userModel->save();

        return response()->json([
            'message' => 'تم تحديث لغة التطبيق بنجاح',
            'language' => $request->language
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999);

        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $otp,
                'created_at' => now()
            ]
        );

        // TODO: Send OTP via Email. Returning it in response for testing.
        return response()->json([
            'message' => 'تم إرسال رمز التحقق إلى بريدك الإلكتروني',
            'test_otp' => $otp // Remove this in production
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|min:4'
        ]);

        $record = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'رمز التحقق غير صحيح أو منتهي الصلاحية'], 400);
        }

        return response()->json(['message' => 'رمز التحقق صحيح']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|min:4',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $record = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'رمز التحقق غير صحيح أو منتهي الصلاحية'], 400);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Update Doctor or Patient profile password as well
        if ($user->role === 'doctor') {
            Doctor::where('email', $user->email)->update(['password' => $user->password]);
        } elseif ($user->role === 'patient') {
            Patient::where('email', $user->email)->update(['password' => $user->password]);
        }

        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => 'تم إعادة تعيين كلمة المرور بنجاح']);
    }
}

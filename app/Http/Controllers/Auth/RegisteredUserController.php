<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient; // تأكد من استدعاء موديل المريض لو احتجته
use App\Models\Doctor;  // تأكد من استدعاء موديل الدكتور
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. التحقق من صحة البيانات (إضافة الـ age والـ phone للـ Validation)
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone'    => ['nullable', 'string', 'max:20'], // حقل الموبايل
            'age'      => ['required', 'integer', 'min:1', 'max:120'], // حقل السن
        ]);

        // 2. إنشاء المستخدم في جدول users
        $user = new User();
        $user->name     = $request->name;
        $user->email    = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->role     = 'patient'; 
        $user->save();

        /**
         * ملاحظة هامة: 
         * الـ Age والـ Phone هيتخزنوا في جدول الـ Patients 
         * أوتوماتيكياً عن طريق الـ booted() method الموجودة في موديل User.php
         * لأنها بتسحب البيانات من الـ Request الحالي باستخدام request('phone') و request('age')
         */

        // 3. إطلاق حدث التسجيل
        event(new Registered($user));

        // 4. تسجيل الدخول
        Auth::login($user);

        // 5. التوجيه (تأكد من وجود route بهذا الاسم أو غيره لـ /dashboard)
        return redirect()->route('patient.index');
    }
}
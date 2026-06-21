<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; // تأكد أن هذا السطر موجود في أعلى الملف

class SetLocale
{
    // قمنا بإضافة Request لتحديد نوع المتغير وحل المشكلة
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale') && in_array(session()->get('locale'), ['en', 'ar'])) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale('en'); // اللغة الافتراضية للموقع
        }
        
        return $next($request);
    }
}
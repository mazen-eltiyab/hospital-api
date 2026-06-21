<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // دالة العرض - هي دي اللي كانت ناقصة أو مش مقروءة
    public function index()
    {
        $setting = Setting::first(); 
        return view('settings.index', compact('setting'));
    }

    // دالة الحفظ
    public function store(Request $request)
    {
        $setting = Setting::first();

        if ($setting) {
            $setting->update($request->all());
        } else {
            Setting::create($request->all());
        }

        return redirect()->back();
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request, $lang)
    {
        // بنتأكد إن اللغة مدعومة بس
        $supported = ['en', 'ar'];
        
        if (in_array($lang, $supported)) {
            session(['locale' => $lang]);
        }

        return redirect()->back();
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        return view('frontend.index'); // صفحة الهوم
    }

    public function about() {
        return view('frontend.about'); // صفحة من نحن
    }

    public function contact() {
        return view('frontend.contact'); // صفحة اتصل بنا
    }

    public function services() {
        return view('frontend.services');
    }

    public function doctors() {
        
        return view('frontend.doctors');
    }
}
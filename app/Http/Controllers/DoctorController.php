<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    // عرض كل الدكاترة
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    // فتح صفحة إضافة دكتور جديد
    public function create()
    {
        return view('doctors.create');
    }

    // حفظ الدكتور في الداتا بيز (دي اللي كانت ناقصة عندك)
    public function store(Request $request)
    {
        Doctor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // تشفير الباسورد
            'phone' => $request->phone,
            'status' => 1,
        ]);

        return redirect()->route('doctors.index');
    }

    // ==========================================
    // هنا بيبدأ "رقم واحد" اللي كنت بتسأل عليه (جزء التعديل والمسح)
    // ==========================================

    // فتح صفحة تعديل بيانات دكتور معين
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id); 
        return view('doctors.edit', compact('doctor'));
    }

    // حفظ التعديلات الجديدة في الداتا بيز
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        
        // تحديث البيانات
        $doctor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('doctors.index');
    }

    // مسح الدكتور من الداتا بيز
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctors.index');
    }
}
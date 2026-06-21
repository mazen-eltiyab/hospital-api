<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    // عرض المرضى
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    // صفحة الإضافة
    public function create()
    {
        return view('patients.create');
    }

    // حفظ المريض في الداتا بيز
    public function store(Request $request)
    {
        Patient::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 1,
        ]);

        return redirect()->route('patients.index');
    }

    // صفحة التعديل
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    // حفظ التعديل
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('patients.index');
    }

    // مسح المريض
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('patients.index');
    }
}
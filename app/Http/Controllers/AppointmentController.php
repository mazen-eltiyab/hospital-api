<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;

class AppointmentController extends Controller
{
    // 1. عرض المواعيد
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient'])->get();
        return view('appointments.index', compact('appointments'));
    }

    // 2. صفحة الإضافة
    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('appointments.create', compact('doctors', 'patients'));
    }

    // 3. حفظ الموعد الجديد
    public function store(Request $request)
    {
        $lastAppointment = Appointment::orderBy('id', 'desc')->first();
        $nextId = $lastAppointment ? $lastAppointment->id + 1 : 1;
        $apt_id = 'APT-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        Appointment::create([
            'appointment_id' => $apt_id,
            'patient_id' => $request->patient_id,
            'department' => $request->department,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'patient_email' => $request->patient_email,
            'patient_phone' => $request->patient_phone,
            'message' => $request->message,
            'status' => 1,
        ]);

        return redirect()->route('appointments.index');
    }

    // ==========================================
    // هنا الدالتين الجداد بتوع التعديل اللي كنت بتسأل عليهم
    // ==========================================

    // 4. صفحة تعديل الموعد
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    // 5. حفظ تعديلات الموعد
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        
        $appointment->update([
            'patient_id' => $request->patient_id,
            'department' => $request->department,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'patient_email' => $request->patient_email,
            'patient_phone' => $request->patient_phone,
            'message' => $request->message,
        ]);

        return redirect()->route('appointments.index');
    }

    // ==========================================

    // 6. مسح الموعد
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('appointments.index');
    }
}
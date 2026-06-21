<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();
        if ($user->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $doctor = Doctor::where('email', $user->email)->first();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('prescriptions', 'public');
        }

        $prescription = Prescription::create([
            'doctor_id' => $doctor ? $doctor->id : null,
            'patient_id' => $request->patient_id,
            'notes' => $request->notes,
            'image' => $imagePath ? url('storage/' . $imagePath) : null,
        ]);

        // إضافة إشعار للمريض
        DB::table('notifications')->insert([
            'doctor_id' => $doctor ? $doctor->id : null,
            'patient_id' => $request->patient_id,
            'title' => 'روشتة جديدة',
            'message' => 'لقد أرسل لك الدكتور ' . ($doctor ? $doctor->first_name : '') . ' روشتة طبية جديدة.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'تم إرسال الروشتة بنجاح',
            'prescription' => $prescription
        ], 201);
    }

    public function myPrescriptions(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'patient') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $patient = \App\Models\Patient::where('email', $user->email)->first();
        if (!$patient) {
            return response()->json(['status' => 'success', 'data' => []]);
        }

        $prescriptions = Prescription::where('patient_id', $patient->id)
            ->with('doctor')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($prescription) {
                return [
                    'id' => $prescription->id,
                    'notes' => $prescription->notes,
                    'image_url' => $prescription->image,
                    'doctor_name' => $prescription->doctor ? 'Dr. ' . $prescription->doctor->first_name . ' ' . $prescription->doctor->last_name : 'Unknown Doctor',
                    'created_at' => $prescription->created_at->format('M d, Y h:i A'),
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $prescriptions
        ]);
    }
}

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
            'image_path' => $imagePath ? url('storage/' . $imagePath) : null,
        ]);

        // إضافة إشعار للمريض
        DB::table('notifications')->insert([
            'id' => \Illuminate\Support\Str::uuid()->toString(),
            'type' => 'App\Notifications\NewPrescription',
            'notifiable_type' => 'App\Models\Patient',
            'notifiable_id' => $request->patient_id,
            'data' => json_encode([
                'title' => 'روشتة جديدة',
                'message' => 'لقد أرسل لك الدكتور ' . ($doctor ? $doctor->firstname : '') . ' روشتة طبية جديدة.',
                'doctor_id' => $doctor ? $doctor->id : null,
                'doctor_name' => $doctor ? $doctor->firstname . ' ' . $doctor->lastname : 'Doctor',
            ]),
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
            ->get()
            ->map(function ($prescription) {
                return [
                    'id' => 'p_' . $prescription->id,
                    'notes' => $prescription->notes,
                    'image_url' => $prescription->image_path,
                    'doctor_name' => $prescription->doctor ? 'Dr. ' . $prescription->doctor->firstname . ' ' . $prescription->doctor->lastname : 'Unknown Doctor',
                    'created_at' => $prescription->created_at->format('M d, Y h:i A'),
                    'timestamp' => $prescription->created_at->timestamp,
                ];
            });

        $reports = \App\Models\MedicalReport::where('patient_id', $patient->id)
            ->with('doctor')
            ->get()
            ->map(function ($report) {
                return [
                    'id' => 'r_' . $report->id,
                    'notes' => $report->report_content,
                    'image_url' => $report->file_path ? url('storage/' . $report->file_path) : null,
                    'doctor_name' => $report->doctor ? 'Dr. ' . $report->doctor->firstname . ' ' . $report->doctor->lastname : 'Unknown Doctor',
                    'created_at' => $report->created_at->format('M d, Y h:i A'),
                    'timestamp' => $report->created_at->timestamp,
                ];
            });

        $allData = $prescriptions->concat($reports)->sortByDesc('timestamp')->values()->all();

        return response()->json([
            'status' => 'success',
            'data' => $allData
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $user = $request->user();
        if ($user->role !== 'patient') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $patient = Patient::where('email', $user->email)->first();

        $appointment = Appointment::create([
            'appointment_id' => 'APT-' . strtoupper(uniqid()),
            'doctor_id' => $request->doctor_id,
            'patient_id' => $patient ? $patient->id : null,
            'appointment_date' => $request->date,
            'appointment_time' => $request->time,
            'status' => 0, // Pending
        ]);

        return response()->json([
            'message' => 'تم الحجز بنجاح',
            'appointment' => $appointment
        ], 201);
    }

    public function myPatients(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $doctor = Doctor::where('email', $user->email)->first();

        if (!$doctor) {
            return response()->json(['patients' => []]);
        }

        // Fetch patients that have appointments with this doctor
        $patients = Patient::whereHas('appointments', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })->get();

        return response()->json([
            'patients' => $patients
        ]);
    }

    public function myAppointments(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'patient') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $patient = Patient::where('email', $user->email)->first();
        if (!$patient) {
            return response()->json(['status' => 'success', 'data' => []]);
        }

        $appointments = Appointment::where('patient_id', $patient->id)
            ->with('doctor')
            ->orderBy('appointment_date', 'asc')
            ->get()
            ->map(function ($app) use ($patient) {
                $rating = \DB::table('ratings')
                    ->where('patient_id', $patient->id)
                    ->where('doctor_id', $app->doctor_id)
                    ->first();

                return [
                    'id' => $app->id,
                    'doctor_name' => $app->doctor ? 'Dr. ' . $app->doctor->first_name . ' ' . $app->doctor->last_name : 'Unknown Doctor',
                    'specialty' => $app->doctor ? $app->doctor->speciality : 'General',
                    'date' => $app->appointment_date,
                    'time' => $app->appointment_time,
                    'status' => $app->status == 1 ? 'CONFIRMED' : 'PENDING',
                    'profile_image_url' => $app->doctor && $app->doctor->avatar ? (\Illuminate\Support\Str::startsWith($app->doctor->avatar, ['http://', 'https://']) ? $app->doctor->avatar : asset('storage/' . $app->doctor->avatar)) : null,
                    'doctorId' => $app->doctor_id,
                    'userRating' => $rating ? $rating->stars : null,
                    'userReview' => $rating ? $rating->comment : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ]);
    }
}

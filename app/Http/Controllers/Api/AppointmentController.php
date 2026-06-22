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
        if ($user->role !== 'patient' && $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($user->role === 'admin') {
            // Admin can pass patient_id (from patients table) or user_id (from users table)
            $patient = null;
            if ($request->filled('patient_id')) {
                // Try to find by patients.id directly
                $patient = Patient::find($request->patient_id);
                if (!$patient) {
                    // Try to find by user_id (users table id)
                    $patientUser = \App\Models\User::find($request->patient_id);
                    if ($patientUser) {
                        $patient = Patient::where('email', $patientUser->email)->first();
                        if (!$patient) {
                            // Create patient record linked to this user
                            $nameParts = explode(' ', $patientUser->name, 2);
                            $patient = Patient::create([
                                'user_id'   => $patientUser->id,
                                'firstname' => $nameParts[0] ?? $patientUser->name,
                                'lastname'  => $nameParts[1] ?? '',
                                'email'     => $patientUser->email,
                                'avatar'    => '',
                            ]);
                        }
                    }
                }
            }
            if (!$patient) {
                return response()->json(['message' => 'Patient not found'], 422);
            }
        } else {
            $patient = Patient::where('email', $user->email)->first();
        }

        $doctor = Doctor::find($request->doctor_id);

        $appointment = Appointment::create([
            'doctor_id'        => $request->doctor_id,
            'patient_id'       => $patient ? $patient->id : null,
            'appointment_date' => $request->date,
            'start_time'       => $request->time,
            'status'           => 'Pending',
            'patient_name'     => $patient ? trim($patient->firstname . ' ' . $patient->lastname) : 'Unknown',
            'doctor_name'      => $doctor ? trim($doctor->firstname . ' ' . ($doctor->lastname ?? '')) : 'Unknown',
            'department'       => $doctor ? ($doctor->speciality ?? 'General') : 'General',
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

        // Fetch appointments for this doctor with patient details
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->with('patient')
            ->orderBy('appointment_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get()
            ->map(function ($app) {
                return [
                    'id' => $app->patient_id, // Keep ID as patient ID for prescriptions
                    'appointment_id' => $app->id,
                    'first_name' => $app->patient ? $app->patient->firstname : $app->patient_name,
                    'last_name' => $app->patient ? $app->patient->lastname : '',
                    'avatar' => $app->patient ? $app->patient->avatar : null,
                    'date' => $app->appointment_date,
                    'time' => $app->start_time,
                    'status' => strtolower($app->status) === 'confirmed' || strtolower($app->status) === 'completed' || $app->status === '1' || $app->status === 1 ? 'Confirmed' : (strtolower($app->status) === 'done' ? 'Done' : 'Upcoming'),
                ];
            });

        return response()->json([
            'patients' => $appointments
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
                // Calculate how many patients are ahead for the same doctor, on the same day, before this appointment's time
                $patientsAhead = Appointment::where('doctor_id', $app->doctor_id)
                    ->where('appointment_date', $app->appointment_date)
                    ->where('start_time', '<', $app->start_time)
                    ->count();

                return [
                    'id' => $app->id,
                    'doctor_name' => $app->doctor ? 'Dr. ' . $app->doctor->firstname . ' ' . $app->doctor->lastname : 'Unknown Doctor',
                    'specialty' => $app->doctor ? $app->doctor->speciality : 'General',
                    'date' => $app->appointment_date,
                    'time' => $app->start_time,
                    'status' => strtolower($app->status) === 'confirmed' || strtolower($app->status) === 'completed' || $app->status === 1 || $app->status === '1' ? 'CONFIRMED' : 'PENDING',
                    'profile_image_url' => $app->doctor && $app->doctor->avatar ? (\Illuminate\Support\Str::startsWith($app->doctor->avatar, ['http://', 'https://']) ? $app->doctor->avatar : asset('storage/' . $app->doctor->avatar)) : null,
                    'doctorId' => $app->doctor_id,
                    'userRating' => $rating ? $rating->stars : null,
                    'userReview' => $rating ? $rating->comment : null,
                    'patientsAhead' => $patientsAhead,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:appointments,id',
            'status' => 'required|in:Pending,Confirmed,Cancelled,Done,Upcoming'
        ]);

        $appointment = Appointment::find($request->id);
        if ($appointment) {
            $appointment->status = $request->status;
            $appointment->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status updated successfully',
                'data' => $appointment
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Appointment not found'
        ], 404);
    }
}

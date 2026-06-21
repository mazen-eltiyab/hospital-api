<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Doctor;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'patient') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $patient = Patient::where('email', $user->email)->first();
        if (!$patient) {
            return response()->json(['notifications' => []]);
        }

        $notifications = Notification::where('patient_id', $patient->id)
            ->with('doctor')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'notifications' => $notifications
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

        $user = $request->user();
        if ($user->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $doctor = Doctor::where('email', $user->email)->first();

        $notification = Notification::create([
            'doctor_id' => $doctor ? $doctor->id : null,
            'patient_id' => $request->patient_id,
            'title' => $request->title,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'تم إرسال الإشعار بنجاح',
            'notification' => $notification
        ]);
    }
}

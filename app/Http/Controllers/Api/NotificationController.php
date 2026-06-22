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
        
        if ($user->role === 'admin') {
            $notifications = \Illuminate\Support\Facades\DB::table('notifications')
                ->where('notifiable_id', $user->id)
                ->where('notifiable_type', 'App\Models\User')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($n) {
                    $data = json_decode($n->data, true);
                    return [
                        'id' => $n->id,
                        'title' => $data['title'] ?? 'Notification',
                        'message' => $data['message'] ?? '',
                        'type' => $data['type'] ?? 'system',
                        'date' => $n->created_at,
                    ];
                });
            return response()->json(['notifications' => $notifications]);
        }

        if ($user->role !== 'patient') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $patient = Patient::where('email', $user->email)->first();
        if (!$patient) {
            return response()->json(['notifications' => []]);
        }

        $notifications = \Illuminate\Support\Facades\DB::table('notifications')
            ->where('notifiable_id', $patient->id)
            ->where('notifiable_type', 'App\Models\Patient')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($n) {
                $data = json_decode($n->data, true);
                return [
                    'id' => $n->id,
                    'title' => $data['title'] ?? 'إشعار',
                    'message' => $data['message'] ?? '',
                    'doctor_id' => $data['doctor_id'] ?? null,
                    'doctor' => [
                        'firstname' => $data['doctor_name'] ?? 'Doctor',
                        'lastname' => ''
                    ],
                    'created_at' => $n->created_at,
                    'is_read' => $n->read_at !== null,
                ];
            });

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

        $id = \Illuminate\Support\Str::uuid()->toString();
        \Illuminate\Support\Facades\DB::table('notifications')->insert([
            'id' => $id,
            'type' => 'App\Notifications\CustomNotification',
            'notifiable_type' => 'App\Models\Patient',
            'notifiable_id' => $request->patient_id,
            'data' => json_encode([
                'title' => $request->title,
                'message' => $request->message,
                'doctor_id' => $doctor ? $doctor->id : null,
                'doctor_name' => $doctor ? $doctor->firstname . ' ' . $doctor->lastname : 'Doctor',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'تم إرسال الإشعار بنجاح',
            'notification' => [
                'id' => $id,
                'title' => $request->title,
                'message' => $request->message,
            ]
        ]);
    }
}

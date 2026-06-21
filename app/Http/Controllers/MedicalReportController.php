<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicalReportController extends Controller
{
    public function index()
    {
        // 1. بيانات المستخدم الحالي
        $user = Auth::user();

        // --- الجزء الجديد الخاص بالتنبيهات ---
        // بمجرد دخول المريض لهذه الصفحة، نجعل تنبيهات "التقارير الطبية" مقروءة
        foreach ($user->unreadNotifications as $notification) {
            if ($notification->type == 'App\Notifications\NewMedicalReport') {
                $notification->markAsRead();
            }
        }
        // ------------------------------------

        // 2. البحث عن المريض بالإيميل
        $patient = DB::table('patients')->where('email', $user->email)->first();

        // 3. تجهيز التقارير (من الموقع والموبايل)
        $reports = collect();
        
        if ($patient) {
            $webReports = DB::table('medical_reports')
                ->where('patient_id', $patient->id)
                ->get()
                ->map(function($r) {
                    return (object) [
                        'id' => 'w_'.$r->id,
                        'doctor_id' => $r->doctor_id,
                        'report_content' => $r->report_content,
                        'file_path' => $r->file_path,
                        'created_at' => $r->created_at,
                        'timestamp' => strtotime($r->created_at)
                    ];
                });

            $appPrescriptions = collect();
            
            if (\Illuminate\Support\Facades\Schema::hasTable('prescriptions')) {
                $appPrescriptions = DB::table('prescriptions')
                    ->where('patient_id', $patient->id)
                    ->get()
                    ->map(function($p) {
                        $filePath = null;
                        if ($p->image_path) {
                            // Extract relative path from full URL
                            $parsed = parse_url($p->image_path, PHP_URL_PATH);
                            $filePath = str_replace('/storage/', '', $parsed);
                            $filePath = str_replace('storage/', '', $filePath);
                        }
                        return (object) [
                            'id' => 'a_'.$p->id,
                            'doctor_id' => $p->doctor_id,
                            'report_content' => $p->notes ?? null,
                            'file_path' => $filePath ? 'storage/'.$filePath : null,
                            'created_at' => $p->created_at,
                            'timestamp' => strtotime($p->created_at)
                        ];
                    });
            }

            $reports = $webReports->concat($appPrescriptions)->sortByDesc('timestamp')->values();
        }

        // 4. عرض الصفحة
        return view('patient.medical_reports', compact('patient', 'reports'));
    }
}
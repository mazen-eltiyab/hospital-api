<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::where('status', 1)->get();
        return response()->json([
            'patients' => $patients
        ]);
    }
}

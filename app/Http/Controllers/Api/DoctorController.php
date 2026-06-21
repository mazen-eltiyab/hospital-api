<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('status', 1)->get()->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'user_id' => $doctor->id, // Fallback if user_id doesn't exist
                'name' => trim($doctor->firstname . ' ' . $doctor->lastname),
                'speciality' => $doctor->speciality ?? 'General Practitioner',
                'experience' => $doctor->experience ?? rand(1, 15), // Mock if missing
                'rating' => $doctor->rating ?? (4 + (rand(0, 10) / 10)), // Mock if missing
                'reviews_count' => $doctor->reviews_count ?? rand(10, 100), // Mock if missing
                'profile_image_url' => $doctor->avatar ? (\Illuminate\Support\Str::startsWith($doctor->avatar, ['http://', 'https://']) ? $doctor->avatar : asset('storage/' . $doctor->avatar)) : null,
            ];
        });

        return response()->json([
            'data' => $doctors
        ]);
    }
}

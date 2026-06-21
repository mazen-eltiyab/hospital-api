<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Doctor;
use App\Models\Patient;

class RatingController extends Controller
{
    // Patient submits a rating
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $user = $request->user();
        if ($user->role !== 'patient') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $patient = Patient::where('email', $user->email)->first();
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $doctor = Doctor::findOrFail($request->doctor_id);

        $rating = Rating::create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        // Recalculate average rating
        // Old rating approach (weighted average)
        $new_stars = $request->stars;
        $current_rating = $doctor->rating;
        $current_count = $doctor->reviews_count;

        $new_rating = (($current_rating * $current_count) + $new_stars) / ($current_count + 1);
        
        $doctor->update([
            'rating' => round($new_rating, 1),
            'reviews_count' => $current_count + 1,
        ]);

        return response()->json([
            'message' => 'Rating submitted successfully',
            'rating' => $rating,
            'doctor_new_rating' => $doctor->rating,
            'doctor_reviews_count' => $doctor->reviews_count,
        ], 201);
    }

    // Get a specific doctor's reviews (for patient/admin view)
    public function index($doctor_id)
    {
        $ratings = Rating::where('doctor_id', $doctor_id)
            ->with('patient')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($rating) {
                return [
                    'id' => $rating->id,
                    'stars' => $rating->stars,
                    'comment' => $rating->comment,
                    'created_at' => $rating->created_at->format('M d, Y'),
                    'patient_name' => $rating->patient ? $rating->patient->firstname . ' ' . $rating->patient->lastname : 'Anonymous',
                    'patient_image' => $rating->patient && $rating->patient->avatar ? url('storage/' . $rating->patient->avatar) : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $ratings,
        ]);
    }

    // Doctor fetches their own reviews
    public function myReviews(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'doctor') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $doctor = Doctor::where('email', $user->email)->first();
        if (!$doctor) {
            return response()->json(['status' => 'success', 'data' => []]);
        }

        $ratings = Rating::where('doctor_id', $doctor->id)
            ->with('patient')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($rating) {
                return [
                    'id' => $rating->id,
                    'stars' => $rating->stars,
                    'comment' => $rating->comment,
                    'created_at' => $rating->created_at->format('M d, Y'),
                    'patient_name' => $rating->patient ? $rating->patient->firstname . ' ' . $rating->patient->lastname : 'Anonymous',
                    'patient_image' => $rating->patient && $rating->patient->avatar ? url('storage/' . $rating->patient->avatar) : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $ratings,
            'total_rating' => $doctor->rating,
            'total_reviews' => $doctor->reviews_count,
        ]);
    }
}

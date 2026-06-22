<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;

class AdminController extends Controller
{
    public function counts()
    {
        $doctorsCount = Doctor::count();
        $patientsCount = Patient::count();
        $usersCount = User::count();

        return response()->json([
            'doctors' => $doctorsCount,
            'patients' => $patientsCount,
            'total_users' => $usersCount,
        ]);
    }

    public function users(Request $request)
    {
        $role = $request->query('role');
        $users = User::when($role, function ($q) use ($role) {
            return $q->where('role', $role);
        })->get();

        $users->transform(function ($user) {
            $extra = [];
            if ($user->role === 'doctor') {
                $doc = Doctor::where('email', $user->email)->first();
                if ($doc) {
                    $extra['doctor_id'] = $doc->id;
                    $extra['phone'] = $doc->phone ?? '';
                    $extra['speciality'] = $doc->speciality ?? '';
                    $extra['doctor_rating'] = $doc->rating ?? 0.0;
                    $extra['profile_image_url'] = $doc->avatar ? (\Illuminate\Support\Str::startsWith($doc->avatar, ['http://', 'https://']) ? $doc->avatar : asset('storage/' . $doc->avatar)) : null;
                }
            } elseif ($user->role === 'patient') {
                $pat = Patient::where('email', $user->email)->first();
                if ($pat) {
                    $extra['phone'] = $pat->phone ?? '';
                    $extra['profile_image_url'] = $pat->avatar ? (\Illuminate\Support\Str::startsWith($pat->avatar, ['http://', 'https://']) ? $pat->avatar : asset('storage/' . $pat->avatar)) : null;
                }
            }
            return array_merge($user->toArray(), $extra);
        });

        return response()->json([
            'users' => $users,
        ]);
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,doctor,patient',
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'role' => $request->role,
            ]);

            $profileImagePath = null;
            if ($request->hasFile('profile_image')) {
                $profileImagePath = $request->file('profile_image')->store('profiles', 'public');
            }

            if ($request->role === 'doctor') {
                // Split name into firstname/lastname
                $nameParts = explode(' ', $request->name, 2);
                Doctor::create([
                    'user_id'       => $user->id,
                    'experience'    => $request->experience ?? 0,
                    'firstname'     => $nameParts[0] ?? $request->name,
                    'lastname'      => $nameParts[1] ?? '',
                    'username'      => str_replace(' ', '_', strtolower($request->name)) . rand(100, 999),
                    'email'         => $request->email,
                    'password'      => \Illuminate\Support\Facades\Hash::make($request->password),
                    'gender'        => 'Male',
                    'status'        => 1,
                    'speciality'    => $request->speciality ?? 'General Practitioner',
                    'rating'        => $request->rating ?? 0.0,
                    'reviews_count' => $request->reviews_count ?? 0,
                    'phone'         => $request->phone ?? null,
                    'avatar'        => $profileImagePath ?? '', // prevent NOT NULL constraint error
                ]);
            } elseif ($request->role === 'patient') {
                $patient = Patient::where('user_id', $user->id)->first();
                if (!$patient) {
                    // Split name into firstname/lastname
                    $nameParts = explode(' ', $request->name, 2);
                    Patient::create([
                        'user_id'       => $user->id,
                        'firstname'     => $nameParts[0] ?? $request->name,
                        'lastname'      => $nameParts[1] ?? '',
                        'email'         => $request->email,
                        'password'      => \Illuminate\Support\Facades\Hash::make($request->password),
                        'phone'         => $request->phone ?? null,
                    ]);
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'message' => 'Error creating user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'doctor') {
            Doctor::where('email', $user->email)->delete();
        } elseif ($user->role === 'patient') {
            Patient::where('email', $user->email)->delete();
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->name) $user->name = $request->name;
        if ($request->email) $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();

        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profiles', 'public');
        }

        if ($user->role === 'doctor') {
            $doctor = Doctor::where('email', $user->email)->first();
            if ($doctor) {
                if ($request->name) $doctor->firstname = $request->name;
                if ($request->email) $doctor->email = $request->email;
                if ($request->has('speciality')) $doctor->speciality = $request->speciality;
                if ($request->has('phone')) $doctor->phone = $request->phone;
                if ($profileImagePath) $doctor->avatar = $profileImagePath;
                $doctor->save();
            }
        } elseif ($user->role === 'patient') {
            $patient = Patient::where('email', $user->email)->first();
            if ($patient) {
                if ($request->name) $patient->firstname = $request->name;
                if ($request->email) $patient->email = $request->email;
                if ($request->has('phone')) $patient->phone = $request->phone;
                if ($profileImagePath) $patient->avatar = $profileImagePath;
                $patient->save();
            }
        }

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function updateDoctorRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'nullable|string',
        ]);

        $user = $request->user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $targetUser = \App\Models\User::findOrFail($id);
        $doctor = Doctor::firstOrCreate(
            ['email' => $targetUser->email],
            [
                'firstname' => $targetUser->name,
                'username' => $targetUser->name . rand(100, 999),
                'password' => $targetUser->password,
                'status' => 1,
                'speciality' => 'General Practitioner',
                'rating' => 0.0,
                'reviews_count' => 0,
            ]
        );
        
        // Admin inserts a new rating with a null patient
        if ($request->filled('review') || $request->rating > 0) {
            \App\Models\Rating::create([
                'doctor_id' => $doctor->id,
                'patient_id' => null, // Admin review
                'stars' => $request->rating,
                'comment' => $request->review,
            ]);
            
            // Recalculate doctor rating
            $current_rating = $doctor->rating;
            $current_count = $doctor->reviews_count;
            $new_rating = (($current_rating * $current_count) + $request->rating) / ($current_count + 1);
            
            $doctor->update([
                'rating' => round($new_rating, 1),
                'reviews_count' => $current_count + 1,
            ]);
        }

        return response()->json([
            'message' => 'Doctor rating updated successfully',
            'doctor' => $doctor,
        ]);
    }

    public function importFriendData(Request $request)
    {
        $data = $request->all();
        $imported = ['users' => 0, 'doctors' => 0, 'patients' => 0, 'services' => 0];

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            // Import Services
            if (isset($data['services'])) {
                foreach ($data['services'] as $srv) {
                    \App\Models\Service::firstOrCreate(
                        ['service_name' => $srv[1]],
                        ['status' => $srv[3] ?? 'active', 'price' => $srv[2] ?? 0]
                    );
                    $imported['services']++;
                }
            }

            // Map old user ID to new user ID
            $userIdMap = [];

            // Import Users
            if (isset($data['users'])) {
                foreach ($data['users'] as $u) {
                    $oldId = $u[0];
                    $email = $u[2];
                    $role = $u[5];
                    $user = User::firstOrCreate(
                        ['email' => $email],
                        [
                            'name' => $u[1],
                            'password' => $u[4], // Keep the original hashed password
                            'role' => $role,
                        ]
                    );
                    $userIdMap[$oldId] = $user->id;
                    $imported['users']++;
                }
            }

            // Import Doctors
            if (isset($data['doctors'])) {
                foreach ($data['doctors'] as $doc) {
                    $email = $doc[5];
                    $user = User::where('email', $email)->first();
                    if ($user) {
                        \App\Models\Doctor::firstOrCreate(
                            ['email' => $email],
                            [
                                'user_id' => $user->id,
                                'firstname' => $doc[1] ?? 'Doctor',
                                'lastname' => $doc[2] ?? '',
                                'speciality' => $doc[3] ?? 'General',
                                'username' => str_replace(' ', '_', strtolower($doc[1] ?? 'doc')) . rand(100, 999),
                                'password' => $doc[6],
                                'gender' => 'Male',
                                'phone' => $doc[15] ?? null,
                                'avatar' => $doc[16] ?? 'user.jpg',
                                'status' => 1,
                                'rating' => 0,
                                'reviews_count' => 0,
                                'experience' => 0
                            ]
                        );
                        $imported['doctors']++;
                    }
                }
            }

            // Import Patients
            if (isset($data['patients'])) {
                foreach ($data['patients'] as $pat) {
                    $oldUserId = $pat[1];
                    $email = $pat[4];
                    $newUserId = $userIdMap[$oldUserId] ?? null;
                    if ($newUserId) {
                        \App\Models\Patient::firstOrCreate(
                            ['email' => $email],
                            [
                                'user_id' => $newUserId,
                                'firstname' => $pat[2] ?? 'Patient',
                                'lastname' => $pat[3] ?? '',
                                'age' => $pat[5] ?? 30,
                                'gender' => $pat[6] ?? 'male',
                                'phone' => $pat[7] ?? null,
                                'address' => $pat[8] ?? null,
                                'avatar' => $pat[9] ?? 'user.jpg',
                                'password' => \Illuminate\Support\Facades\Hash::make('password123') // Default since password isn't in patients dump
                            ]
                        );
                        $imported['patients']++;
                    }
                }
            }

            \Illuminate\Support\Facades\DB::commit();
            return response()->json(['message' => 'Data imported successfully', 'stats' => $imported]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json(['message' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}

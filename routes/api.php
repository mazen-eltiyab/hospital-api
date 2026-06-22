<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\AppointmentController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/register/patient', [AuthController::class, 'register']); // For compatibility

// Debug route
Route::get('/doctors', [DoctorController::class, 'index']);

// Contact Messages
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'storeApi']);

// Departments
Route::get('/departments', [\App\Http\Controllers\DepartmentController::class, 'index']);
Route::post('/departments', [\App\Http\Controllers\DepartmentController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);
    // Language
    Route::post('/update-language', [AuthController::class, 'updateLanguage']);
    
    // Chatbot
    Route::post('/chatbot/message', [\App\Http\Controllers\ChatbotController::class, 'handleChat']);
    
    // Admin Routes
    Route::get('/admin/counts', [AdminController::class, 'counts']);
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::post('/admin/users', [AdminController::class, 'storeUser']);
    Route::post('/admin/users/{id}', [AdminController::class, 'updateUser']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);
    Route::post('/admin/doctors/{id}/rating', [AdminController::class, 'updateDoctorRating']);
    
    // Doctor / Patient lists
    Route::get('/patients', [PatientController::class, 'index']); // Or /my-patients
    Route::get('/my-patients', [AppointmentController::class, 'myPatients']); // Doctor fetches their patients
    
    // Appointments
    Route::post('/appointments', [AppointmentController::class, 'store']); // Patient books an appointment
    Route::get('/my-appointments', [AppointmentController::class, 'myAppointments']); // Patient fetches their appointments
    Route::post('/appointments/status', [AppointmentController::class, 'updateStatus']); // Doctor/Admin updates status
    
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications', [NotificationController::class, 'store']); // Doctor sends notification
    
    // Prescriptions
    Route::post('/prescriptions', [PrescriptionController::class, 'store']);
    Route::get('/my-prescriptions', [PrescriptionController::class, 'myPrescriptions']);

    // Ratings
    Route::post('/ratings', [\App\Http\Controllers\Api\RatingController::class, 'store']);
    Route::get('/doctors/{id}/reviews', [\App\Http\Controllers\Api\RatingController::class, 'index']);
    Route::get('/my-reviews', [\App\Http\Controllers\Api\RatingController::class, 'myReviews']);

    // Admin explicitly updates rating
    Route::post('/admin/doctors/{id}/rating', [AdminController::class, 'updateDoctorRating']);
});

Route::get('/migrate', function () { try { \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]); return 'Database Migrated Successfully!'; } catch (\Exception $e) { return 'Error: ' . $e->getMessage(); } });

Route::get('/debug', function () { return response('<pre>' . print_r(getenv(), true) . '</pre>'); });

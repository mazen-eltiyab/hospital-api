<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SettingController;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;

Route::get('/', function () {
    // الأكواد اللي بتجيب الأرقام (لو كنت ضفتها)
    $doctorCount = \App\Models\Doctor::count();
    $patientCount = \App\Models\Patient::count();
    $appointmentCount = \App\Models\Appointment::count();
    $pendingAppointments = \App\Models\Appointment::where('status', 1)->count();

    return view('dashboard', compact('doctorCount', 'patientCount', 'appointmentCount', 'pendingAppointments'));
})->name('dashboard');

// باقي الـ Routes زي ما هي...
Route::resource('doctors', DoctorController::class);
Route::resource('patients', PatientController::class);
Route::resource('appointments', AppointmentController::class);
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
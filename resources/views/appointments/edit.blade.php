@extends('layouts.app')
@section('title', 'Edit Appointment - MediCare')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Edit Appointment</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Patient Name</label>
                        <select class="form-control" name="patient_id" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor_id" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->first_name }} {{ $doctor->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" name="department">
                            <option value="Dentists" {{ $appointment->department == 'Dentists' ? 'selected' : '' }}>Dentists</option>
                            <option value="Neurology" {{ $appointment->department == 'Neurology' ? 'selected' : '' }}>Neurology</option>
                            <option value="Opthalmology" {{ $appointment->department == 'Opthalmology' ? 'selected' : '' }}>Opthalmology</option>
                            <option value="Orthopedics" {{ $appointment->department == 'Orthopedics' ? 'selected' : '' }}>Orthopedics</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="appointment_date" value="{{ $appointment->appointment_date }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" class="form-control" name="appointment_time" value="{{ $appointment->appointment_time }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Patient Email</label>
                        <input class="form-control" name="patient_email" type="email" value="{{ $appointment->patient_email }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea cols="30" rows="4" name="message" class="form-control">{{ $appointment->message }}</textarea>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn" type="submit">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.patient')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <strong><i class="fa fa-check-circle"></i> Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row align-items-center mb-4">
    <div class="col-6">
        <h4 class="page-title m-0">My Profile</h4>
    </div>
    <div class="col-6 text-right">
        <a href="{{ route('patient.profile.edit') }}" class="btn btn-primary btn-rounded shadow-sm px-4">
            <i class="fa fa-pencil mr-1"></i> Edit Profile
        </a>
    </div>
</div>

<div class="profile-header">
    <div class="profile-main-flex">
        <div class="profile-image-container">
            <div class="profile-img-wrap">
                <img src="{{ !empty($patient->avatar) ? asset('assets/img/' . $patient->avatar) : asset('assets/img/user.jpg') }}" alt="Patient Image">
            </div>
        </div>

        <div class="profile-details-container border-left pl-md-5">
            <h3 class="user-name">{{ Auth::user()->name }}</h3>
            <span class="patient-id-badge">Verified Patient</span>
            
            <ul class="info-list">
                <li><i class="fa fa-id-card"></i> <span class="title">Patient ID:</span> <span class="text">#PT-{{ str_pad($patient->id ?? '0', 4, '0', STR_PAD_LEFT) }}</span></li>
                <li><i class="fa fa-envelope"></i> <span class="title">Email:</span> <span class="text">{{ Auth::user()->email }}</span></li>
                <li><i class="fa fa-phone"></i> <span class="title">Phone:</span> <span class="text">{{ $patient->phone ?? 'Not Provided' }}</span></li>
                <li><i class="fa fa-map-marker"></i> <span class="title">Address:</span> <span class="text">{{ $patient->address ?? 'Not Provided' }}</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="stat-card" style="border-left-color: #ff9f43;">
            <h5><i class="fa fa-birthday-cake mr-2"></i> Date of Birth</h5>
            <p class="stat-value mb-0">{{ $patient->dob ?? 'Not Specified' }}</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="stat-card" style="border-left-color: #7b61ff;">
            <h5><i class="fa fa-venus-mars mr-2"></i> Gender</h5>
            <p class="stat-value mb-0">{{ $patient->gender ?? 'Not Specified' }}</p>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    body { background-color: #f5f7fb; }

    .profile-header {
        background: #ffffff;
        border: 1px solid #f0f0f0;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .profile-main-flex {
        display: flex;
        align-items: center;
        gap: 40px;
        flex-wrap: wrap;
    }

    .profile-image-container { flex: 0 0 160px; }

    .profile-img-wrap {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        border: 6px solid #f8f9fa;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        background: #fff;
    }

    .profile-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .profile-details-container {
        flex: 1;
        min-width: 300px;
    }

    .user-name { font-size: 32px; font-weight: 800; color: #343a40; margin: 0; }

    .patient-id-badge {
        display: inline-block;
        background: #e8f5e9;
        color: #2e7d32;
        font-weight: 700;
        font-size: 14px;
        padding: 5px 15px;
        border-radius: 50px;
        margin-top: 10px;
    }

    .info-list { padding: 0; list-style: none; margin-top: 25px; }

    .info-list li {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f8f9fa;
    }

    .info-list .title { font-weight: 700; width: 130px; color: #495057; }
    .info-list .text { color: #6c757d; flex: 1; font-weight: 500; }
    .info-list i { width: 30px; color: #009efb; font-size: 1.1rem; }

    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        border-left: 5px solid #009efb;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }
    .stat-card:hover { transform: translateY(-5px); }
    .stat-card h5 { color: #888; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 10px; }
    .stat-card .stat-value { color: #333; font-size: 20px; font-weight: 700; }

    @media (max-width: 768px) {
        .profile-main-flex { flex-direction: column; text-align: center; }
        .info-list li { justify-content: center; }
        .profile-details-container { border-left: none !important; padding-left: 0 !important; }
    }
</style>
@endpush
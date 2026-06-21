@extends('layouts.admin')

@section('title', 'MediCare | Professional Staff Management')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --primary: #0f172a;
        --accent: #2563eb;
        --accent-light: rgba(37, 99, 219, 0.06);
        --success: #10b981;
        --success-light: rgba(16, 185, 129, 0.08);
        --warning-light: rgba(245, 158, 11, 0.08);
        --bg-main: #f8fafc;
        --card-bg: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }

    body { 
        background-color: var(--bg-main); 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        color: var(--text-main);
    }

    /* Header & Stats Card */
    .stats-header-card {
        background: linear-gradient(135deg, var(--primary) 0%, #1e293b 100%);
        border-radius: 20px;
        padding: 18px 28px;
        color: white;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 12px 24px -10px rgba(15, 23, 42, 0.15);
    }
    .stats-icon {
        width: 50px; height: 50px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; color: #60a5fa;
    }
    .stats-number { font-size: 26px; font-weight: 800; line-height: 1; letter-spacing: -0.5px; }
    .stats-label { font-size: 11px; opacity: 0.8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; }

    /* Filter Card */
    .filter-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 24px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 18px -4px rgba(148, 163, 184, 0.12);
        margin-bottom: 35px;
    }
    .form-control, .select {
        height: 48px;
        border-radius: 12px !important;
        border: 1px solid var(--border-color);
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .form-control:focus, .select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(37, 99, 219, 0.1);
    }

    /* Doctor Card Grid */
    .doctor-card {
        background: var(--card-bg);
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.7);
        padding: 28px 20px;
        text-align: center;
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.35s ease;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .doctor-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 24px 36px -8px rgba(148, 163, 184, 0.22);
        border-color: var(--accent);
    }

    /* Avatar Design */
    .avatar-wrapper {
        position: relative;
        width: 105px; height: 105px;
        margin: 0 auto 20px;
    }
    .avatar-main {
        width: 100%; height: 100%;
        border-radius: 50%;
        object-fit: cover;
        padding: 4px;
        background: #fff;
        border: 2px solid var(--border-color);
        transition: border-color 0.3s ease;
    }
    .doctor-card:hover .avatar-main {
        border-color: var(--accent);
    }

    .dr-name { font-weight: 700; font-size: 19px; color: var(--primary); margin-bottom: 6px; letter-spacing: -0.3px; }

    /* Specialties Badges */
    .specialty-container {
        display: flex; flex-wrap: wrap; justify-content: center;
        gap: 6px; margin-bottom: 16px; min-height: 28px;
    }
    .dr-specialty { 
        font-size: 11px; font-weight: 600; color: var(--accent); 
        background: var(--accent-light);
        padding: 4px 12px; border-radius: 8px;
        letter-spacing: 0.2px;
    }

    /* Custom Badges (Pills) */
    .rating-pill, .salary-pill {
        padding: 6px 14px; border-radius: 12px;
        display: inline-flex; align-items: center; justify-content: center;
        width: fit-content; margin: 0 auto 12px;
        font-weight: 700; font-size: 12.5px;
    }
    
    .rating-pill { background: var(--warning-light); color: #b45309; }
    .rating-pill i { color: #f59e0b; margin-right: 6px; }

    .salary-pill { background: var(--success-light); color: #047857; }
    .salary-pill i { color: var(--success); margin-right: 6px; }

    /* Footer Meta */
    .card-footer-info {
        margin-top: auto; padding-top: 18px;
        border-top: 1px dashed var(--border-color);
    }
    .location-tag { font-size: 12.5px; color: var(--text-muted); display: flex; align-items: center; justify-content: center; gap: 6px; }

    /* Buttons */
    .btn-primary-custom {
        background: var(--primary); color: white !important;
        border-radius: 14px; padding: 12px 24px; font-weight: 600;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
        border: none;
        transition: all 0.2s ease;
    }
    .btn-primary-custom:hover {
        background: #1e293b;
        transform: translateY(-1px);
    }
    .dropdown-action-btn {
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 8px; transition: background 0.2s ease;
    }
    .dropdown-action-btn:hover { background: #f1f5f9; opacity: 1 !important; }
</style>
@endpush

@section('content')
<div class="content p-4">
    <!-- Upper Header Controls -->
    <div class="d-md-flex align-items-center justify-content-between mb-4 mt-2">
        <div class="stats-header-card">
            <div class="stats-icon">
                <i class="fa fa-user-md"></i>
            </div>
            <div>
                <div class="stats-number">{{ $doctors->count() }}</div>
                <div class="stats-label">Registered Doctors</div>
            </div>
        </div>
        
        <div class="mt-3 mt-md-0">
            <a href="{{ route('admin.add-doctor') }}" class="btn btn-primary-custom shadow-sm">
                <i class="fa fa-plus-circle mr-2"></i> Onboard New Doctor
            </a>
        </div>
    </div>

    <!-- Filters section -->
    <div class="filter-card">
        <form action="{{ route('admin.doctors') }}" method="GET">
            <div class="row align-items-end">
                <div class="col-lg-5 col-md-6 mb-3 mb-lg-0">
                    <label class="font-weight-bold small text-uppercase text-muted mb-2" style="letter-spacing: 0.5px">Search Staff Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0 px-3" style="border-radius: 12px 0 0 12px; border-color: var(--border-color);"><i class="fa fa-search text-muted"></i></span>
                        </div>
                        <input type="text" name="name" class="form-control border-left-0" placeholder="Type doctor name..." value="{{ request('name') }}" style="border-radius: 0 12px 12px 0;">
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-6 mb-3 mb-lg-0">
                    <label class="font-weight-bold small text-uppercase text-muted mb-2" style="letter-spacing: 0.5px">Specialization</label>
                    <select name="speciality" class="select floating form-control w-100">
                        <option value="">All Specializations</option>
                        @foreach(\App\Models\Service::all() as $service)
                            <option value="{{ $service->service_name }}" {{ request('speciality') == $service->service_name ? 'selected' : '' }}>
                                {{ $service->service_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-block" style="background: var(--accent); color: white; height: 48px; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 12px rgba(37, 99, 219, 0.2);">
                        Filter Results
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Doctors Loop Grid -->
    <div class="row g-4">
        @forelse($doctors as $doctor)
        @php $rating = (float)($doctor->rating ?? 0.0); @endphp
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4 px-3">
            <div class="doctor-card shadow-sm">

                {{-- Dropdown Menu --}}
                <div style="position: absolute; right: 16px; top: 16px; z-index: 10;">
                    <div class="dropdown">
                        <div class="dropdown-action-btn" data-toggle="dropdown" style="cursor:pointer; opacity:0.5;">
                            <i class="fa fa-ellipsis-v"></i>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-lg p-2" style="border-radius: 14px; min-width: 160px;">
                            <a class="dropdown-item p-2 rounded small font-weight-bold text-secondary" href="{{ route('doctor.edit', $doctor->id) }}">
                                <i class="fa fa-edit text-primary mr-2"></i> Edit Profile
                            </a>
                            <div class="dropdown-divider my-1" style="border-color: #f1f5f9"></div>
                            <a class="dropdown-item p-2 rounded small text-danger font-weight-bold" href="#" data-toggle="modal" data-target="#delete_doctor_{{ $doctor->id }}">
                                <i class="fa fa-trash-alt mr-2"></i> Deactivate Staff
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Avatar --}}
                <div class="avatar-wrapper">
                    <img class="avatar-main shadow-sm" src="{{ asset('assets/img/' . ($doctor->avatar ?? 'user.jpg')) }}" alt="Doctor">
                </div>

                {{-- Name --}}
                <h4 class="dr-name text-truncate" title="Dr. {{ $doctor->firstname }} {{ $doctor->lastname }}">Dr. {{ $doctor->firstname }} {{ $doctor->lastname }}</h4>
                
                {{-- Specialties --}}
                <div class="specialty-container">
                    @if($doctor->services->isNotEmpty())
                        @foreach($doctor->services as $service)
                            <span class="dr-specialty">{{ $service->service_name }}</span>
                        @endforeach
                    @else
                        <span class="dr-specialty">Physician</span>
                    @endif
                </div>

                {{-- Rating --}}
                <div class="rating-pill">
                    <i class="fa fa-star"></i>
                    <span>{{ number_format($rating, 1) }} Score</span>
                </div>

                {{-- Salary / Consultation Fee --}}
                <div class="salary-pill">
                    <i class="fa fa-money"></i>
                    <span>{{ number_format($doctor->salary ?? 0, 2) }} EGP</span>
                </div>

                {{-- Bio --}}
                <p class="text-muted small px-2" style="line-height: 1.6; min-height: 45px; margin-bottom: 15px;">
                    {{ Str::limit($doctor->bio ?? 'Medical professional providing high-quality care.', 65) }}
                </p>

                {{-- Footer --}}
                <div class="card-footer-info">
                    <div class="location-tag">
                        <i class="fa fa-map-pin" style="color: #f87171; font-size: 14px;"></i>
                        <span class="text-truncate" style="max-width: 180px;">{{ $doctor->address ?? 'Main Medical Center' }}</span>
                    </div>
                </div>

            </div>
        </div>

        {{-- Delete Modal --}}
        <div id="delete_doctor_{{ $doctor->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
                    <div class="modal-body p-5 text-center">
                        <div style="width: 65px; height: 65px; background: #fef2f2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 26px;">
                            <i class="fa fa-user-times"></i>
                        </div>
                        <h4 class="font-weight-bold" style="color: var(--primary);">Confirm Deactivation</h4>
                        <p class="text-muted small">Are you sure you want to suspend <b class="text-dark">Dr. {{ $doctor->firstname }}</b>?<br>This action will temporarily freeze their panel access.</p>
                        <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" class="mt-4">
                            @csrf @method('DELETE')
                            <div class="d-flex justify-content-center gap-3">
                                <button type="button" class="btn btn-light px-4 py-2.5 font-weight-bold mx-2" data-dismiss="modal" style="border-radius: 10px; min-width: 120px;">Cancel</button>
                                <button type="submit" class="btn btn-danger px-4 py-2.5 font-weight-bold" style="border-radius: 10px; background: #ef4444; border: none; min-width: 120px;">Deactivate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted mb-3" style="font-size: 40px;"><i class="fa fa-folder-open-o"></i></div>
            <h5 class="text-muted font-weight-bold">No medical staff found matching criteria.</h5>
        </div>
        @endforelse
    </div>
</div>
@endsection
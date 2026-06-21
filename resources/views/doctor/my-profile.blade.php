@extends('layouts.doctor')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <strong><i class="fa fa-check-circle"></i> Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row align-items-center mb-4">
    <div class="col-md-6 col-12 text-center text-md-left">
        <h4 class="page-title m-0 font-weight-bold" style="color: #343a40;">My Profile</h4>
    </div>
    <div class="col-md-6 col-12 text-center text-md-right mt-3 mt-md-0">
        <a href="{{ route('doctor.profile.edit') }}" class="btn btn-primary btn-rounded shadow-sm px-4">
            <i class="fa fa-pencil mr-1"></i> Edit Profile
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="row no-gutters">
            <div class="col-12 col-md-4 col-lg-3 bg-light d-flex align-items-center justify-content-center p-4" style="min-height: 250px;">
                <div class="profile-img-wrap">
                    <img src="{{ !empty($doctor->avatar) ? asset('assets/img/' . $doctor->avatar) : asset('assets/img/user.jpg') }}" 
                         alt="Doctor Image" class="img-fluid">
                </div>
            </div>
            
            <div class="col-12 col-md-8 col-lg-9 p-4 p-md-5">
                <div class="text-center text-md-left">
                    <h3 class="user-name mb-1">Dr. {{ $doctor->firstname }} {{ $doctor->lastname }}</h3>
                    <span class="doctor-badge mb-4">
                        <i class="fa fa-stethoscope"></i> Verified Doctor
                    </span>
                </div>

                <div class="row mt-4">
                    <div class="col-12 col-sm-6 mb-3">
                        <div class="info-item">
                            <i class="fa fa-id-card text-primary mr-2"></i>
                            <span class="font-weight-bold mr-1">Doctor ID:</span>
                            <span class="text-secondary">#DOC-{{ str_pad($doctor->id ?? '0', 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-3">
                        <div class="info-item">
                            <i class="fa fa-envelope text-primary mr-2"></i>
                            <span class="font-weight-bold mr-1">Email:</span>
                            <span class="text-secondary text-break">{{ $doctor->email }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-3">
                        <div class="info-item">
                            <i class="fa fa-phone text-primary mr-2"></i>
                            <span class="font-weight-bold mr-1">Phone:</span>
                            <span class="text-secondary">{{ $doctor->phone ?? 'Not Provided' }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-3">
                        <div class="info-item">
                            <i class="fa fa-map-marker text-primary mr-2"></i>
                            <span class="font-weight-bold mr-1">Address:</span>
                            <span class="text-secondary">{{ $doctor->address ?? 'Not Provided' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-4 mb-4">
        <div class="stat-card" style="border-left-color: #ff9f43;">
            <p class="text-muted small uppercase font-weight-bold mb-2">Specialization</p>
            <h5 class="mb-0 font-weight-bold">{{ $doctor->specialization ?? 'Not Specified' }}</h5>
        </div>
    </div>
    <div class="col-12 col-md-4 mb-4">
        <div class="stat-card" style="border-left-color: #7b61ff;">
            <p class="text-muted small uppercase font-weight-bold mb-2">Department</p>
            <h5 class="mb-0 font-weight-bold">{{ $doctor->department ?? 'Not Specified' }}</h5>
        </div>
    </div>
    <div class="col-12 col-md-4 mb-4">
        <div class="stat-card" style="border-left-color: #2ecc71;">
            <p class="text-muted small uppercase font-weight-bold mb-2">Experience</p>
            <h5 class="mb-0 font-weight-bold">{{ $doctor->experience ?? '0' }} Years</h5>
        </div>
    </div>
</div>

@if(!empty($doctor->bio))
<div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
    <div class="card-body p-4">
        <h5 class="font-weight-bold mb-3 text-primary"><i class="fa fa-user-md mr-2"></i> Professional Bio</h5>
        <p class="text-secondary mb-0" style="line-height: 1.8;">{{ $doctor->bio }}</p>
    </div>
</div>
@endif

<div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
    <div class="card-body p-4">
        <h5 class="font-weight-bold mb-4 text-primary"><i class="fa fa-star mr-2 text-warning"></i> Patient Reviews</h5>
        
        @if(isset($ratings) && $ratings->count() > 0)
            <div class="reviews-list">
                @foreach($ratings as $rating)
                    <div class="review-item mb-4 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm mr-2">
                                    <img class="avatar-img rounded-circle" alt="User Image" src="{{ $rating->patient && $rating->patient->avatar ? asset('assets/img/' . $rating->patient->avatar) : asset('assets/img/user.jpg') }}" style="width: 40px; height: 40px; object-fit: cover;">
                                </div>
                                <div>
                                    <h6 class="mb-0 font-weight-bold">{{ $rating->patient ? $rating->patient->firstname . ' ' . $rating->patient->lastname : 'Unknown Patient' }}</h6>
                                    <small class="text-muted">{{ $rating->created_at->format('d M Y, h:i A') }}</small>
                                </div>
                            </div>
                            <div class="review-stars text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating->stars)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="text-secondary mt-2 mb-0">{{ $rating->comment ?? 'No comment provided.' }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-4">
                <i class="fa fa-comments-o text-muted mb-3" style="font-size: 40px;"></i>
                <p class="text-muted">No reviews found for you yet.</p>
            </div>
        @endif
    </div>
</div>

@endsection

@push('styles')
<style>
    body { background-color: #f4f7f6; }
    
    /* تنسيق الصورة الشخصية */
    .profile-img-wrap {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid #fff;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .profile-img-wrap img { width: 100%; height: 100%; object-fit: cover; }

    /* النصوص */
    .user-name { font-size: 28px; font-weight: 800; color: #333; }
    .doctor-badge {
        display: inline-block;
        background: rgba(25, 118, 210, 0.1);
        color: #1976d2;
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
    }

    /* كروت الإحصائيات */
    .stat-card {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        border-left: 6px solid #ccc;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: 100%;
    }

    /* تحسينات الموبايل */
    @media (max-width: 767px) {
        .profile-img-wrap { width: 130px; height: 130px; }
        .user-name { font-size: 22px; }
        .info-item { text-align: center; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .info-item i { display: block; margin-bottom: 5px; }
        .stat-card { text-align: center; }
    }
</style>
@endpush
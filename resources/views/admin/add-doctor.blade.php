@extends('layouts.admin') {{-- التأكد من مطابقة اسم ملف الـ Layout الأساسي --}}

@section('title', 'Add Doctor Profile - MediCare')

@push('styles')
<style>
    .form-group label { font-weight: 600; color: #333; }
    .submit-btn { min-width: 180px; border-radius: 50px; }
    .card-box { 
        border-top: 3px solid #009efb; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 25px;
    }
    .card-title { 
        font-size: 1.1rem; 
        font-weight: bold; 
        margin-bottom: 20px; 
        color: #1a3d6d; 
        border-bottom: 1px solid #eee; 
        padding-bottom: 10px; 
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .profile-upload { display: flex; align-items: center; gap: 20px; }
    .profile-upload .upload-img img { 
        border-radius: 50%; 
        object-fit: cover; 
        width: 80px; 
        height: 80px; 
        border: 3px solid #f0f0f0; 
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title"><i class="fa fa-user-md text-primary"></i> Add Doctor Profile</h4>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger col-lg-8 offset-lg-2 shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li><i class="fa fa-exclamation-circle"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- 1. Basic Information --}}
            <div class="card-box">
                <h3 class="card-title"><i class="fa fa-info-circle"></i> Basic Information</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input name="firstname" value="{{ old('firstname') }}" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input name="lastname" value="{{ old('lastname') }}" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <input name="username" value="{{ old('username') }}" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input name="email" value="{{ old('email') }}" class="form-control" type="email" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input name="password" class="form-control" type="password" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Confirm Password <span class="text-danger">*</span></label>
                            <input name="password_confirmation" class="form-control" type="password" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Professional Details --}}
            <div class="card-box">
                <h3 class="card-title"><i class="fa fa-graduation-cap"></i> Professional Details</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Doctor Bio / Certificates (السيرة الذاتية والشهادات)</label>
                            <textarea name="bio" class="form-control" rows="4" placeholder="اكتب هنا مؤهلات الدكتور وخبراته...">{{ old('bio') }}</textarea>
                            <small class="text-muted">هذا النص سيظهر في بروفايل الدكتور للمرضى.</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Initial Rating (0-5)</label>
                            <input name="rating" class="form-control" type="number" step="0.1" max="5" min="0" value="{{ old('rating', 5.0) }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Years of Experience</label>
                            <input name="experience_years" class="form-control" type="number" value="{{ old('experience_years', 0) }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Services & Contact --}}
            <div class="card-box">
                <h3 class="card-title"><i class="fa fa-hospital-o"></i> Services & Contact</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Select Services <span class="text-danger">*</span></label>
                            <select name="service_ids[]" class="form-control select" multiple required>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ (is_array(old('service_ids')) && in_array($service->id, old('service_ids'))) ? 'selected' : '' }}>
                                        {{ $service->service_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="phone" value="{{ old('phone') }}" class="form-control" type="text">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Profile Picture --}}
            <div class="card-box">
                <h3 class="card-title"><i class="fa fa-camera"></i> Profile Picture</h3>
                <div class="profile-upload">
                    <div class="upload-img">
                        <img id="previewImg" alt="Doctor" src="{{ asset('assets/img/user.jpg') }}">
                    </div>
                    <div class="upload-input flex-grow-1">
                        <input name="avatar" type="file" class="form-control" onchange="previewFile(this)">
                        <small class="text-muted">Accepted formats: JPG, PNG. Max size: 2MB.</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
    <div class="form-group">
        <label>Consultation Fee (EGP) <span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-money"></i>
                </span>
            </div>
            <input name="salary" 
                   value="{{ old('salary', 0) }}" 
                   class="form-control" 
                   type="number" 
                   min="0" 
                   step="0.01"
                   placeholder="e.g. 200">
        </div>
        <small class="text-muted">سعر الكشف بالجنيه المصري</small>
    </div>
</div>

            <div class="m-t-20 text-center mb-5">
                <button type="submit" class="btn btn-primary submit-btn">Save Doctor Profile</button>
                <a href="{{ route('admin.doctors') }}" class="btn btn-light submit-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        if($('.select').length > 0) {
            $('.select').select2({ 
                width: '100%', 
                placeholder: "Select Services",
                allowClear: true
            });
        }
    });

    function previewFile(input){
        var file = $(input).get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@extends('layouts.admin') {{-- افترضنا أن اسم ملف الـ Layout الأساسي هو app.blade.php --}}

@section('title', 'MediCare - Edit Doctor')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<style>
    .form-group label { font-weight: 600; color: #333; }
    .submit-btn { min-width: 180px; border-radius: 50px; }
    .card-box { border-top: 3px solid #009efb; background: #fff; padding: 20px; margin-bottom: 20px; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.1); }
    .upload-img img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-right: 15px; border: 2px solid #ddd; }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Edit Doctor: <span class="text-primary">{{ $doctor->firstname }} {{ $doctor->lastname }}</span></h4>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger col-lg-8 offset-lg-2">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card-box">
                <h3 class="card-title">Basic Information</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input name="firstname" value="{{ old('firstname', $doctor->firstname) }}" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input name="lastname" value="{{ old('lastname', $doctor->lastname) }}" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" value="{{ $doctor->username }}" class="form-control" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input name="email" value="{{ old('email', $doctor->email) }}" class="form-control" type="email" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" class="form-control" type="password" placeholder="Leave blank to keep current">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <div class="cal-icon">
                                <input name="dob" value="{{ old('dob', $doctor->dob) }}" type="text" class="form-control datetimepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address', $doctor->address) }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="display-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="doctor_active" value="1" {{ old('status', $doctor->status) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="doctor_active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="0" {{ old('status', $doctor->status) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="doctor_inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-box">
                <h3 class="card-title">Professional Details</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Assigned Services <span class="text-danger">*</span></label>
                            <select name="service_ids[]" class="form-control select" multiple required>
                                @isset($services)
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" 
                                            {{ (collect(old('service_ids', $doctor->services->pluck('id')))->contains($service->id)) ? 'selected' : '' }}>
                                            {{ $service->service_name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="phone" value="{{ old('phone', $doctor->phone) }}" class="form-control" type="text">
                        </div>
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

            <div class="card-box">
                <h3 class="card-title">Profile Picture</h3>
                <div class="profile-upload d-flex align-items-center">
                    <div class="upload-img">
                        <img id="previewImg" alt="Doctor" src="{{ asset('assets/img/' . ($doctor->avatar ?? 'user.jpg')) }}">
                    </div>
                    <div class="upload-input w-100">
                        <input name="avatar" type="file" class="form-control" onchange="previewFile(this)">
                    </div>
                </div>
            </div>

            <div class="m-t-20 text-center">
                <button type="submit" class="btn btn-primary submit-btn">Update Profile</button>
                <a href="{{ route('admin.doctors') }}" class="btn btn-light submit-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    $(document).ready(function () {
        if($('.select').length > 0) {
            $('.select').select2({ width: '100%' });
        }
        if($('.datetimepicker').length > 0) {
            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                icons: {
                    up: "fa fa-angle-up", down: "fa fa-angle-down",
                    next: 'fa fa-angle-right', previous: 'fa fa-angle-left'
                }
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
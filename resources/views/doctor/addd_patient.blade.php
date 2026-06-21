@extends('layouts.doctor')

@section('content')

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title"><i class="fa fa-plus-circle text-primary"></i> Register New Patient</h4>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                <h6 class="alert-heading font-weight-bold"><i class="fa fa-exclamation-triangle"></i> Please fix the following:</h6>
                <ul class="mb-0 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <form action="{{ route('admin.store-patient') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-box">
                <div class="section-header">
                    <i class="fa fa-user"></i>
                    <h3 class="section-title">Personal Information</h3>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="firstname" value="{{ old('firstname') }}" placeholder="Enter first name" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Enter last name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" class="form-control" name="age" value="{{ old('age') }}" placeholder="Years">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="select" name="gender">
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 234 567 89">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Residential Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Street name, City, Zip Code">
                        </div>
                    </div>
                </div>

                <div class="section-header mt-4">
                    <i class="fa fa-lock"></i>
                    <h3 class="section-title">Account Credentials</h3>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="username" value="{{ old('username') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email Address <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Confirm Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <div class="section-header mt-4">
                    <i class="fa fa-camera"></i>
                    <h3 class="section-title">Profile Picture</h3>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="profile-upload">
                                <div class="upload-img">
                                    <img id="preview_img" alt="Avatar" src="{{ asset('assets/img/user.jpg') }}">
                                </div>
                                <div class="upload-input flex-grow-1">
                                    <input type="file" class="form-control" name="avatar" onchange="previewImage(event)">
                                    <small class="text-muted">Recommended: Square image 200x200px</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-t-40 text-center">
                <button class="btn btn-primary submit-btn px-5"><i class="fa fa-check-circle mr-2"></i> Register Patient</button>
                <a href="{{ url('patients') }}" class="btn btn-light ml-2 p-3 text-muted"><i class="fa fa-arrow-left"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
<style>
    body { background-color: #f4f7f6; }
    .page-title { font-weight: 700; color: #333; margin-bottom: 25px; }
    .card-box { background: #fff; border-top: 4px solid #009efb; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); padding: 30px; margin-bottom: 30px; }
    .section-header { display: flex; align-items: center; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #f0f0f0; }
    .section-header i { background: #009efb; color: #fff; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 16px; }
    .section-title { font-size: 18px; font-weight: 600; color: #009efb; margin-bottom: 0; }
    .form-group label { font-weight: 500; color: #555; margin-bottom: 8px; }
    .form-control { border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px; height: auto; transition: all 0.3s; }
    .form-control:focus { border-color: #009efb; box-shadow: 0 0 0 0.2rem rgba(0,158,251,0.1); }
    .profile-upload { display: flex; align-items: center; gap: 20px; }
    .profile-upload .upload-img img { border-radius: 50%; object-fit: cover; width: 90px; height: 90px; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .btn-primary.submit-btn { background: #009efb; border: none; border-radius: 50px; padding: 12px 35px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 10px rgba(0,158,251,0.3); transition: transform 0.2s; }
    .btn-primary.submit-btn:hover { transform: translateY(-2px); background: #0089d9; }
    .alert-danger { border-radius: 10px; border-left: 5px solid #dc3545; }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select').select2({ width: '100%', placeholder: "Select an option" });
});

function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        document.getElementById('preview_img').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush
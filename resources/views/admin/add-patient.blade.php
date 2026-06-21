@extends('layouts.admin')

@section('title', 'Register New Patient - MediCare')

@push('styles')
<style>
    /* ========== PREMIUM FORM STYLING ========== */
    .card-box { 
        background: #fff; 
        border-top: 4px solid #009efb; 
        border-radius: 12px; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.08); 
        padding: 30px; 
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0f0f0;
    }
    .section-header i { 
        background: #009efb; 
        color: #fff; 
        width: 35px; 
        height: 35px; 
        border-radius: 8px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        margin-right: 12px;
        font-size: 16px;
    }
    .section-title { font-size: 18px; font-weight: 600; color: #009efb; margin-bottom: 0; }

    .form-group label { font-weight: 500; color: #333; margin-bottom: 8px; }

    .profile-upload { display: flex; align-items: center; gap: 20px; }
    .profile-upload .upload-img img { 
        border-radius: 50%; 
        object-fit: cover; 
        width: 90px; 
        height: 90px; 
        border: 4px solid #fff; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
    }

    .btn-primary.submit-btn { 
        background: #009efb; 
        border: none; 
        border-radius: 50px; 
        padding: 12px 35px; 
        font-size: 16px; 
        font-weight: 600; 
        box-shadow: 0 4px 10px rgba(0,158,251,0.3);
        transition: transform 0.2s;
    }
    .btn-primary.submit-btn:hover { transform: translateY(-2px); background: #0089d9; }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2 text-center mb-4">
        <h4 class="page-title" style="font-weight: 700; color: #333;">
            <i class="fa fa-user-plus text-primary mr-2"></i> Register New Patient
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                <h6 class="alert-heading font-weight-bold"><i class="fa fa-exclamation-triangle"></i> Please fix the errors!</h6>
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
            
            {{-- القسم الأول: المعلومات الشخصية --}}
            <div class="card-box">
                <div class="section-header">
                    <i class="fa fa-user"></i>
                    <h3 class="section-title">Personal Information</h3>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="firstname" value="{{ old('firstname') }}" placeholder="John" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Doe">
                        </div>
                    </div>
                    
                    {{-- تعديل حقل الـ Gender والـ Age والـ Phone ليكونوا في صف واحد متناسق --}}
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" class="form-control" name="age" value="{{ old('age') }}" placeholder="Ex: 25">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="select form-control" name="gender">
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="01xxxxxxxxx">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Residential Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Street name, City">
                        </div>
                    </div>
                </div>

                {{-- القسم الثاني: بيانات الحساب --}}
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

                {{-- القسم الثالث: الصورة الشخصية --}}
                <div class="section-header mt-4">
                    <i class="fa fa-camera"></i>
                    <h3 class="section-title">Profile Picture</h3>
                </div>
                <div class="row">
                    <div class="col-sm-12">
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

            <div class="text-center mb-5">
                <button class="btn btn-primary submit-btn"><i class="fa fa-check mr-2"></i> Register Patient</button>
                <a href="{{ url('admin.patients') }}" class="btn btn-light ml-2 py-2 px-4 text-muted">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if ($('.select').length > 0) {
            $('.select').select2({
                minimumResultsForSearch: -1,
                width: '100%'
            });
        }
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview_img');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
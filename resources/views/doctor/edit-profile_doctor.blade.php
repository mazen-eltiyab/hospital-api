@extends('layouts.doctor')

@section('content')
<div class="page-wrapper custom-wrapper-fix">
    <div class="content d-flex justify-content-center align-items-start py-5">
        
        <div class="profile-edit-container">
            
            <div class="text-center mb-5">
                <h2 class="display-5 font-weight-bold text-dark">Edit Profile</h2>
                <p class="text-muted">Manage your personal information and digital identity</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-15">
                    <ul class="mb-0 small p-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card border-0 shadow-lg rounded-25 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('doctor.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-5">
                            <div class="position-relative d-inline-block">
                                <img src="{{ !empty($doctor->avatar) ? asset('assets/img/' . $doctor->avatar) : asset('assets/img/user.jpg') }}" 
                                     id="preview" class="avatar-premium shadow">
                                <label for="file-input" class="upload-icon-badge">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <input id="file-input" name="avatar" type="file" hidden onchange="previewImage(this)"/>
                            </div>
                            <div class="mt-3 text-secondary small font-weight-bold">Update Profile Picture</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="field-label">First Name</label>
                                <input type="text" name="firstname" class="form-control premium-input" 
                                       value="{{ old('firstname', $doctor->firstname) }}" required placeholder="First name">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="field-label">Last Name</label>
                                <input type="text" name="lastname" class="form-control premium-input" 
                                       value="{{ old('lastname', $doctor->lastname) }}" required placeholder="Last name">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="field-label">Phone Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0 rounded-left-15"><i class="fa fa-phone text-muted"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control premium-input border-left-0" 
                                           value="{{ old('phone', $doctor->phone ?? '') }}" placeholder="Enter mobile number">
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="field-label opacity-50">Email Address (Fixed)</label>
                                <input type="email" name="email" class="form-control premium-input bg-light" 
                                       value="{{ $doctor->email }}" readonly>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="field-label">Clinic Address</label>
                                <textarea name="address" class="form-control premium-input" rows="3" placeholder="Where is your clinic located?">{{ old('address', $doctor->address ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-5 gap-3">
                            <button type="submit" class="btn btn-save-premium order-md-2">
                                <i class="fa fa-check mr-2"></i> Save Changes
                            </button>
                            <a href="{{ url('/doctor/my-profile') }}" class="btn btn-cancel-premium order-md-1">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* هذا الجزء هو الأهم لتوسيط الصفحة تماماً 
       يجبر الـ content على التمدد وتوسيط ما بداخله 
    */
    .custom-wrapper-fix {
        min-height: 100vh;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
    }

    .profile-edit-container {
        width: 100%;
        max-width: 700px; /* هذا يضمن أن النموذج لن يتمدد بشكل قبيح */
        margin: 0 auto;  /* يضمن التوسط الأفقي */
    }

    /* الوان وتنسيقات احترافية */
    .bg-clean { background-color: #f4f7f6; }
    .rounded-25 { border-radius: 25px !important; }
    .rounded-left-15 { border-top-left-radius: 15px !important; border-bottom-left-radius: 15px !important; }

    /* صورة البروفايل السكويركل (المربعة المنحنية) */
    .avatar-premium {
        width: 150px;
        height: 150px;
        border-radius: 45px;
        object-fit: cover;
        border: 6px solid #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .upload-icon-badge {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: #212529;
        color: white;
        width: 42px;
        height: 42px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 3px solid #fff;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .upload-icon-badge:hover { transform: scale(1.1); background: #000; }

    /* حقول الإدخال */
    .field-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #adb5bd;
        margin-bottom: 8px;
        padding-left: 5px;
    }

    .premium-input {
        border: 2px solid #f1f3f5;
        border-radius: 15px;
        padding: 12px 20px;
        font-size: 1rem;
        height: auto;
        transition: all 0.2s;
        background-color: #fbfcfd;
    }

    .premium-input:focus {
        border-color: #212529;
        background-color: #fff;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        outline: none;
    }

    /* الأزرار */
    .btn-save-premium {
        background: #212529;
        color: white;
        padding: 14px 45px;
        border-radius: 15px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        min-width: 220px;
    }
    .btn-save-premium:hover {
        background: #000;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .btn-cancel-premium {
        color: #6c757d;
        font-weight: 600;
        text-decoration: none;
        padding: 10px 20px;
    }
    .btn-cancel-premium:hover { color: #212529; }

    .gap-3 { gap: 1rem; }

    /* للهواتف */
    @media (max-width: 768px) {
        .profile-edit-container { padding: 15px; }
        .btn-save-premium { width: 100%; }
    }
</style>
@endpush

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).hide().fadeIn(500);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
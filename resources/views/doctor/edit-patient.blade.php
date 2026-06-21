@extends('layouts.doctor')

@section('content')

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Edit Patient Profile: <span class="text-muted">{{ $patient->firstname }} {{ $patient->lastname }}</span></h4>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show col-lg-8 offset-lg-2">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('admin.update-patient', $patient->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-box">
                <div class="section-title"><i class="fa fa-id-card-o"></i> Personal Information</div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="firstname" value="{{ old('firstname', $patient->firstname) }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="lastname" value="{{ old('lastname', $patient->lastname) }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone', $patient->phone) }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" class="form-control" name="age" value="{{ old('age', $patient->age) }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="select" name="gender">
                                <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Home Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address', $patient->address) }}">
                        </div>
                    </div>
                </div>

                <div class="section-title mt-4"><i class="fa fa-image"></i> Profile Media</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="profile-upload">
                            <div class="upload-img">
                                <img id="avatar_preview" alt="Patient Avatar" src="{{ asset('assets/img/' . ($patient->avatar ?? 'user.jpg')) }}">
                            </div>
                            <div class="upload-input">
                                <label>Change Photo</label>
                                <input type="file" class="form-control" name="avatar" onchange="previewImage(this)">
                                <small class="text-muted">Recommended: Square image, max 2MB.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-t-20 text-center">
                <a href="{{ route('admin.patients') }}" class="btn btn-secondary submit-btn m-r-10">Cancel</a>
                <button class="btn btn-warning submit-btn text-white">Update Patient Data</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
<style>
    .card-box { border-top: 3px solid #ff9b44; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); padding: 30px; }
    .section-title { font-size: 18px; font-weight: bold; color: #ff9b44; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
    .submit-btn { min-width: 180px; border-radius: 50px; padding: 10px 20px; font-weight: bold; }
    .profile-upload { display: flex; align-items: center; gap: 20px; }
    .profile-upload .upload-img img { border-radius: 50%; object-fit: cover; width: 100px; height: 100px; border: 3px solid #eee; }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#avatar_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    $('.select').select2({ width: '100%' });
});
</script>
@endpush
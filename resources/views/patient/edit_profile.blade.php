@extends('layouts.patient')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title mb-4">Edit Personal Information</h4>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="card">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('patient.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center">
                        <div class="profile-upload">
                            <img src="{{ !empty($patient->avatar) ? asset('assets/img/' . $patient->avatar) : asset('assets/img/user.jpg') }}" id="preview">
                            <label for="file-input" class="change-photo-btn">
                                <i class="fa fa-camera"></i>
                            </label>
                            <input id="file-input" name="avatar" type="file" style="display: none;" onchange="previewImage(this)"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly style="background: #f8f9fa;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->phone ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Home Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ old('address', $patient->address ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-save shadow">
                            <i class="fa fa-check mr-2"></i> Save Changes
                        </button>
                        <a href="{{ route('patient.profile') }}" class="btn btn-light btn-rounded ml-2" style="padding: 12px 25px; border-radius: 50px; border: 1px solid #ddd;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body { background-color: #f5f7fb; }
    .card { border: none; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .form-control { border-radius: 10px; padding: 12px 15px; border: 1px solid #e3e3e3; height: auto; }
    .form-control:focus { border-color: #009efb; box-shadow: none; }
    label { font-weight: 600; color: #495057; margin-bottom: 8px; }
    .btn-save { background: #009efb; border: none; padding: 12px 35px; border-radius: 50px; font-weight: 700; color: #fff; transition: all 0.3s; }
    .btn-save:hover { background: #0086d6; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,158,251,0.3); color: #fff; }
    .profile-upload { position: relative; display: inline-block; margin-bottom: 25px; }
    .profile-upload img { width: 130px; height: 130px; border-radius: 50%; object-fit: cover; border: 5px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .change-photo-btn { position: absolute; bottom: 5px; right: 5px; background: #009efb; color: #fff; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 2px solid #fff; }
</style>
@endpush

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
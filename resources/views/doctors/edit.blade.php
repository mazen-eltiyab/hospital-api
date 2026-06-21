@extends('layouts.app')

@section('title', 'Edit Doctor - MediCare')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Edit Doctor</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input class="form-control" name="first_name" type="text" value="{{ $doctor->first_name }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" name="last_name" type="text" value="{{ $doctor->last_name }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input class="form-control" name="username" type="text" value="{{ $doctor->username }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input class="form-control" name="email" type="email" value="{{ $doctor->email }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" name="phone" type="text" value="{{ $doctor->phone }}">
                    </div>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn" type="submit">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
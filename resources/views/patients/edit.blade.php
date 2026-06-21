@extends('layouts.app')
@section('title', 'Edit Patient - MediCare')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Edit Patient</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input class="form-control" name="first_name" type="text" value="{{ $patient->first_name }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" name="last_name" type="text" value="{{ $patient->last_name }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input class="form-control" name="username" type="text" value="{{ $patient->username }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input class="form-control" name="email" type="email" value="{{ $patient->email }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" name="phone" type="text" value="{{ $patient->phone }}">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $patient->address }}">
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
@extends('layouts.app')
@section('title', 'Add Doctor - MediCare')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Add Doctor</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input class="form-control" name="first_name" type="text" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" name="last_name" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input class="form-control" name="username" type="text" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input class="form-control" name="email" type="email" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input class="form-control" name="password" type="password" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" name="phone" type="text">
                    </div>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Create Doctor</button>
            </div>
        </form>
    </div>
</div>
@endsection
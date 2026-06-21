@extends('layouts.app')
@section('title', 'Settings - MediCare')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('settings.store') }}" method="POST">
            @csrf
            <h3 class="page-title">Company Settings</h3>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Company Name <span class="text-danger">*</span></label>
                        <input class="form-control" name="company_name" type="text" value="{{ $setting->company_name ?? '' }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contact Person</label>
                        <input class="form-control" name="contact_person" type="text" value="{{ $setting->contact_person ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Address</label>
                        <input class="form-control" name="address" type="text" value="{{ $setting->address ?? '' }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label>Country</label>
                        <input class="form-control" name="country" type="text" value="{{ $setting->country ?? '' }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label>City</label>
                        <input class="form-control" name="city" type="text" value="{{ $setting->city ?? '' }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label>State/Province</label>
                        <input class="form-control" name="state" type="text" value="{{ $setting->state ?? '' }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input class="form-control" name="postal_code" type="text" value="{{ $setting->postal_code ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" value="{{ $setting->email ?? '' }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input class="form-control" name="phone_number" type="text" value="{{ $setting->phone_number ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center m-t-20">
                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
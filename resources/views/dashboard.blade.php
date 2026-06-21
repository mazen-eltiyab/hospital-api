@extends('layouts.app')

@section('title', 'Dashboard - MediCare')

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $doctorCount }}</h3>
                <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $patientCount }}</h3>
                <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-calendar" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $appointmentCount }}</h3>
                <span class="widget-title3">Total Appt <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $pendingAppointments }}</h3>
                <span class="widget-title4">Active <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
</div>
@endsection
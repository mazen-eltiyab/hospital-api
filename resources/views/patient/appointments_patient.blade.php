@extends('layouts.patient')

@section('title', 'My Appointments')

@push('styles')
<style>
    .appointment-item {
        border-left: 5px solid #009efb;
        transition: 0.3s;
        border-radius: 8px;
        margin-bottom: 1rem !important;
        padding: 1rem !important;
    }
    .appointment-item:hover {
        transform: scale(1.01);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .doctor-img-circle {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #eee;
        flex-shrink: 0;
    }
    @media (max-width: 767px) {
        .doctor-img-circle { width: 48px; height: 48px; }
        .appointment-item .col-8,
        .appointment-item .col-4 {
            flex: 0 0 100%;
            max-width: 100%;
            text-align: left !important;
            margin-top: 10px;
        }
        .appointment-item .col-8 { margin-top: 0; }
        .appointment-item .col-4.text-right { text-align: left !important; padding-left: 15px; }
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-4 col-12">
        <h4 class="page-title">My Appointments</h4>
    </div>
    <div class="col-sm-8 col-12 text-right m-b-20">
        <a href="{{ url('book_appointments') }}" class="btn btn-primary btn-rounded">
            <i class="fa fa-plus"></i> Add Appointment
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="appointment-list">
            @if(isset($appointments) && $appointments->count() > 0)
                @php $sortedAppointments = $appointments->sortBy('created_at'); @endphp
                @foreach($sortedAppointments as $appointment)
                    @php
                        $doctor = $appointment->doctor;
                        $doctorImage = ($doctor && $doctor->avatar) ? $doctor->avatar : 'user.jpg';
                        $doctorName = $doctor ? ($doctor->firstname . ' ' . $doctor->lastname) : ($appointment->doctor_name ?? 'N/A');
                    @endphp
                    <div class="appointment-item card p-3 mb-3 shadow-sm">
                        <div class="row align-items-start">
                            <div class="col-12 col-md-8 d-flex align-items-center">
                                <img src="{{ asset('assets/img/' . $doctorImage) }}" class="doctor-img-circle mr-3" onerror="this.src='{{ asset('assets/img/user.jpg') }}'">
                                <div>
                                    <h6 class="mb-0 doctor-name-row" style="font-weight: 700; display: flex; align-items: center; gap: 4px; direction: ltr;">
                                        <span class="doctor-prefix">Dr.</span><span class="doctor-name-text">{{ $doctorName }}</span>
                                    </h6>
                                    <small class="text-muted">{{ $appointment->department ?? 'General' }}</small><br>
                                    <span class="badge badge-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($appointment->status ?? 'pending') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 text-md-right mt-3 mt-md-0">
                                <p class="mb-1 text-dark font-weight-bold">📅 {{ $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') : 'N/A' }}</p>
                                <p class="mb-2 text-dark">⏰ {{ $appointment->start_time ? \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') : 'N/A' }}</p>
                                @if($appointment->status != 'cancelled')
                                    <button class="btn btn-sm btn-outline-danger" onclick="openDeleteModal({{ $appointment->id }})">Cancel</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <img src="{{ asset('assets/img/sent.png') }}" width="80" style="opacity: 0.5;">
                    <h5 class="text-muted mt-3">No appointments found.</h5>
                </div>
            @endif
        </div>
    </div>
</div>

<div id="delete_appointment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{ asset('assets/img/sent.png') }}" width="50">
                <h3 class="mt-3">Cancel Appointment?</h3>
                <div class="m-t-20">
                    <button type="button" class="btn btn-white" data-dismiss="modal">No</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Yes, Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let selectedId = null;
    window.openDeleteModal = function(id) {
        selectedId = id;
        $('#delete_appointment').modal('show');
    }
    $('#confirmDeleteBtn').click(function() {
        if (selectedId) {
            $.ajax({
                url: '/appointments/' + selectedId,
                type: 'DELETE',
                data: { "_token": "{{ csrf_token() }}" },
                success: function() { location.reload(); },
                error: function() { alert('Error cancelling appointment'); }
            });
        }
    });
});
</script>
@endpush
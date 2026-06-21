@extends('layouts.doctor')

@section('content')

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Add New Appointment</h4>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Patient <span class="text-danger">*</span></label>
                            <select class="select" name="patient_id" required>
                                <option value="">Select Patient</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->firstname }} {{ $patient->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service <span class="text-danger">*</span></label>
                            <select class="select" id="service_select" name="service_id" required>
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Doctor <span class="text-danger">*</span></label>
                            <select class="select" id="doctor_select" name="doctor_id" required>
                                <option value="">Select Service First</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input type="text" id="date_picker" name="appointment_date" class="form-control datetimepicker" autocomplete="off" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Available Slots <span class="text-danger">*</span></label>
                            <select class="select" id="time_slots" name="start_time" required>
                                <option value="">Select Date & Doctor First</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="display-block">Appointment Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="pending" checked>
                                <label class="form-check-label">Pending</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Create Appointment</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<style>
    .form-group label { font-weight: 600; color: #333; }
    .card-box { border-top: 3px solid #009efb; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 10px; }
    .page-title { margin-bottom: 25px; font-weight: bold; color: #1a3d6d; }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('.select').select2({ width: '100%' });

    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: moment().startOf('day'),
        icons: { up: "fa fa-angle-up", down: "fa fa-angle-down", next: 'fa fa-angle-right', previous: 'fa fa-angle-left' }
    });

    function fetchSlots() {
        var doctorId = $('#doctor_select').val();
        var date = $('#date_picker').val();

        if (doctorId && date) {
            $.ajax({
                url: "{{ route('get.slots') }}",
                type: 'GET',
                data: { doctor_id: doctorId, date: date },
                success: function (data) {
                    var options = '<option value="">Select Time</option>';
                    if (data.length > 0) {
                        $.each(data, function (index, slot) {
                            options += '<option value="' + slot + '">' + slot + '</option>';
                        });
                    } else {
                        options = '<option value="">No slots available</option>';
                    }
                    $('#time_slots').html(options).trigger('change');
                }
            });
        }
    }

    $('#service_select').on('change', function() {
        var serviceId = $(this).val();
        if (serviceId) {
            $.get("{{ route('get.doctors.by.service') }}", { service_id: serviceId }, function(data) {
                var options = '<option value="">Select Doctor</option>';
                $.each(data, function(i, doc) {
                    options += '<option value="'+doc.id+'">Dr. '+doc.firstname+' '+doc.lastname+'</option>';
                });
                $('#doctor_select').html(options).trigger('change');
            });
        }
    });

    $('#doctor_select').on('change', fetchSlots);
    $('#date_picker').on('dp.change change blur', fetchSlots);
});
</script>
@endpush
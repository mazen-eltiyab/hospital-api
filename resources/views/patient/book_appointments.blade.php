@extends('layouts.patient')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Reserve Your Slot</h4>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" id="bookingForm">
            @csrf
            <div class="card-box">
                <div class="selected-info">
                    <strong>Booking For:</strong> {{ Auth::user()->name }}
                    <input type="hidden" name="patient_id" value="{{ Auth::user()->id }}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Speciality <span class="text-danger">*</span></label>
                            <select class="select notranslate" name="service_id" id="service_select" translate="no" required>
                                <option value="">Select Speciality</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" data-id="{{ $service->id }}">
                                        {{ $service->service_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Doctor <span class="text-danger">*</span></label>
                            <select class="select notranslate" name="doctor_id" id="doctor_select" translate="no" required>
                                @if(isset($preSelectedDoctor))
                                    <option value="{{ $preSelectedDoctor->id }}" data-id="{{ $preSelectedDoctor->id }}" selected>
                                        dr. {{ $preSelectedDoctor->firstname }} {{ $preSelectedDoctor->lastname }}
                                    </option>
                                @else
                                    <option value="">Select Speciality First</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input type="text" name="appointment_date" id="date_picker" class="form-control datetimepicker" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Available Time Slots <span class="text-danger">*</span></label>
                            <select class="select notranslate" name="start_time" id="time_slots" translate="no" required>
                                <option value="">Select Date & Doctor First</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-t-20 text-center">
                <button type="submit" class="btn btn-primary submit-btn" id="submitBtn">Confirm Appointment</button>
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
    .submit-btn { min-width: 200px; border-radius: 50px; padding: 10px 20px; }
    .card-box { border-top: 3px solid #1a3d6d; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 10px; }
    .page-title { margin-bottom: 25px; font-weight: bold; color: #1a3d6d; }
    .selected-info { background: #eef2f7; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #1a3d6d; }
    
    /* منع ترجمة جوجل لعناصر القوائم */
    .notranslate, 
    .select2-container, 
    .select2-results__option, 
    .select2-selection__rendered {
        translate: no !important;
        google-translate-attribute: "no" !important;
    }
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

    function getRealId(selectId) {
        var opt = $('#' + selectId + ' option:selected');
        return opt.attr('data-id') || opt.val();
    }

    function fetchSlots() {
        $('#slots-message').remove();
        var doctorId = getRealId('doctor_select');
        var date = $('#date_picker').val();

        if (doctorId && date && doctorId !== "") {
            $('#time_slots').html('<option value="">Loading...</option>').trigger('change');
            
            $.ajax({
                url: "{{ route('get.slots') }}",
                type: 'GET',
                data: { doctor_id: doctorId, date: date },
                success: function (data) {
                    var options = '<option value="">Select Time</option>';
                    if (data.length > 0) {
                        $.each(data, function (index, slot) {
                            options += '<option value="'+slot+'" data-id="'+slot+'" class="notranslate" translate="no">'+slot+'</option>';
                        });
                        $('#time_slots').html(options).trigger('change');
                        $('#submitBtn').prop('disabled', false);
                    } else {
                        $('#time_slots').html('<option value="">No slots available</option>').trigger('change');
                        $('#submitBtn').prop('disabled', true);
                    }
                }
            });
        }
    }

    $('#service_select').on('change', function() {
        var serviceId = getRealId('service_select');
        if (serviceId) {
            $.get("{{ route('get.doctors.by.service') }}", { service_id: serviceId }, function(data) {
                var options = '<option value="">Select Doctor</option>';
                $.each(data, function(i, doc) {
                    // تحويل اللقب لـ "د." بالعربي
                    var fullName = 'dr. ' + doc.firstname + ' ' + doc.lastname;
                    options += '<option value="'+doc.id+'" data-id="'+doc.id+'" class="notranslate" translate="no">'+fullName+'</option>';
                });
                $('#doctor_select').html(options).trigger('change');
            });
        }
    });

    $('#doctor_select, #date_picker').on('change dp.change', function() {
        fetchSlots();
    });

    $('#bookingForm').on('submit', function(e) {
        var timeSlot = getRealId('time_slots');
        if (!timeSlot || timeSlot === "") {
            e.preventDefault();
            alert('Please select a time slot.');
        } else {
            $('#time_slots').val(timeSlot);
        }
    });

    if (getRealId('doctor_select')) {
        if(!$('#date_picker').val()) $('#date_picker').val(moment().format('YYYY-MM-DD'));
        fetchSlots();
    }
});
</script>
@endpush
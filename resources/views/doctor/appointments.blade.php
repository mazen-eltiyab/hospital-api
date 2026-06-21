@extends('layouts.doctor')

@section('content')

<div class="row align-items-center m-b-20">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">My Appointments</h4>
    </div>
    <div class="col-sm-8 col-9 text-right">
        <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-rounded float-right">
            <i class="fa fa-plus"></i> Add Appointment
        </a>
    </div>
</div>

{{-- Stats Card --}}
<div class="row m-b-20">
    <div class="col-md-3 col-sm-6">
        <div style="background: linear-gradient(135deg, #1a3d6d, #2c7da0); border-radius: 15px; padding: 20px 25px; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(26,61,109,0.25); margin-bottom: 20px;">
            <div style="background: rgba(255,255,255,0.15); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa fa-calendar-check-o" style="font-size: 26px; color: #ffffff;"></i>
            </div>
            <div>
                <p style="color: rgba(255,255,255,0.75); font-size: 13px; margin: 0 0 4px;">Total Appointments</p>
                <h3 style="color: #ffffff; font-size: 30px; font-weight: 700; margin: 0; line-height: 1;">
                    {{ $appointments->count() }}
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr id="row-{{ $appointment->id }}">
                            <td>APT-{{ $appointment->id }}</td>
                            <td>{{ $appointment->patient_name ?? ($appointment->patient->firstname ?? 'N/A') }}</td>
                            <td>{{ $appointment->department }}</td>
                            <td>
                                <span style="font-weight: bold;">📅 {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</span>
                            </td>
                            <td>
                                <span>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</span>
                            </td>
                            <td>
                                <select class="status-select status-badge {{ $appointment->status }}" data-id="{{ $appointment->id }}">
                                    <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                            <td class="text-right">
                                <button class="btn btn-outline-danger btn-sm delete-appointment" data-id="{{ $appointment->id }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .btn-primary.btn-rounded {
        border-radius: 50px;
        padding: 8px 25px;
        font-weight: 500;
        border: none;
        color: #fff !important;
        box-shadow: 0 4px 6px rgba(0, 158, 251, 0.2);
        transition: all 0.3s ease;
    }
    .btn-primary.btn-rounded:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 158, 251, 0.3);
    }
    .page-title { margin-bottom: 0 !important; }
    .m-b-20 { margin-bottom: 20px; }
    .status-badge {
        border-radius: 4px; font-size: 13px; font-weight: 500;
        padding: 2px 5px; height: 32px; width: 110px; border: none;
        color: #fff !important; cursor: pointer; transition: all 0.3s ease;
    }
    .status-badge.pending { background-color: #ff9800 !important; }
    .status-badge.confirmed { background-color: #55ce63 !important; }
    .status-badge.cancelled { background-color: #f62d51 !important; }
    .status-badge option { background: #fff; color: #333; }
    .card-box {
        background-color: #fff;
        border: 1px solid #eaeaea;
        border-radius: 5px;
        padding: 20px;
        position: relative;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,0.1);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $(document).on('change', '.status-select', function() {
        var selectElement = $(this);
        var status = selectElement.val();
        var id = selectElement.data('id');
        selectElement.removeClass('pending confirmed cancelled').addClass(status);

        $.ajax({
            url: "{{ route('appointments.updateStatus') }}",
            method: "POST",
            data: { _token: "{{ csrf_token() }}", id: id, status: status },
            success: function(response) { console.log("Updated ID: " + id); },
            error: function() { alert('Error updating status'); }
        });
    });

    $(document).on('click', '.delete-appointment', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f62d51',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/appointments/" + id,
                    method: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        row.fadeOut(500, function() { $(this).remove(); });
                        Swal.fire('Deleted!', 'The appointment has been deleted.', 'success');
                    }
                });
            }
        });
    });
});
</script>
@endpush
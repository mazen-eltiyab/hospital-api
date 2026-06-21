@extends('layouts.admin')

@section('title', 'Appointments - MediCare')

@push('styles')
<style>
    .status-badge {
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        padding: 5px 10px;
        color: #fff !important;
        display: inline-block;
        min-width: 90px;
        text-align: center;
    }
    .status-badge.pending { background-color: #ff9800 !important; }
    .status-badge.confirmed { background-color: #55ce63 !important; }
    .status-badge.cancelled { background-color: #f62d51 !important; }
    
    .appointment-date { font-weight: 600; color: #1a3d6d; display: block; }
    .appointment-time { color: #6b7a8d; font-size: 13px; }
    
    .custom-table thead tr { background-color: #f8f9fb; }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Appointments</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-rounded float-right">
            <i class="fa fa-plus"></i> Add Appointment
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $i)
                    <tr id="row-{{ $i->id }}">
                        <td><a href="#" style="font-weight: 600;">APT-{{ $i->id }}</a></td>
                        <td>{{ $i->patient_name ?? ($i->patient->firstname ?? 'N/A') }}</td>
                        <td>Dr. {{ $i->doctor_name ?? 'Not Assigned' }}</td>
                        <td>{{ $i->department }}</td>
                        <td>
                            <span class="appointment-date">
                                <i class="fa fa-calendar-check-o m-r-5"></i> 
                                {{ \Carbon\Carbon::parse($i->appointment_date)->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="appointment-time">
                                <i class="fa fa-clock-o m-r-5"></i>
                                {{ \Carbon\Carbon::parse($i->start_time)->format('h:i A') }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge {{ strtolower($i->status) }}">
                                {{ ucfirst($i->status) }}
                            </span>
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item btn-delete" href="#" data-id="{{ $i->id }}">
                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var row = $('#row-' + id);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f62d51',
            cancelButtonColor: '#6c757d',
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
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });
</script>
@endpush
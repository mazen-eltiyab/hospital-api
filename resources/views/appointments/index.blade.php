@extends('layouts.app')
@section('title', 'Appointments - MediCare')

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Appointments</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('appointments.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Appointment</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->appointment_id }}</td>
                        <td><img width="28" height="28" src="{{ asset('assets/img/user.jpg') }}" class="rounded-circle m-r-5" alt=""> {{ $appointment->patient->first_name }}</td>
                        <td>{{ $appointment->doctor->first_name }}</td>
                        <td>{{ $appointment->department }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <a class="dropdown-item" href="{{ route('appointments.edit', $appointment->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    
                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this appointment?');" style="cursor: pointer; background: none; border: none; width: 100%; text-align: left;">
                                            <i class="fa fa-trash-o m-r-5"></i> Delete
                                        </button>
                                    </form>
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
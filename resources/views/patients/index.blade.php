    @extends('layouts.app')
@section('title', 'Patients - MediCare')

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Patients</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('patients.create') }}" class="btn btn-primary btn-rounded float-right">
            <i class="fa fa-plus"></i> Add Patient
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-border table-striped custom-table datatable mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <td>
                            <img width="28" height="28" src="{{ asset('assets/img/user.jpg') }}" class="rounded-circle m-r-5" alt=""> 
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('patients.edit', $patient->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    
                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this patient?');" style="cursor: pointer; background: none; border: none; width: 100%; text-align: left;">
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
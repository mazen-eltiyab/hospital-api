@extends('layouts.app')

@section('title', 'Doctors - MediCare')

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Doctors</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('doctors.create') }}" class="btn btn-primary btn-rounded float-right">
            <i class="fa fa-plus"></i> Add Doctor
        </a>
    </div>
</div>

<div class="row doctor-grid">
    @foreach($doctors as $doctor)
    <div class="col-md-4 col-sm-4 col-lg-3">
        <div class="profile-widget">
            
            <div class="doctor-img">
                <a class="avatar" href="#"><img alt="" src="{{ asset('assets/img/user.jpg') }}"></a>
            </div>

            <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('doctors.edit', $doctor->id) }}">
                        <i class="fa fa-pencil m-r-5"></i> Edit
                    </a>
                    
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this doctor?');" style="cursor: pointer; background: none; border: none; width: 100%; text-align: left;">
                            <i class="fa fa-trash-o m-r-5"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <h4 class="doctor-name text-ellipsis">
                <a href="#">{{ $doctor->first_name }} {{ $doctor->last_name }}</a>
            </h4>
            <div class="doc-prof">Doctor</div>
            <div class="user-country">
                <i class="fa fa-envelope"></i> {{ $doctor->email }}
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection
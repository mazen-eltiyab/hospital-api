@extends('layouts.admin')

@section('title', 'Patients List - MediCare')

@section('content')
<style>
    .btn-report-text, .btn-report-file {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50px;
        padding: 4px 14px;
        font-size: 13px;
        font-weight: 600;
        height: 30px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        text-decoration: none !important;
        outline: none;
        border: 1px solid;
    }

    .btn-report-text {
        background-color: #f0faff;
        color: #126084;
        border-color: #d1eefc;
    }

    .btn-report-text:hover {
        background-color: #126084;
        color: #ffffff !important;
        border-color: #126084;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(18, 96, 132, 0.3);
    }

    .btn-report-file {
        background-color: #ffffff;
        color: #4b5563;
        border-color: #e5e7eb;
    }

    .btn-report-file:hover {
        background-color: #4b5563;
        color: #ffffff !important;
        border-color: #4b5563;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-report-text i, .btn-report-file i {
        margin-right: 6px;
        font-size: 12px;
    }

    .custom-table td {
        vertical-align: middle !important;
    }
    
    /* تنسيق إضافي لمودال الحذف */
    .modal-confirm { color: #636363; width: 400px; }
    .modal-confirm .modal-content { padding: 20px; border-radius: 15px; border: none; }
    .modal-confirm .modal-header { border-bottom: none; position: relative; }
    .modal-confirm h3 { text-align: center; font-size: 26px; margin: 30px 0 -10px; }
    .modal-confirm .close { position: absolute; top: -5px; right: -2px; }
    .modal-confirm .modal-body { text-align: center; }
    .modal-confirm .modal-footer { border: none; text-align: center; border-radius: 5px; font-size: 13px; padding: 10px 15px 25px; }
</style>

{{-- Alerts --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-check-circle m-r-5"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa fa-exclamation-triangle m-r-5"></i> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

{{-- Page Header --}}
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Patients</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('doctor.addd-patient') }}" class="btn btn-primary btn-rounded float-right">
            <i class="fa fa-plus"></i> Add Patient
        </a>
    </div>
</div>

{{-- Stats Card --}}
<div class="row m-b-20">
    <div class="col-md-3 col-sm-6">
        <div style="background: linear-gradient(135deg, #1a3d6d, #126084); border-radius: 15px; padding: 20px 25px; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(26,61,109,0.25);">
            <div style="background: rgba(255,255,255,0.15); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa fa-users" style="font-size: 26px; color: #ffffff;"></i>
            </div>
            <div>
                <p style="color: rgba(255,255,255,0.75); font-size: 13px; margin: 0 0 4px;">Total Patients</p>
                <h3 style="color: #ffffff; font-size: 30px; font-weight: 700; margin: 0; line-height: 1;">
                    {{ $patients->count() }}
                </h3>
            </div>
        </div>
    </div>
</div>

{{-- Filter Row --}}
<div class="row filter-row">
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus">
            <label class="focus-label">Patient Name</label>
            <input type="text" class="form-control floating" id="search_name">
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus">
            <label class="focus-label">Phone Number</label>
            <input type="text" class="form-control floating" id="search_phone">
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <button class="btn btn-block" id="btn_search" style="background-color: #1a3d6d; color: #fff; border-radius: 4px; height: 50px;">
            <i class="fa fa-search"></i> Search
        </button>
    </div>
</div>

{{-- Patients Table --}}
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-border table-striped custom-table datatable mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th style="width: 220px;">Medical Reports</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    @php
                        $report = (auth()->user()->role == 'admin')
                            ? $patient->medicalReports->last()
                            : $patient->medicalReports->where('doctor_id', auth()->id())->first();
                    @endphp
                    <tr>
                        <td>
                            <img width="28" height="28" src="{{ asset('assets/img/' . ($patient->avatar ?? 'user.jpg')) }}" class="rounded-circle m-r-5">
                            {{ $patient->firstname }} {{ $patient->lastname }}
                        </td>
                        <td>{{ $patient->age }} Years</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->user->email ?? $patient->email }}</td>

                        <td>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                @if($report && $report->report_content)
                                <button type="button" data-toggle="modal" data-target="#view_report_{{ $patient->id }}" class="btn-report-text">
                                    <i class="fa fa-file-text"></i> Text
                                </button>
                                @endif

                                @if($report && $report->file_path)
                                <a href="{{ asset($report->file_path) }}" target="_blank" class="btn-report-file">
                                    <i class="fa fa-download"></i> File
                                </a>
                                @endif
                            </div>
                        </td>

                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('admin.edit-patient', $patient->id) }}">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_patient_{{ $patient->id }}">
                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal View Report --}}
                    @if($report && $report->report_content)
                    <div id="view_report_{{ $patient->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 15px; border: none; overflow: hidden;">
                                <div class="modal-header" style="background: #1a3d6d; color: white;">
                                    <h4 class="modal-title" style="color: white;">Medical Report</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div style="background: #f8fafc; padding: 20px; border-radius: 10px; border-left: 5px solid #1a3d6d;">
                                        <p style="white-space: pre-wrap; margin: 0; color: #334155;">{{ $report->report_content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Modal Delete Patient --}}
                    <div id="delete_patient_{{ $patient->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 15px;">
                                <div class="modal-body text-center" style="padding: 30px;">
                                    <img src="{{ asset('assets/img/sent.png') }}" alt="" width="50" height="46" class="m-b-20">
                                    <h3 style="margin-bottom: 10px;">Delete Patient</h3>
                                    <p style="color: #777;">Are you sure you want to delete <strong>{{ $patient->firstname }}</strong>? This action cannot be undone.</p>
                                    <div class="m-t-20"> 
                                        <button type="button" class="btn btn-white btn-rounded" data-dismiss="modal" style="border: 1px solid #ccc; padding: 8px 25px;">Close</button>
                                        <form action="{{ route('admin.delete-patient', $patient->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-rounded" style="padding: 8px 25px;">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#btn_search').on('click', function() {
            var nameFilter = $('#search_name').val().toLowerCase().trim();
            var phoneFilter = $('#search_phone').val().toLowerCase().trim();

            $('.custom-table tbody tr').each(function() {
                // Column 1 is Name, Column 4 is Phone
                var rowName = $(this).find('td:eq(0)').text().toLowerCase();
                var rowPhone = $(this).find('td:eq(3)').text().toLowerCase();

                var nameMatch = rowName.includes(nameFilter) || nameFilter === '';
                var phoneMatch = rowPhone.includes(phoneFilter) || phoneFilter === '';

                if (nameMatch && phoneMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        // Optional: Trigger search when pressing Enter
        $('#search_name, #search_phone').on('keypress', function(e) {
            if (e.which == 13) {
                $('#btn_search').click();
            }
        });
    });
</script>
@endpush
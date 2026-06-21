@extends('layouts.doctor')

@section('content')

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h4 class="page-title">Patient Visits</h4>
    </div>
    <div class="col-md-6 text-md-right mt-2 mt-md-0">
        <a href="{{ route('doctor.addd-patient') }}" class="btn btn-add-patient">
            <i class="fa fa-plus-circle"></i> Add New Patient
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" style="border-radius: 16px;">
        <i class="fa fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

{{-- Stats Card --}}
<div class="row m-b-20">
    <div class="col-md-3 col-sm-6">
        <div style="background: linear-gradient(135deg, #1a3d6d, #2c7da0); border-radius: 15px; padding: 20px 25px; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(26,61,109,0.25); margin-bottom: 20px;">
            <div style="background: rgba(255,255,255,0.15); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa fa-users" style="font-size: 26px; color: #ffffff;"></i>
            </div>
            <div>
                <p style="color: rgba(255,255,255,0.75); font-size: 13px; margin: 0 0 4px;">Total Visits</p>
                <h3 style="color: #ffffff; font-size: 30px; font-weight: 700; margin: 0; line-height: 1;">
                    {{ $appointments->count() }}
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="patient-visit-card">
    <div class="table-responsive">
        <table class="table custom-table mb-0" id="visitsTable">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Patient</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Medical Reports</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                @php
                    $patient = $appointment->patient;
                    $report = \App\Models\MedicalReport::where('appointment_id', $appointment->id)->first();
                    $patientAvatar = ($patient && $patient->avatar) ? $patient->avatar : 'user.jpg';
                    $patientEmail = $patient->user->email ?? ($patient->email ?? 'N/A');
                @endphp
                <tr>
                    <td style="display:none;">{{ $appointment->id }}</td>
                    <td>
                        <div class="patient-name-cell">
                            <img class="patient-avatar" src="{{ asset('assets/img/'. $patientAvatar) }}" alt="avatar">
                            <div class="patient-info">
                                <div class="patient-name">{{ $patient->firstname }} {{ $patient->lastname }}</div>
                                <span class="visit-id-badge"><i class="fa fa-calendar-check-o"></i> Visit #{{ $appointment->id }}</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-light" style="font-size:0.85rem; background:#eef2ff;">{{ $patient->age ?? '—' }} yrs</span></td>
                    <td><i class="fa fa-map-marker text-muted mr-1"></i> {{ $patient->address ?? '—' }}</td>
                    <td><i class="fa fa-phone text-muted mr-1"></i> {{ $patient->phone ?? '—' }}</td>
                    <td><i class="fa fa-envelope-o text-muted mr-1"></i> {{ $patientEmail }}</td>

                    <td class="report-cell" style="white-space: nowrap;">
                        @if($report)
                            @if($report->report_content)
                                <button class="btn btn-outline-custom btn-text" data-toggle="modal" data-target="#view_report_{{ $appointment->id }}">
                                    <i class="fa fa-file-text-o"></i> Text
                                </button>
                            @endif
                            @if($report->file_path)
                                <a href="{{ asset($report->file_path) }}" class="btn btn-outline-custom btn-file" target="_blank">
                                    <i class="fa fa-download"></i> File
                                </a>
                            @endif
                            <a href="{{ route('doctor.edit-report', $report->id) }}?appointment_id={{ $appointment->id }}" class="btn btn-outline-custom btn-edit-custom">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                        @else
                            <a href="{{ route('doctor.add-report', $patient->id) }}?appointment_id={{ $appointment->id }}" class="btn btn-primary-sm text-white">
                                <i class="fa fa-plus"></i> Add Report
                            </a>
                        @endif
                    </td>

                    <td class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.edit-patient', $patient->id) }}">
                                    <i class="fa fa-pencil m-r-5"></i> Edit Patient Info
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>

                @if($report && $report->report_content)
                <div id="view_report_{{ $appointment->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-stethoscope"></i> Medical Report - {{ $patient->firstname }} {{ $patient->lastname }}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div style="background: #f8fafc; padding: 1rem; border-radius: 20px; border-left: 4px solid #2c7da0;">
                                    <p style="white-space: pre-wrap; color: #1e293b; line-height: 1.5;">{{ $report->report_content }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
<style>
    :root {
        --premium-blue: #2c7da0;
        --soft-bg: #f8fafc;
        --card-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.02);
        --border-radius-card: 1rem;
    }
    body { background: var(--soft-bg); }
    .patient-visit-card { background: #ffffff; border-radius: var(--border-radius-card); box-shadow: var(--card-shadow); border: 1px solid rgba(0,0,0,0.03); padding: 1.5rem 1.2rem; transition: all 0.2s ease; }
    .page-title { font-weight: 700; font-size: 1.65rem; color: #1e2a3e; letter-spacing: -0.3px; margin-bottom: 0; position: relative; display: inline-block; }
    .page-title:after { content: ''; position: absolute; bottom: -8px; left: 0; width: 48px; height: 3px; background: var(--premium-blue); border-radius: 4px; }
    .btn-add-patient { background: linear-gradient(105deg, #2c7da0 0%, #1f5e7a 100%); border: none; border-radius: 40px; padding: 8px 24px; font-weight: 600; font-size: 0.9rem; color: white; transition: all 0.25s; box-shadow: 0 2px 6px rgba(44,125,160,0.2); display: inline-flex; align-items: center; gap: 8px; }
    .btn-add-patient:hover { transform: translateY(-1px); background: linear-gradient(105deg, #236b8a 0%, #1a4f66 100%); box-shadow: 0 6px 14px rgba(44,125,160,0.25); color: white; }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .custom-table thead th { background: #f1f5f9; color: #1e293b; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 1px solid #e2e8f0; padding: 1rem 0.75rem; vertical-align: middle; }
    .custom-table tbody td { vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #edf2f7; color: #2d3e50; font-size: 0.9rem; }
    .custom-table tbody tr:hover { background-color: #fefef7; }
    .visit-id-badge { font-size: 0.7rem; background: #eef2ff; color: #2563eb; padding: 3px 8px; border-radius: 30px; display: inline-block; font-weight: 500; margin-top: 5px; }
    .patient-name-cell { display: flex; align-items: center; gap: 12px; }
    .patient-avatar { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 1px solid #e2e8f0; }
    .patient-info { line-height: 1.3; }
    .patient-name { font-weight: 600; color: #0f172a; }
    .btn-outline-custom { border-radius: 30px !important; padding: 4px 14px !important; font-size: 0.75rem !important; font-weight: 500 !important; margin: 2px 3px; transition: all 0.2s; }
    .btn-text { color: #0f6b8c; border-color: #bdd9e7; background: #f9fdfe; }
    .btn-text:hover { background-color: #e1f0f5; color: #095c78; border-color: #9ac2d4; }
    .btn-file { color: #4b5563; border-color: #d1d5db; background: #fafafc; }
    .btn-file:hover { background-color: #f1f3f5; color: #1f2937; }
    .btn-edit-custom { color: #2c7da0; border-color: #cbdde6; background: #fafeff; }
    .btn-edit-custom:hover { background-color: #e6f2f7; color: #1c5d7a; }
    .btn-primary-sm { border-radius: 30px; padding: 4px 16px; font-size: 0.75rem; font-weight: 500; background: #2c7da0; border: none; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .btn-primary-sm:hover { background: #236b8a; }
    .action-icon { font-size: 1.2rem; color: #94a3b8; transition: 0.2s; }
    .action-icon:hover { color: #2c7da0; }
    .modal-content { border-radius: 20px; border: none; box-shadow: 0 20px 35px -12px rgba(0,0,0,0.2); }
    .modal-header { border-bottom: 1px solid #eef2f6; background: #fefefe; padding: 1rem 1.5rem; }
    .modal-title { font-weight: 700; color: #1e293b; }
    .dataTables_wrapper .dataTables_filter input { border-radius: 30px; padding: 0.4rem 1rem; border: 1px solid #cbd5e1; background: white; }
    .dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: 30px; margin: 0 2px; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current { background: #2c7da0; border-color: #2c7da0; color: white !important; }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#visitsTable')) {
        $('#visitsTable').DataTable().destroy();
    }

    $('#visitsTable').DataTable({
        "bFilter": true,
        "paging": true,
        "pageLength": 10,
        "info": true,
        "order": [[0, "asc"]],
        "language": {
            "search": "🔍 Filter records:",
            "lengthMenu": "Show _MENU_ entries",
            "info": "Showing _START_ to _END_ of _TOTAL_ visits",
            "paginate": { "previous": "<", "next": ">" }
        },
        "columnDefs": [
            { "visible": false, "targets": [0] },
            { "orderable": false, "targets": [6, 7] }
        ]
    });
});
</script>
@endpush
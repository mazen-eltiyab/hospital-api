@extends('layouts.doctor')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="patient-header">
            <h4 class="page-title" style="margin:0;">Edit Medical Report for:
                <span class="text-primary">{{ $patient->firstname }} {{ $patient->lastname }}</span>
            </h4>
            <small class="text-muted">Report ID: #{{ $report->id }}</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card-box">
            <form action="{{ route('doctor.update-report', $report->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Medical Diagnosis / Report <span class="text-danger">*</span></label>
                    <textarea name="medical_report" class="form-control" rows="8" required>{{ old('medical_report', $report->report_content) }}</textarea>
                </div>

                @if($report->file_path)
                <div class="form-group">
                    <label>Current File</label>
                    <div class="current-file-preview">
                        <i class="fa fa-file text-primary"></i>
                        <a href="{{ asset($report->file_path) }}" target="_blank" class="ml-2">View Current File</a>
                        <span class="text-muted ml-2">(Upload new file to replace)</span>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label>Upload New Report File (Optional)</label>
                    <div class="custom-file">
                        <input type="file" name="report_file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file (PDF, JPG, PNG)</label>
                    </div>
                    <small class="form-text text-muted">Allowed: JPG, PNG, JPEG, PDF. Max size: 2MB.</small>
                </div>

                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">
                        <i class="fa fa-save"></i> Update Report
                    </button>
                    <a href="{{ route('doctor.patients') }}" class="btn btn-secondary submit-btn ml-2 text-white">
                        <i class="fa fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .card-box { background-color: #fff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 1px 15px rgba(0,0,0,0.05); padding: 20px; }
    .submit-btn { border-radius: 50px; padding: 10px 30px; font-weight: bold; }
    .patient-header { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-right: 5px solid #007bff; }
    .current-file-preview { background: #f0f8ff; padding: 10px 15px; border-radius: 8px; border: 1px dashed #009efb; display: inline-block; }
    .form-control:focus { border-color: #009efb; box-shadow: 0 0 0 0.2rem rgba(0,158,251,0.1); }
</style>
@endpush

@push('scripts')
<script>
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endpush
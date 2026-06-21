@extends('layouts.doctor')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="patient-header">
            <h4 class="page-title" style="margin:0;">Medical Report for:
                <span class="text-primary">{{ $patient->firstname }} {{ $patient->lastname }}</span>
            </h4>
            <small class="text-muted">Visit Reference ID: #{{ request('appointment_id') }}</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card-box">
            <form action="{{ route('doctor.store-report', $patient->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="appointment_id" value="{{ request('appointment_id') }}">

                <div class="form-group">
                    <label>Medical Diagnosis / Report <span class="text-danger">*</span></label>
                    <textarea name="medical_report" class="form-control" rows="8" placeholder="Enter patient diagnosis and medical notes here..." required>{{ old('medical_report', $myReport->report_content ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Upload Report File (Optional)</label>
                    <div class="custom-file">
                        <input type="file" name="report_file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file (PDF, JPG, PNG)</label>
                    </div>
                    <small class="form-text text-muted">Allowed: JPG, PNG, JPEG. Max size: 2MB.</small>
                </div>

                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">
                        <i class="fa fa-save"></i> Save & Complete Report
                    </button>
                    <a href="{{ route('doctor.patients') }}" class="btn btn-secondary submit-btn ml-2 text-white">Cancel</a>
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
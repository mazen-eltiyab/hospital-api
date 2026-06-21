@extends('layouts.patient')

@section('content')
<div class="medical-reports">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title mb-4">My Medical Records</h3>
        </div>
    </div>

    @if(isset($reports) && $reports->count() > 0)
        @foreach($reports as $report)
            @php
                $userDoc = \DB::table('users')->where('id', $report->doctor_id)->first();
                $drName = "Medical Specialist";
                if($userDoc) {
                    $drTable = \DB::table('doctors')->where('email', $userDoc->email)->first();
                    $drName = $drTable 
                        ? $drTable->firstname . " " . $drTable->lastname 
                        : $userDoc->name;
                }
                $filePath = $report->file_path ?? ($report->report_file ?? null);
                if ($filePath) {
                    if (strpos($filePath, 'assets') !== false || strpos($filePath, 'storage') !== false) {
                        $fileUrl = asset($filePath);
                    } else {
                        $fileUrl = asset('assets/img/reports/' . $filePath);
                    }
                } else {
                    $fileUrl = null;
                }
            @endphp

            <div class="report-summary-card">
                <div>


<h4 class="mb-0">
    <span class="dr-prefix-text" data-name="{{ $drName }}">{{ $drName }}</span>
</h4>
                    <p class="text-muted mb-0">
                        <i class="fa fa-calendar-check-o mr-1"></i> 
                        {{ date('D, d M Y', strtotime($report->created_at)) }}
                    </p>
                </div>
                <button class="btn btn-primary btn-rounded shadow-sm" 
                        data-toggle="modal" 
                        data-target="#reportModal_{{ $report->id }}">
                    <i class="fa fa-file-pdf-o"></i> View Details
                </button>
            </div>

            <div class="modal fade" id="reportModal_{{ $report->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content unified-report-content">
                        <div class="card-top-accent"></div>
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold">Medical Examination Report</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="doctor-info">
                                <div class="doctor-avatar"><i class="fa fa-user-md"></i></div>
                                <div>
                                    <h4 class="mb-0">
                                        <span class="dr-prefix-text" data-name="{{ $drName }}">Dr. {{ $drName }}</span>
                                    </h4>
                                    <small class="text-primary font-weight-bold">MediCare Certified Physician</small>
                                </div>
                            </div>

                            <div class="diagnosis-box">
                                <label class="badge badge-warning text-white">Clinical Diagnosis & Notes</label>
                                <p class="mt-2 mb-0 text-dark">
                                    {{ $report->report_content ?? ($report->midical_report ?? 'No clinical notes were recorded for this visit.') }}
                                </p>
                            </div>

                            @if($fileUrl)
                                <h6 class="font-weight-bold mb-3">
                                    <i class="fa fa-paperclip"></i> Attached Documents
                                </h6>
                                <div class="attachment-preview text-center">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="text-muted">Report_Ref_{{ $report->id }}</span>
                                        <a href="{{ $fileUrl }}" download class="btn btn-sm btn-primary">Download File</a>
                                    </div>
                                    <img src="{{ $fileUrl }}" class="preview-img" alt="Medical Scan">
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-info" onclick="window.print()">
                                <i class="fa fa-print"></i> Print Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-reports">
            <i class="fa fa-folder-open-o"></i>
            <h4>No Reports Available</h4>
            <p class="text-muted">Your reports will appear here after your doctor consultations.</p>
            <a href="{{ url('book_appointments') }}" class="btn btn-primary btn-rounded mt-3 px-4">
                Book an Appointment Now
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// 1. وظيفة برمجية تقوم بالبحث عن كل الأسماء وتضع اللقب المناسب حسب اللغة
function updateDoctorPrefixes() {
    var lang = localStorage.getItem('preferred_lang') || 'en';
    var prefix = (lang === 'ar') ? 'د. ' : 'Dr. ';

    $('.dr-prefix-text').each(function() {
        var name = $(this).data('name'); // يجلب الاسم الأصلي من الـ data attribute
        $(this).text(prefix + name);    // يضع اللقب + الاسم
    });
}

$(document).ready(function() {
    // 2. تشغيل الوظيفة فور تحميل الصفحة
    updateDoctorPrefixes();

    // 3. احتياطاً: تشغيلها بعد ثانية للتأكد من استقرار الترجمة
    setTimeout(updateDoctorPrefixes, 1000);
});
</script>
@endpush

@push('styles')
<style>
    body { background: #f5f7fb; font-family: "Segoe UI", sans-serif; }
    .medical-reports { padding: 30px; }

    .report-summary-card {
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: 0.3s;
        border-left: 5px solid #009efb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .report-summary-card:hover { transform: translateX(10px); }

    .unified-report-content { border-radius: 20px; overflow: hidden; border: none; }
    .card-top-accent { height: 8px; background: linear-gradient(90deg, #ff9f43, #009efb); }

    .doctor-info {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .doctor-avatar {
        width: 50px; height: 50px;
        background: #e3f2fd;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        color: #009efb;
        margin-right: 15px;
    }

    .diagnosis-box {
        background: #fcfaff;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        border-left: 4px solid #ff9f43;
    }

    .attachment-preview {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        border: 1px dashed #ddd;
    }
    .preview-img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-top: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .empty-reports {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .empty-reports i { font-size: 80px; color: #e0e0e0; margin-bottom: 20px; }
    .empty-reports h4 { color: #333; font-weight: 700; }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // تحديد البادئة حسب اللغة المحفوظة
    var prefix = (localStorage.getItem('preferred_lang') === 'ar') ? 'د. ' : 'Dr. ';

    // تطبيق البادئة على كل أسماء الأطباء
    $('.dr-prefix-text').each(function() {
        $(this).text(prefix + $(this).data('name'));
    });
});
</script>
@endpush
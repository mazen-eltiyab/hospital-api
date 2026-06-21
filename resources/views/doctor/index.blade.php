@extends('layouts.doctor')

@section('content')

{{-- Welcome Box --}}
<div class="welcome-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="mb-2">Welcome Back, Dr. {{ $doctor->firstname ?? 'Ahmed' }}!</h2>
            <p class="mb-0">You have {{ $totalAppointments ?? 12 }} appointments today. Keep up the great work!</p>
        </div>
        <div class="col-md-4 text-right d-none d-md-block">
            <button class="btn btn-outline-light rounded-pill">View Daily Schedule</button>
        </div>
    </div>
</div>

{{-- Stats Row --}}
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-content">
                <h3 id="appointmentCount">0</h3>
                <p>Today's Appointments</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-user-injured"></i></div>
            <div class="stat-content">
                <h3 id="patientCount">0</h3>
                <p>Total Patients</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon orange"><i class="fas fa-star"></i></div>
            <div class="stat-content">
                <h3 id="ratingValue">0.0</h3>
                <div class="rating" style="color: #f4a62a; font-size: 14px;" id="ratingStars"></div>
                <p>Doctor Rating</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-content">
                <h3>$3,420</h3>
                <p>Today's Earnings</p>
            </div>
        </div>
    </div>
</div>

{{-- Main Row --}}
<div class="row">
    <div class="col-lg-8">
        <div class="card p-3 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Patient Statistics (Weekly)</h5>
                <div>
                    <span class="badge-soft-primary me-2">New</span>
                    <span class="badge-soft-success">Recovered</span>
                </div>
            </div>
            <div id="weeklyChart"></div>
        </div>

        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Today's Appointments</h5>
                <a href="appointments.html" class="btn btn-sm btn-outline-primary rounded-pill">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="appointment-list">
                <div class="appointment-item">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/patient-thumb-01.jpg') }}" alt="Jennifer Ames" class="patient-img">
                        <div><h6 class="mb-0 fw-bold">Jennifer Ames</h6><small class="text-muted">28y · 10:00 AM</small></div>
                    </div>
                    <span class="badge-soft-primary">Confirmed</span>
                </div>
                <div class="appointment-item">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/patient-thumb-02.jpg') }}" alt="Mark Hay" class="patient-img">
                        <div><h6 class="mb-0 fw-bold">Mark Hay</h6><small class="text-muted">45y · 11:30 AM</small></div>
                    </div>
                    <span class="badge-soft-success">In Room</span>
                </div>
                <div class="appointment-item">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/user-02.jpg') }}" alt="Sarah Wilson" class="patient-img">
                        <div><h6 class="mb-0 fw-bold">Sarah Wilson</h6><small class="text-muted">32y · 1:00 PM</small></div>
                    </div>
                    <span class="badge-soft-warning">Waiting</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card p-3 mb-4">
            <h5 class="fw-bold mb-3">Recent Activities</h5>
            <div class="activity-timeline">
                <div class="activity-item">
                    <div class="activity-content">
                        <strong>Lab Report Ready</strong>
                        <p class="text-muted small mb-1">Patient: John Doe - CBC Test</p>
                        <span class="text-primary small">5 mins ago</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-content">
                        <strong style="color: #1bb394;">Appointment Canceled</strong>
                        <p class="text-muted small mb-1">Patient: Sarah Wilson</p>
                        <span class="text-primary small">1 hour ago</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-content">
                        <strong>New Appointment</strong>
                        <p class="text-muted small mb-1">Patient: Michael Brown</p>
                        <span class="text-primary small">3 hours ago</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-3 mb-4">
            <h5 class="fw-bold mb-3">Daily Goals</h5>
            <div class="task-progress"><span>Patients Visited</span> <strong>7/10</strong></div>
            <div class="progress progress-slim mb-4"><div class="progress-bar bg-primary" style="width:70%"></div></div>
            <div class="task-progress"><span>Reports Completed</span> <strong>4/8</strong></div>
            <div class="progress progress-slim mb-4"><div class="progress-bar bg-success" style="width:50%"></div></div>
            <div class="task-progress"><span>Prescriptions</span> <strong>12/15</strong></div>
            <div class="progress progress-slim"><div class="progress-bar bg-warning" style="width:80%"></div></div>
        </div>

        <div class="card p-3">
            <h5 class="fw-bold mb-3">Quick Actions</h5>
            <div class="row g-2">
                <div class="col-6"><a href="#" class="quick-action-btn"><i class="fas fa-calendar-plus mb-2 d-block"></i><span>New Appointment</span></a></div>
                <div class="col-6"><a href="#" class="quick-action-btn"><i class="fas fa-user-plus mb-2 d-block"></i><span>Add Patient</span></a></div>
                <div class="col-6"><a href="#" class="quick-action-btn"><i class="fas fa-file-prescription mb-2 d-block"></i><span>Prescription</span></a></div>
                <div class="col-6"><a href="#" class="quick-action-btn"><i class="fas fa-envelope mb-2 d-block"></i><span>New Message</span></a></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.css">
<style>
    body { background-color: #f3f6f9; }
    .welcome-box {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
        border-radius: 20px; color: #fff; padding: 30px; margin-bottom: 30px;
    }
    .welcome-box .btn-outline-light { border-color: rgba(255,255,255,0.5); color: #fff; border-radius: 50px; padding: 8px 25px; font-weight: 600; }
    .card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); transition: all 0.2s; }
    .card:hover { box-shadow: 0 15px 40px rgba(0,0,0,0.06); }
    .stat-card { display: flex; align-items: center; padding: 20px; border-radius: 20px; background: #fff; border: 1px solid #f0f2f7; }
    .stat-icon { width: 60px; height: 60px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 28px; margin-right: 18px; }
    .stat-icon.blue { background: linear-gradient(135deg, #2a7be4, #4a9eff); color: #fff; }
    .stat-icon.green { background: linear-gradient(135deg, #1bb394, #2ed8b6); color: #fff; }
    .stat-icon.orange { background: linear-gradient(135deg, #f4a62a, #f7c35c); color: #fff; }
    .stat-icon.purple { background: linear-gradient(135deg, #a55eea, #c798ff); color: #fff; }
    .stat-content h3 { font-size: 28px; font-weight: 700; margin: 0; color: #1e2b50; }
    .stat-content p { margin: 0; color: #7e8a9e; font-size: 14px; }
    .badge-soft-primary { background: #e2ecfe; color: #2a7be4; font-weight: 600; padding: 6px 12px; border-radius: 30px; }
    .badge-soft-success { background: #d4f5ed; color: #1bb394; font-weight: 600; padding: 6px 12px; border-radius: 30px; }
    .badge-soft-warning { background: #fef0d9; color: #f4a62a; font-weight: 600; padding: 6px 12px; border-radius: 30px; }
    .appointment-item { display: flex; align-items: center; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #f0f2f7; }
    .appointment-item:last-child { border-bottom: none; }
    .patient-img { width: 45px; height: 45px; border-radius: 15px; object-fit: cover; margin-right: 15px; }
    .quick-action-btn { width: 100%; border: 1px solid #e9ecf3; border-radius: 18px; padding: 18px 5px; background: #fff; color: #1e2b50; transition: 0.2s; font-weight: 600; display: block; text-align: center; }
    .quick-action-btn:hover { background: #f8faff; border-color: #2a7be4; color: #2a7be4; text-decoration: none; }
    .quick-action-btn i { font-size: 22px; color: #2a7be4; }
    .activity-timeline { position: relative; padding-left: 20px; }
    .activity-item { position: relative; padding-bottom: 22px; }
    .activity-item:before { content: ''; position: absolute; left: -8px; top: 5px; width: 12px; height: 12px; border-radius: 50%; background: #2a7be4; border: 2px solid #fff; box-shadow: 0 0 0 3px #e2ecfe; }
    .activity-item:after { content: ''; position: absolute; left: -3px; top: 20px; width: 2px; height: 100%; background: #e2ecfe; }
    .activity-item:last-child:after { display: none; }
    .activity-content { background: #f8faff; padding: 15px; border-radius: 18px; }
    .task-progress { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
    .progress-slim { height: 6px; border-radius: 20px; background-color: #e9ecf3; }
    #weeklyChart { min-height: 280px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script>
<script>
$(document).ready(function() {
    const finalRating = {{ isset($doctor->rating) ? number_format($doctor->rating, 1) : 4.7 }};
    const totalPatients = {{ $totalPatients ?? 1050 }};
    const totalAppointments = {{ $totalAppointments ?? 18 }};

    function updateStars(rating) {
        const starsContainer = document.getElementById('ratingStars');
        if (!starsContainer) return;
        const fullStars = Math.floor(rating);
        const hasHalf = (rating - fullStars) >= 0.5;
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= fullStars) starsHtml += '<i class="fas fa-star"></i>';
            else if (i === fullStars + 1 && hasHalf) starsHtml += '<i class="fas fa-star-half-alt"></i>';
            else starsHtml += '<i class="far fa-star"></i>';
        }
        starsHtml += `<span class="text-muted ms-1">(${rating.toFixed(1)})</span>`;
        starsContainer.innerHTML = starsHtml;
    }

    function animateValue(id, start, end, duration, isDecimal, callback) {
        const obj = document.getElementById(id);
        if (!obj) return;
        const range = end - start;
        const startTime = performance.now();
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            let currentValue = start + (range * progress);
            if (!isDecimal) currentValue = Math.floor(currentValue);
            obj.innerHTML = isDecimal ? currentValue.toFixed(1) : currentValue.toLocaleString();
            if (callback) callback(currentValue);
            if (progress < 1) requestAnimationFrame(update);
            else {
                obj.innerHTML = isDecimal ? end.toFixed(1) : end.toLocaleString();
                if (callback) callback(end);
            }
        }
        requestAnimationFrame(update);
    }

    animateValue("ratingValue", 0, finalRating, 2000, true, updateStars);
    animateValue("appointmentCount", 0, totalAppointments, 1500, false);
    animateValue("patientCount", 0, totalPatients, 2500, false);
    updateStars(finalRating);

    if (document.querySelector("#weeklyChart")) {
        new ApexCharts(document.querySelector("#weeklyChart"), {
            chart: { type: 'area', height: 280, toolbar: { show: false }, zoom: { enabled: false }, fontFamily: 'Inter, sans-serif' },
            series: [
                { name: 'New Patients', data: [12, 19, 15, 25, 22, 30, 10] },
                { name: 'Recovered', data: [8, 12, 20, 18, 28, 22, 15] }
            ],
            xaxis: { categories: ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'], labels: { style: { colors: '#7e8a9e' } } },
            yaxis: { labels: { style: { colors: '#7e8a9e' } } },
            colors: ['#2a7be4', '#1bb394'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.5, opacityTo: 0.1 } },
            legend: { show: false },
            tooltip: { theme: 'light' },
            grid: { borderColor: '#f0f2f7' }
        }).render();
    }
});
</script>
@endpush
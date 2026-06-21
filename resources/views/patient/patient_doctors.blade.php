@extends('layouts.patient')

@section('title', 'Find a Doctor')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style>
    body { background: #f4f6fb; }

    .page-header {
        background: linear-gradient(135deg, #1a3d6d, #2563a8);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .page-header h4 {
        color: #fff;
        font-size: 22px;
        font-weight: 800;
        margin: 0;
    }
    .page-header .doctor-count {
        background: rgba(255,255,255,0.2);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.3);
    }
    .filter-card {
        background: #fff;
        border-radius: 14px;
        padding: 20px 24px;
        margin-bottom: 28px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #eef0f5;
    }
    .filter-card .form-control,
    .filter-card .select {
        border-radius: 10px;
        border: 1.5px solid #e3e8f0;
        height: 44px;
        font-size: 13px;
        padding: 8px 14px;
        transition: border-color 0.2s;
    }
    .filter-card .form-control:focus { border-color: #2563a8; box-shadow: none; }
    .filter-card label {
        font-size: 12px;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }
    .btn-search {
        background: linear-gradient(135deg, #1a3d6d, #2563a8);
        color: #fff !important;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        height: 44px;
        font-size: 13px;
        letter-spacing: 0.3px;
        transition: opacity 0.2s, transform 0.2s;
        width: 100%;
    }
    .btn-search:hover { opacity: 0.9; transform: translateY(-1px); }
    .doctor-card {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid #eef0f5;
        padding: 22px 16px 16px;
        text-align: center;
        transition: all 0.3s ease;
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        gap: 0;
        position: relative;
        overflow: hidden;
    }
    .doctor-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1a3d6d, #2563a8);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .doctor-card:hover {
        border-color: #2563a8;
        box-shadow: 0 12px 30px rgba(37,99,168,0.12);
        transform: translateY(-4px);
    }
    .doctor-card:hover::before { opacity: 1; }
    .doctor-avatar-wrap {
        position: relative;
        width: 90px;
        height: 90px;
        margin: 0 auto 14px;
    }
    .doctor-avatar-wrap img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e8f0fb;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .doctor-name {
        font-size: 15px;
        font-weight: 800;
        color: #1a2340;
        margin: 0 0 4px;
        line-height: 1.3;
    }
    .doc-speciality {
        display: inline-block;
        background: #eef4ff;
        color: #2563a8;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 20px;
        margin-bottom: 10px;
        letter-spacing: 0.3px;
    }
    .doc-bio {
        font-size: 12px;
        color: #777;
        line-height: 1.5;
        margin: 0 0 12px;
        min-height: 36px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .rating-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-bottom: 10px;
    }
    .rating-score {
        font-size: 12px;
        font-weight: 700;
        color: #f39c12;
        background: #fff8ec;
        border: 1px solid #ffe0a0;
        padding: 2px 8px;
        border-radius: 20px;
    }

    /* ===== Salary Badge ===== */
    .salary-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        margin-bottom: 10px;
    }
    .salary-badge i { color: #10b981; font-size: 11px; }

    .address-box {
        background: #f8f9fb;
        padding: 8px 12px;
        border-radius: 10px;
        border: 1px solid #eef0f5;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .address-box i { color: #2563a8; font-size: 12px; flex-shrink: 0; }
    .address-text {
        color: #555;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
        text-align: left;
    }
    .doctor-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        border-top: 1px solid #f0f3f8;
        padding-top: 12px;
        margin-top: auto;
    }
    .rating-form {
        display: flex;
        align-items: center;
        gap: 5px;
        background: #fffbf0;
        padding: 4px 8px 4px 4px;
        border-radius: 30px;
        border: 1px solid #ffe8a0;
        flex: 1;
    }
    .rating-form select {
        font-size: 11px;
        padding: 3px 6px;
        border-radius: 20px;
        border: 1px solid #f0d080;
        background: #fff;
        color: #555;
        flex: 1;
        min-width: 0;
    }
    .rate-btn {
        background: #f39c12;
        color: #fff;
        font-weight: 700;
        border: none;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        white-space: nowrap;
        transition: background 0.2s;
    }
    .rate-btn:hover { background: #e08e0b; }
    .book-btn {
        background: linear-gradient(135deg, #1a3d6d, #2563a8);
        color: #fff !important;
        font-size: 11px;
        font-weight: 700;
        padding: 7px 14px;
        border-radius: 20px;
        text-decoration: none !important;
        white-space: nowrap;
        transition: opacity 0.2s, transform 0.2s;
        letter-spacing: 0.2px;
    }
    .book-btn:hover { opacity: 0.88; transform: translateY(-1px); }
    .flash-message {
        position: fixed;
        bottom: 24px; right: 24px;
        z-index: 9999;
        color: #fff;
        padding: 12px 22px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        display: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 18px;
        border: 1.5px dashed #d0d8e8;
    }
    .empty-state i { font-size: 60px; color: #c8d4e8; margin-bottom: 16px; }
    .empty-state h5 { color: #888; font-weight: 700; }
</style>
@endpush

@section('content')

<div class="page-header">
    <h4><i class="fa fa-user-md mr-2"></i> Find a Doctor</h4>
    <span class="doctor-count">{{ $doctors->count() }} Doctors Available</span>
</div>

<div class="filter-card">
    <form action="{{ url()->current() }}" method="GET">
        <div class="row align-items-end">
            <div class="col-sm-5 mb-3 mb-sm-0">
                <label><i class="fa fa-search mr-1"></i> Doctor Name</label>
                <input type="text" name="name" class="form-control" placeholder="Search by name..." value="{{ request('name') }}">
            </div>
            <div class="col-sm-5 mb-3 mb-sm-0">
                <label><i class="fa fa-stethoscope mr-1"></i> Speciality</label>
                <select name="speciality_id" class="form-control select">
                    <option value="">All Specialities</option>
                    @foreach(\App\Models\Service::all() as $service)
                        <option value="{{ $service->id }}" {{ request('speciality_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <label class="d-none d-sm-block" style="visibility:hidden;">s</label>
                <button type="submit" class="btn-search">
                    <i class="fa fa-search mr-1"></i> Search
                </button>
            </div>
        </div>
    </form>
</div>

<div class="row">
    @forelse($doctors as $doctor)
    <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
        <div class="doctor-card shadow-sm">

            {{-- Avatar --}}
            <div class="doctor-avatar-wrap">
                <img src="{{ asset('assets/img/' . ($doctor->avatar ?? 'user.jpg')) }}"
                     onerror="this.src='{{ asset('assets/img/user.jpg') }}'">
            </div>

            {{-- Name --}}
            <h4 class="doctor-name">Dr. {{ $doctor->firstname }} {{ $doctor->lastname }}</h4>

            {{-- Speciality --}}
            <span class="doc-speciality">
                {{ $doctor->services->pluck('service_name')->implode(' • ') ?: 'General Physician' }}
            </span>

            {{-- Bio --}}
            <p class="doc-bio">{{ $doctor->bio ?? 'Experienced medical professional dedicated to patient care.' }}</p>

            {{-- Rating --}}
            <div class="rating-row" id="rating-stars-{{ $doctor->id }}">
                <div class="rateyo-readonly" data-rating="{{ round($doctor->rating ?? 0, 1) }}"></div>
                <span class="rating-score">{{ round($doctor->rating ?? 0, 1) }}</span>
            </div>

            {{-- Salary / Consultation Fee --}}
            <div>
                <span class="salary-badge">
                    <i class="fa fa-money"></i>
                    Consultation Fee: {{ number_format($doctor->salary ?? 0, 2) }} EGP
                </span>
            </div>

            {{-- Address --}}
            <div class="address-box">
                <i class="fa fa-map-marker"></i>
                <span class="address-text">{{ $doctor->address ?? 'Address not provided' }}</span>
            </div>

            {{-- Actions --}}
            <div class="doctor-actions">
                <form class="rating-form" data-doctor-id="{{ $doctor->id }}" data-url="{{ route('doctor.rate', $doctor->id) }}">
                    @csrf
                    <select name="stars">
                        <option value="">Rate</option>
                        <option value="1">⭐ 1</option>
                        <option value="2">⭐ 2</option>
                        <option value="3">⭐ 3</option>
                        <option value="4">⭐ 4</option>
                        <option value="5">⭐ 5</option>
                    </select>
                    <button type="submit" class="rate-btn"><i class="fa fa-star"></i></button>
                </form>
                <a href="{{ route('appointments.book', $doctor->id) }}" class="book-btn">
                    <i class="fa fa-calendar-plus-o mr-1"></i> Book Appointment
                </a>
            </div>

        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="empty-state">
            <i class="fa fa-user-md"></i>
            <h5>No doctors found</h5>
            <p class="text-muted">Try adjusting your search filters.</p>
        </div>
    </div>
    @endforelse
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
$(document).ready(function() {
    $('.rateyo-readonly').each(function() {
        var rating = parseFloat($(this).data('rating')) || 0;
        $(this).rateYo({
            rating: rating, readOnly: true,
            starWidth: "16px", normalFill: "#e0e0e0",
            ratedFill: "#f39c12", halfStar: true,
            precision: 1, spacing: "2px"
        });
    });

    function showFlash(msg, color) {
        var flash = $('<div class="flash-message" style="background:' + color + '">' + msg + '</div>');
        $('body').append(flash);
        flash.fadeIn().delay(2500).fadeOut(function() { $(this).remove(); });
    }

    $(document).on('submit', '.rating-form', function(e) {
        e.preventDefault();
        var form  = $(this);
        var url   = form.data('url');
        var id    = form.data('doctor-id');
        var stars = form.find('select[name="stars"]').val();
        var token = form.find('input[name="_token"]').val();

        if (!stars) { showFlash('Please select a rating first!', '#dc3545'); return; }

        $.ajax({
            url: url, method: 'POST',
            data: { _token: token, stars: stars },
            success: function(res) {
                var newRating = parseFloat(res.new_rating);
                var container = $('#rating-stars-' + id);
                var ryDiv = container.find('.rateyo-readonly');
                ryDiv.rateYo('destroy').rateYo({
                    rating: newRating, readOnly: true,
                    starWidth: "16px", normalFill: "#e0e0e0",
                    ratedFill: "#f39c12", halfStar: true,
                    precision: 1, spacing: "2px"
                });
                container.find('.rating-score').text(newRating.toFixed(1));
                showFlash('✓ Rating submitted successfully!', '#28a745');
            },
            error: function(xhr) {
                showFlash(xhr.responseJSON?.message || 'Something went wrong!', '#dc3545');
            }
        });
    });
});
</script>
@endpush
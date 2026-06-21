@extends('layouts.admin')

@section('title', 'Admin Dashboard - MediCare+')

@push('styles')
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

.db-wrap {
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    background: #f8fafc;
    min-height: 100vh;
}

/* ─── TOP HEADER ─── */
.db-topbar {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
.db-topbar h1 {
    font-size: 20px;
    font-weight: 600;
    color: #0f172a;
}
.db-topbar p {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 3px;
}
.db-topbar-right {
    display: flex;
    gap: 8px;
    align-items: center;
}

/* ─── CARDS ─── */
.card {
    background: #ffffff;
    border: 1px solid #f1f5f9;
    border-radius: 16px;
    padding: 18px 20px;
}

/* ─── GRIDS ─── */
.row { display: grid; gap: 14px; }
.r4  { grid-template-columns: repeat(4, 1fr); }
.r3  { grid-template-columns: repeat(3, 1fr); }
.r2-1 { grid-template-columns: 2.2fr 1fr; }
.r1-2 { grid-template-columns: 1fr 1.6fr; }

/* ─── BADGES ─── */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 10px;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 20px;
}
.b-up     { background: #f0fdf4; color: #166534; }
.b-warn   { background: #fffbeb; color: #92400e; }
.b-info   { background: #eff6ff; color: #1e40af; }
.b-red    { background: #fef2f2; color: #991b1b; }
.b-purple { background: #f5f3ff; color: #4c1d95; }
.b-online { background: #f0fdf4; color: #166534; font-size: 10px; padding: 3px 8px; }
.b-away   { background: #fffbeb; color: #92400e; font-size: 10px; padding: 3px 8px; }

/* ─── SECTION HEADERS ─── */
.sec-hd {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}
.sec-title {
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
}
.sec-link {
    font-size: 11px;
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
}
.sec-link:hover { text-decoration: underline; }

/* ─── STAT CARD ─── */
.stat-card {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}
.stat-lbl  { font-size: 11px; color: #94a3b8; margin-bottom: 5px; letter-spacing: .3px; }
.stat-val  { font-size: 26px; font-weight: 700; color: #0f172a; line-height: 1; }
.stat-sub  { font-size: 10px; color: #94a3b8; margin-top: 4px; }
.stat-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

/* ─── PROGRESS ─── */
.progress-bar {
    height: 4px;
    border-radius: 2px;
    background: #f1f5f9;
    overflow: hidden;
    margin-top: 4px;
}
.progress-fill { height: 100%; border-radius: 2px; }

/* ─── KPI BOXES ─── */
.kpi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-top: 10px; }
.kpi-box  { background: #f8fafc; border-radius: 10px; padding: 10px 12px; }

/* ─── BED GRID ─── */
.bed-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }

/* ─── AVATAR ─── */
.av {
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 600;
    flex-shrink: 0;
}

/* ─── TABLE ─── */
.tbl { width: 100%; border-collapse: collapse; font-size: 12px; table-layout: fixed; }
.tbl th {
    color: #94a3b8;
    font-weight: 500;
    text-align: left;
    padding: 0 0 8px;
    font-size: 11px;
    border-bottom: 1px solid #f1f5f9;
}
.tbl td {
    padding: 9px 0;
    border-bottom: 1px solid #f1f5f9;
    color: #1e293b;
    vertical-align: middle;
}
.tbl tr:last-child td { border-bottom: none; }

/* ─── ACTIVITY FEED ─── */
.activity-item {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
}
.activity-item:last-child { border-bottom: none; }
.act-dot  { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; margin-top: 4px; }
.act-tail { width: 1px; flex: 1; background: #f1f5f9; margin-top: 4px; min-height: 20px; }

/* ─── TASKS ─── */
.task-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px;
    background: #f8fafc;
    border-radius: 10px;
    margin-bottom: 8px;
}
.task-item:last-child { margin-bottom: 0; }
.task-accent {
    width: 3px; height: 38px;
    border-radius: 2px;
    flex-shrink: 0;
}

/* ─── QUICK ACTIONS ─── */
.action-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 10px 12px;
    text-align: left;
    background: #ffffff;
    border: 1px solid #f1f5f9;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s, transform .15s;
    margin-bottom: 8px;
}
.action-btn:last-child { margin-bottom: 0; }
.action-btn:hover { background: #f8fafc; transform: translateX(3px); }
.action-icon {
    width: 32px; height: 32px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

/* ─── SPARK ─── */
.mini-spark { display: flex; align-items: flex-end; gap: 2px; height: 28px; margin-top: 6px; }
.spark-bar  { width: 8px; border-radius: 2px 2px 0 0; flex-shrink: 0; }

/* ─── STATUS DOT ─── */
.sdot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; }

/* ─── DIVIDER ─── */
hr.div { border: none; border-top: 1px solid #f1f5f9; margin: 10px 0; }

/* ─── SYSTEM BADGE ─── */
.sys-online {
    display: inline-flex; align-items: center; gap: 5px;
    background: #f0fdf4; color: #166534;
    font-size: 11px; font-weight: 600;
    padding: 4px 10px; border-radius: 20px;
}
</style>
@endpush

@section('content')
<div class="db-wrap">

    {{-- ═══════════════════════════════
         TOP BAR
    ═══════════════════════════════ --}}
    <div class="db-topbar">
        <div>
            <h1>MediCare+ Admin Dashboard</h1>
            <p>{{ now()->format('l, d F Y') }} — Live overview</p>
        </div>
        <div class="db-topbar-right">
            <span class="sys-online">
                <span style="width:7px;height:7px;border-radius:50%;background:#16a34a;display:inline-block"></span>
                System online
            </span>
            <span style="font-size:11px;color:#94a3b8">Last sync: 2 min ago</span>
        </div>
    </div>

    {{-- ═══════════════════════════════
         STAT CARDS  (Row 1)
    ═══════════════════════════════ --}}
    <div class="row r4">

        {{-- Patients --}}
        <div class="card stat-card">
            <div>
                <div class="stat-lbl">Total patients</div>
                <div class="stat-val">2,847</div>
                <div style="margin-top:8px"><span class="badge b-up">↑ 12.5%</span></div>
                <div class="stat-sub">vs. last month</div>
            </div>
            <div class="stat-icon" style="background:#eff6ff">
                <svg width="18" height="18" fill="none" stroke="#1d4ed8" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
        </div>

        {{-- Doctors --}}
        <div class="card stat-card">
            <div>
                <div class="stat-lbl">Active doctors</div>
                <div class="stat-val">52</div>
                <div style="margin-top:8px"><span class="badge b-info">+ 3 new</span></div>
                <div class="stat-sub">this week</div>
            </div>
            <div class="stat-icon" style="background:#f0fdf4">
                <svg width="18" height="18" fill="none" stroke="#15803d" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                </svg>
            </div>
        </div>

        {{-- Appointments --}}
        <div class="card stat-card">
            <div>
                <div class="stat-lbl">Today's appointments</div>
                <div class="stat-val">127</div>
                <div style="margin-top:8px"><span class="badge b-warn">18 pending</span></div>
                <div class="stat-sub">109 confirmed</div>
            </div>
            <div class="stat-icon" style="background:#f5f3ff">
                <svg width="18" height="18" fill="none" stroke="#6d28d9" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
        </div>

        {{-- Revenue --}}
        <div class="card stat-card">
            <div>
                <div class="stat-lbl">Monthly revenue</div>
                <div class="stat-val">$67k</div>
                <div style="margin-top:8px"><span class="badge b-up">↑ 15.2%</span></div>
                <div class="stat-sub">target: $72k</div>
            </div>
            <div class="stat-icon" style="background:#fffbeb">
                <svg width="18" height="18" fill="none" stroke="#b45309" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
        </div>

    </div>{{-- /r4 --}}

    {{-- ═══════════════════════════════
         CHARTS ROW  (Row 2)
    ═══════════════════════════════ --}}
    <div class="row r2-1">

        {{-- Revenue Bar Chart --}}
        <div class="card">
            <div class="sec-hd">
                <span class="sec-title">Revenue overview — {{ now()->year }}</span>
                <div style="display:flex;gap:8px;align-items:center">
                    <span class="badge b-up">+15.2% YTD</span>
                    <a href="{{ route('reports') }}" class="sec-link">Drill down →</a>
                </div>
            </div>
            <div style="display:flex;gap:16px;margin-bottom:14px">
                <div>
                    <div class="stat-lbl">This month</div>
                    <div style="font-size:16px;font-weight:600;color:#0f172a">$67,200</div>
                </div>
                <div style="border-left:1px solid #f1f5f9;padding-left:16px">
                    <div class="stat-lbl">Last month</div>
                    <div style="font-size:16px;font-weight:600;color:#94a3b8">$58,400</div>
                </div>
                <div style="border-left:1px solid #f1f5f9;padding-left:16px">
                    <div class="stat-lbl">Annual target</div>
                    <div style="font-size:16px;font-weight:600;color:#0f172a">$820k</div>
                </div>
            </div>
            <div style="position:relative;width:100%;height:200px">
                <canvas id="revenueChart" role="img"
                    aria-label="Monthly revenue bar chart for {{ now()->year }}">
                    Jan $45k, Feb $52k, Mar $48k, Apr $62k, May $55k, Jun $68k
                </canvas>
            </div>
        </div>

        {{-- Donut + Progress --}}
        <div class="card">
            <div class="sec-hd">
                <span class="sec-title">Dept. breakdown</span>
                <a href="{{ route('admin.doctors') }}" class="sec-link">Details →</a>
            </div>
            <div style="position:relative;width:100%;height:160px">
                <canvas id="deptChart" role="img"
                    aria-label="Doughnut chart of appointments by department">
                    Cardiology 30%, Neurology 22%, Orthopedics 18%, Pediatrics 15%, Other 15%
                </canvas>
            </div>
            <div style="margin-top:14px;display:flex;flex-direction:column;gap:8px">
                @foreach([
                    ['Cardiology',  30, '#15803d'],
                    ['Neurology',   22, '#6d28d9'],
                    ['Orthopedics', 18, '#b45309'],
                    ['Pediatrics',  15, '#1d4ed8'],
                    ['Other',       15, '#94a3b8'],
                ] as [$dept, $pct, $color])
                <div>
                    <div style="display:flex;justify-content:space-between;font-size:11px;margin-bottom:3px">
                        <span style="color:#64748b">{{ $dept }}</span>
                        <span style="font-weight:600;color:#0f172a">{{ $pct }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:{{ $pct }}%;background:{{ $color }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>{{-- /r2-1 --}}

    {{-- ═══════════════════════════════
         KPIs ROW  (Row 3)
    ═══════════════════════════════ --}}
    <div class="row r3">

        {{-- Patient Satisfaction --}}
        <div class="card">
            <div class="sec-hd">
                <span class="sec-title">Patient satisfaction</span>
                <span class="badge b-up">↑ 4.2%</span>
            </div>
            <div style="font-size:32px;font-weight:700;color:#0f172a">
                4.8<span style="font-size:16px;color:#94a3b8">/5.0</span>
            </div>
            <div style="font-size:11px;color:#94a3b8;margin-bottom:10px">Based on 1,240 reviews this month</div>
            <div class="kpi-grid">
                <div class="kpi-box">
                    <div class="stat-lbl">Wait time</div>
                    <div style="font-size:14px;font-weight:600;color:#0f172a">12 min</div>
                    <div style="font-size:10px;color:#15803d;margin-top:2px">↓ 3 min</div>
                </div>
                <div class="kpi-box">
                    <div class="stat-lbl">Resolved</div>
                    <div style="font-size:14px;font-weight:600;color:#0f172a">94%</div>
                    <div style="font-size:10px;color:#15803d;margin-top:2px">↑ 2%</div>
                </div>
                <div class="kpi-box">
                    <div class="stat-lbl">Repeat</div>
                    <div style="font-size:14px;font-weight:600;color:#0f172a">68%</div>
                    <div style="font-size:10px;color:#15803d;margin-top:2px">↑ 5%</div>
                </div>
            </div>
            <div style="margin-top:12px">
                <div style="font-size:11px;color:#94a3b8;margin-bottom:6px">Weekly trend</div>
                <div class="mini-spark">
                    @foreach([40, 60, 50, 75, 65, 90, 80] as $h)
                    <div class="spark-bar" style="height:{{ $h }}%;background:#15803d"></div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bed Occupancy --}}
        <div class="card">
            <div class="sec-hd">
                <span class="sec-title">Bed occupancy</span>
                <a href="{{ route('admin.patients') }}" class="sec-link">View wards →</a>
            </div>
            <div class="bed-grid">
                @foreach([
                    ['ICU',        18, 20, 90,  '#dc2626', '#fef2f2', '#991b1b', 'critical'],
                    ['General',    84,120, 70,  '#d97706', '#fffbeb', '#92400e', 'moderate'],
                    ['Pediatrics', 12, 30, 40,  '#15803d', '#f0fdf4', '#166534', 'available'],
                    ['Surgery',    22, 28, 79,  '#6d28d9', '#f5f3ff', '#4c1d95', 'busy'],
                ] as [$ward, $occ, $cap, $pct, $bar, $bg, $txt, $label])
                <div class="kpi-box" style="background:{{ $bg }}">
                    <div class="stat-lbl">{{ $ward }}</div>
                    <div style="font-size:15px;font-weight:600;color:#0f172a">
                        {{ $occ }} / {{ $cap }}
                    </div>
                    <div class="progress-bar" style="margin-top:6px">
                        <div class="progress-fill" style="width:{{ $pct }}%;background:{{ $bar }}"></div>
                    </div>
                    <div style="font-size:10px;color:{{ $txt }};margin-top:3px">
                        {{ $pct }}% — {{ $label }}
                    </div>
                </div>
                @endforeach
            </div>
            <div style="margin-top:10px;font-size:11px;color:#64748b;display:flex;justify-content:space-between">
                <span>Total: 136 / 198 beds occupied</span>
                <span style="font-weight:600;color:#0f172a">69%</span>
            </div>
        </div>

        {{-- Financials Snapshot --}}
        <div class="card">
            <div class="sec-hd">
                <span class="sec-title">Financials snapshot</span>
                <a href="{{ route('reports') }}" class="sec-link">Full report →</a>
            </div>
            @foreach([
                ['Revenue',            '$67,200', 'b-up',   '↑ 15%',      null],
                ['Operating costs',    '$41,300', 'b-red',  '↑ 8%',       null],
                ['Net profit',         '$25,900', 'b-up',   '↑ 24%',      '#166534'],
                ['Insurance claims',   '$18,400', 'b-warn', '12 pending',  null],
                ['Outstanding invoices','$7,200', 'b-red',  'Overdue',    '#991b1b'],
            ] as [$label, $amount, $badge, $note, $color])
            <div style="display:flex;justify-content:space-between;align-items:center;
                        padding:8px 0;border-bottom:1px solid #f1f5f9">
                <span style="font-size:12px;color:#64748b">{{ $label }}</span>
                <div style="text-align:right">
                    <div style="font-size:13px;font-weight:600;color:{{ $color ?? '#0f172a' }}">
                        {{ $amount }}
                    </div>
                    <span class="badge {{ $badge }}" style="font-size:9px">{{ $note }}</span>
                </div>
            </div>
            @endforeach
            <div style="margin-top:10px">
                <div style="font-size:11px;color:#94a3b8;margin-bottom:4px">Profit margin</div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:38.5%;background:#15803d"></div>
                </div>
                <div style="font-size:10px;color:#94a3b8;margin-top:3px">38.5%</div>
            </div>
        </div>

    </div>{{-- /r3 --}}

    {{-- ═══════════════════════════════
         APPOINTMENTS TABLE + DOCTORS & ACTIVITY  (Row 4)
    ═══════════════════════════════ --}}
    <div class="row r1-2">

        {{-- Appointments Table --}}
        <div class="card">
            <div class="sec-hd">
                <span class="sec-title">Today's appointments</span>
                <a href="{{ route('admin.appointments') }}" class="sec-link">View all →</a>
            </div>
            <table class="tbl">
                <thead>
                    <tr>
                        <th style="width:15%">Time</th>
                        <th style="width:23%">Patient</th>
                        <th style="width:22%">Doctor</th>
                        <th style="width:20%">Dept.</th>
                        <th style="width:20%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                        ['09:00 AM', 'John Smith',    'Dr. Mitchell', 'Cardiology',   'Completed',   'b-up'],
                        ['10:30 AM', 'Emily Rose',    'Dr. Kim',      'Neurology',    'Completed',   'b-up'],
                        ['12:00 PM', 'Carlos Vega',   'Dr. Patel',    'Orthopedics',  'In progress', 'b-info'],
                        ['02:15 PM', 'Layla Hassan',  'Dr. Leblanc',  'Pediatrics',   'Pending',     'b-warn'],
                        ['03:00 PM', 'Nour Ahmed',    'Dr. Mitchell', 'Cardiology',   'Pending',     'b-warn'],
                        ['04:00 PM', 'Tom Andrews',   'Dr. Yusuf',    'Radiology',    'Pending',     'b-warn'],
                        ['05:30 PM', 'Sara Khalil',   'Dr. Patel',    'Orthopedics',  'Cancelled',   'b-red'],
                    ] as [$time, $patient, $doctor, $dept, $status, $badge])
                    <tr>
                        <td style="color:#94a3b8;font-size:11px">{{ $time }}</td>
                        <td style="font-size:12px;font-weight:600;color:#0f172a">{{ $patient }}</td>
                        <td style="font-size:11px;color:#64748b">{{ $doctor }}</td>
                        <td style="font-size:11px;color:#64748b">{{ $dept }}</td>
                        <td><span class="badge {{ $badge }}">{{ $status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Right column: Top Doctors + Activity --}}
        <div style="display:flex;flex-direction:column;gap:14px">

            {{-- Top Doctors --}}
            <div class="card">
                <div class="sec-hd">
                    <span class="sec-title">Top doctors this month</span>
                    <a href="{{ route('admin.doctors') }}" class="sec-link">Report →</a>
                </div>
                @foreach([
                    ['SM', '#eff6ff', '#1d4ed8', 'Dr. Sarah Mitchell', 'Cardiology',   87, '4.9'],
                    ['JK', '#f5f3ff', '#6d28d9', 'Dr. James Kim',      'Neurology',    71, '4.8'],
                    ['RP', '#fffbeb', '#b45309', 'Dr. Rita Patel',     'Orthopedics',  63, '4.7'],
                    ['ML', '#f0fdf4', '#15803d', 'Dr. Marc Leblanc',   'Pediatrics',   58, '4.7'],
                ] as [$initials, $bg, $color, $name, $dept, $patients, $rating])
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
                    <div class="av" style="background:{{ $bg }};color:{{ $color }}">{{ $initials }}</div>
                    <div style="flex:1">
                        <div style="font-size:12px;font-weight:600;color:#0f172a">{{ $name }}</div>
                        <div style="font-size:10px;color:#94a3b8">{{ $dept }} · {{ $patients }} patients</div>
                        <div class="progress-bar" style="margin-top:4px">
                            <div class="progress-fill" style="width:{{ $patients }}%;background:{{ $color }}"></div>
                        </div>
                    </div>
                    <span class="badge b-up" style="white-space:nowrap">{{ $rating }} ★</span>
                </div>
                @endforeach
            </div>

            {{-- Recent Activity --}}
            <div class="card">
                <div class="sec-hd"><span class="sec-title">Recent activity</span></div>
                @foreach([
                    ['#15803d', 'New patient <strong>Amira Saleh</strong> registered',       '2 min ago'],
                    ['#1d4ed8', 'Appointment confirmed — <strong>Carlos Vega</strong>',       '15 min ago'],
                    ['#dc2626', 'ICU bed capacity warning — <strong>90%</strong>',            '34 min ago'],
                    ['#d97706', 'Invoice <strong>#INV-2047</strong> overdue',                 '1 hour ago'],
                    ['#6d28d9', 'Dr. <strong>James Kim</strong> started shift',               '2 hours ago'],
                ] as [$dotColor, $text, $time])
                <div class="activity-item">
                    <div style="display:flex;flex-direction:column;align-items:center">
                        <div class="act-dot" style="background:{{ $dotColor }}"></div>
                        <div class="act-tail"></div>
                    </div>
                    <div>
                        <div style="font-size:12px;color:#0f172a">{!! $text !!}</div>
                        <div style="font-size:10px;color:#94a3b8">{{ $time }}</div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>{{-- /r1-2 --}}

    {{-- ═══════════════════════════════
         STAFF + TASKS + QUICK ACTIONS  (Row 5)
    ═══════════════════════════════ --}}
    <div class="row r3">

        {{-- Staff On Duty --}}
        <div class="card">
            <div class="sec-hd">
                <span class="sec-title">Staff on duty today</span>
                <a href="{{ route('admin.doctors') }}" class="sec-link">Schedule →</a>
            </div>
            @foreach([
                ['SM', '#eff6ff', '#1d4ed8', 'Dr. Mitchell', 'Cardiology',   '08:00–16:00', '#16a34a'],
                ['JK', '#f5f3ff', '#6d28d9', 'Dr. Kim',      'Neurology',    '09:00–17:00', '#16a34a'],
                ['RP', '#fffbeb', '#b45309', 'Dr. Patel',    'Orthopedics',  '10:00–18:00', '#d97706'],
                ['ML', '#f0fdf4', '#15803d', 'Dr. Leblanc',  'Pediatrics',   '07:00–15:00', '#16a34a'],
            ] as [$initials, $bg, $color, $name, $dept, $shift, $status])
            <div style="display:grid;grid-template-columns:auto 1fr auto auto;
                        gap:8px;align-items:center;padding:8px 0;border-bottom:1px solid #f1f5f9">
                <div class="av" style="background:{{ $bg }};color:{{ $color }};font-size:10px">
                    {{ $initials }}
                </div>
                <div>
                    <div style="font-size:12px;font-weight:600;color:#0f172a">{{ $name }}</div>
                    <div style="font-size:10px;color:#94a3b8">{{ $dept }}</div>
                </div>
                <span style="font-size:10px;color:#94a3b8">{{ $shift }}</span>
                <span class="sdot" style="background:{{ $status }}"></span>
            </div>
            @endforeach
            <hr class="div">
            <div style="display:flex;gap:14px;font-size:10px;color:#94a3b8">
                <span><span class="sdot" style="background:#16a34a"></span> Active</span>
                <span><span class="sdot" style="background:#d97706"></span> Away</span>
                <span><span class="sdot" style="background:#94a3b8"></span> Off duty</span>
            </div>
        </div>

        {{-- Pending Tasks --}}
        <div class="card">
            <div class="sec-hd">
                <span class="sec-title">Pending tasks</span>
                <span class="badge b-red">7 urgent</span>
            </div>
            @foreach([
                ['#dc2626', 'Review ICU capacity plan',          'Admin · Due today',         'b-red',  'Urgent'],
                ['#dc2626', 'Resolve overdue invoice #INV-2047', 'Finance · Overdue 3 days',  'b-red',  'Urgent'],
                ['#d97706', 'Approve 12 insurance claims',       'Billing · Due in 2 days',   'b-warn', 'High'],
                ['#1d4ed8', 'Update staff schedule for May',     'HR · Due in 5 days',        'b-info', 'Normal'],
            ] as [$accent, $title, $sub, $badge, $label])
            <div class="task-item">
                <div class="task-accent" style="background:{{ $accent }}"></div>
                <div style="flex:1">
                    <div style="font-size:12px;font-weight:600;color:#0f172a">{{ $title }}</div>
                    <div style="font-size:10px;color:#94a3b8">{{ $sub }}</div>
                </div>
                <span class="badge {{ $badge }}" style="font-size:9px">{{ $label }}</span>
            </div>
            @endforeach
          
        </div>

        {{-- Quick Actions --}}
        <div class="card">
            <div class="sec-hd"><span class="sec-title">Quick actions</span></div>
           {{-- استبدل مصفوفة الروابط القديمة بهذا الكود --}}
@foreach([
    [route('admin.add-doctor'), '#eff6ff', '#1d4ed8', 'Add new doctor', 'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 3a4 4 0 1 1 0 8 4 4 0 0 1 0-8z'],
    [route('admin.add-patient'), '#f0fdf4', '#15803d', 'Register patient', 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 7a4 4 0 1 1 0 8 4 4 0 0 1 0-8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75'],
    [route('admin.appointments'), '#f5f3ff', '#6d28d9', 'Book appointment', 'M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18'],
    [route('reports'), '#fffbeb', '#b45309', 'Generate report', 'M18 20V10M12 20V4M6 20v-6'],
    [route('admin.notifications.create'), '#fef2f2', '#991b1b', 'Send notification', 'M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0'],
] as [$route, $bg, $color, $label, $iconPath])
            <a href="{{ $route }}" class="action-btn">
                <div class="action-icon" style="background:{{ $bg }}">
                    <svg width="14" height="14" fill="none" stroke="{{ $color }}" stroke-width="2" viewBox="0 0 24 24">
                        <path d="{{ $iconPath }}"/>
                    </svg>
                </div>
                <span style="font-size:12px;font-weight:600;color:#0f172a">{{ $label }}</span>
                <span style="margin-left:auto;font-size:11px;color:#94a3b8">→</span>
            </a>
            @endforeach
        </div>

    </div>{{-- /r3 --}}

</div>{{-- /db-wrap --}}
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Revenue Bar + Target Line Chart ──
    const ctx1 = document.getElementById('revenueChart').getContext('2d');
    const grad = ctx1.createLinearGradient(0, 0, 0, 200);
    grad.addColorStop(0, 'rgba(21, 128, 61, 0.15)');
    grad.addColorStop(1, 'rgba(21, 128, 61, 0)');

    new Chart(ctx1, {
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [
                {
                    type: 'bar',
                    label: 'Revenue',
                    data: [45000,52000,48000,62000,55000,68000,71000,66000,74000,69000,78000,null],
                    backgroundColor: '#15803d',
                    borderRadius: 5,
                    borderSkipped: false,
                },
                {
                    type: 'line',
                    label: 'Target',
                    data: [60000,60000,60000,65000,65000,65000,70000,70000,70000,75000,75000,75000],
                    borderColor: '#3b82f6',
                    borderWidth: 1.5,
                    borderDash: [5, 4],
                    pointRadius: 0,
                    fill: false,
                    tension: 0,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    border: { display: false },
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 10 },
                        callback: v => '$' + Math.round(v / 1000) + 'k'
                    }
                },
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 10 }, autoSkip: false }
                }
            }
        }
    });

    // ── Dept Donut Chart ──
    new Chart(document.getElementById('deptChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Cardiology','Neurology','Orthopedics','Pediatrics','Other'],
            datasets: [{
                data: [30, 22, 18, 15, 15],
                backgroundColor: ['#15803d','#6d28d9','#b45309','#1d4ed8','#94a3b8'],
                borderWidth: 0,
                hoverOffset: 5,
            }]
        },
        options: {
            cutout: '76%',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

});
</script>
@endpush
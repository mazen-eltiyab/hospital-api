<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <title>@yield('title', 'MediCare')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --online-green: #55ce63;
            --avatar-size: 38px;
        }

        .header-left {
            width: auto !important;
            min-width: 250px;
            display: flex;
            align-items: center;
        }
        .header-left .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .header-left .logo img {
            width: 55px !important;
            height: 55px !important;
            object-fit: contain;
        }
     .header-left .logo span {
    font-family: 'Playfair Display', serif;
    font-size: 28px !important;
    font-weight: 700;
    color: #ffffff;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

        .header {
            display: flex;
            align-items: center;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1040;
            height: 60px;
            padding: 0 15px;
        }

        .user-menu.nav {
            display: flex !important;
            align-items: center;
            flex-wrap: nowrap;
            gap: 6px;
            margin-left: auto;
        }
        .user-menu.nav > li { list-style: none; }

        .nav-item.dropdown { position: relative; }

        .bell-btn {
            display: flex !important;
            align-items: center;
            justify-content: center;
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
            background: rgba(255, 255, 255, 0.15);
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none !important;
            padding: 0 !important;
            margin: 0 5px;
        }
        .bell-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }
        .bell-btn .fa-bell-o {
            font-size: 18px;
            color: #fff;
            line-height: 1;
        }

        #notification-badge {
            position: absolute;
            top: -3px; right: -3px;
            background: #f62d51;
            color: #fff;
            font-size: 9px;
            min-width: 17px; height: 17px;
            line-height: 17px;
            text-align: center;
            border-radius: 50px;
            padding: 0 4px;
            border: 2px solid #fff;
        }

        .notifications.dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0; left: auto;
            z-index: 1050;
            width: 300px;
            padding: 0;
            background: #fff;
            border-radius: 40px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }
        .topnav-dropdown-header {
            padding: 12px 15px;
            font-weight: 700;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .notification-list {
            max-height: 300px;
            overflow-y: auto;
            list-style: none;
            padding: 0; margin: 0;
        }
        .notification-message { border-bottom: 1px solid #f5f5f5; }
        .notification-message:last-child { border-bottom: none; }
        .notification-message a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: background 0.2s;
            font-size: 13px;
        }
        .notification-message a:hover { background: #f8f9fa; }
        .unread-notify a { background: #f0f8ff; }
        .noti-title { font-weight: 600; color: #009efb; }
        .noti-time { font-size: 11px; color: #aaa; margin-top: 3px; }

        .user-link {
            display: flex !important;
            align-items: center !important;
            gap: 8px;
            background: rgba(255,255,255,0.1) !important;
            border: none !important;
            padding: 4px 10px 4px 4px !important;
            border-radius: 30px;
            transition: background 0.2s;
            text-decoration: none !important;
            cursor: pointer;
        }
        .user-link:hover { background: rgba(255,255,255,0.2) !important; }

        .user-img {
            position: relative;
            display: inline-block;
            width: var(--avatar-size) !important;
            height: var(--avatar-size) !important;
            flex-shrink: 0;
        }
        .user-img img {
            width: 100% !important;
            height: 100% !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            border: 2px solid rgba(255,255,255,0.8);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            display: block;
        }
        .status.online {
            background: var(--online-green);
            border: 2px solid #fff;
            width: 11px; height: 11px;
            border-radius: 50%;
            position: absolute;
            bottom: 0px; right: 0px;
            z-index: 2;
        }
        .user-name-text {
            color: #fff;
            font-weight: 600;
            font-size: 13px;
            white-space: nowrap;
            max-width: 110px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .has-arrow .dropdown-menu {
            min-width: 220px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border: none;
            margin-top: 10px !important;
            padding: 0;
            overflow: hidden;
        }
        .dropdown-user-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: linear-gradient(135deg, #1a3d6d 0%, #2563a8 100%);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .dropdown-user-header img {
            width: 46px; height: 46px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.8);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            flex-shrink: 0;
        }
        .dropdown-user-info .user-fullname {
            color: #fff; font-weight: 700; font-size: 14px; margin: 0; line-height: 1.3;
        }
        .dropdown-user-info .user-role-badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            color: #fff; font-size: 10px; font-weight: 600;
            padding: 2px 8px; border-radius: 20px;
            margin-top: 3px; letter-spacing: 0.5px; text-transform: uppercase;
        }
        .has-arrow .dropdown-menu .dropdown-item {
            padding: 10px 18px; font-size: 13px; font-weight: 500; color: #444;
            transition: background 0.2s, color 0.2s;
            display: flex; align-items: center; gap: 10px;
        }
        .has-arrow .dropdown-menu .dropdown-item i {
            width: 16px; text-align: center; color: #888; font-size: 14px; transition: color 0.2s;
        }
        .has-arrow .dropdown-menu .dropdown-item:hover { background: #f0f6ff; color: #1a3d6d; }
        .has-arrow .dropdown-menu .dropdown-item:hover i { color: #1a3d6d; }
        .has-arrow .dropdown-menu .dropdown-item.text-danger:hover { background: #fff5f5; color: #dc3545 !important; }
        .has-arrow .dropdown-menu .dropdown-item.text-danger:hover i { color: #dc3545; }
        .dropdown-divider { margin: 4px 0; }

        @media (max-width: 991px) {
            .user-name-text { display: none; }
            .user-link { padding: 4px !important; border-radius: 50% !important; }
        }
        @media (max-width: 767px) {
            .header { padding: 0 20px; height: 60px; }
            .header-left .logo img { width: 35px; height: 35px; }
            .header-left .logo span { font-size: 20px; }
            .notifications.dropdown-menu { width: 300px; right: -20px; }
        }
        @media (max-width: 480px) {
            .header-left .logo span { font-size: 18px; letter-spacing: 0; }
            .header-left .logo img { width: 30px; height: 30px; min-width: 30px; }
            .notifications.dropdown-menu { width: calc(100vw - 40px); right: -10px; }
        }
    </style>

    @stack('styles')
</head>
<body>
<div class="main-wrapper">

    <!-- HEADER -->
    <div class="header">
        <div class="header-left">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="MediCare Logo">
                <span>MediCare</span>
            </a>
        </div>

        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>

        <ul class="nav user-menu float-right">

            <!-- 🔔 Notification Bell -->
           <!-- 🔔 Notification Bell -->
            <li class="nav-item dropdown">
                <a href="#" class="bell-btn dropdown-toggle" data-toggle="dropdown" id="notification-toggle">
                    <i class="fa fa-bell-o"></i>
                    <!-- العداد الصغير فوق الجرس للرسائل غير المقروءة -->
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span id="notification-badge">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                    @endif
                </a>
                <div class="dropdown-menu notifications dropdown-menu-right">
                    <div class="topnav-dropdown-header">
                        <span>🔔 New Messages</span>
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="badge badge-danger" style="font-size:10px;">
                                {{ $unreadCount }} New
                            </span>
                        @endif
                    </div>
                    <ul class="notification-list">
                        <!-- عرض آخر 5 رسائل غير مقروءة جاءت من قاعدة البيانات -->
                        @if(isset($notificationsMessages) && $notificationsMessages->count() > 0)
                            @foreach($notificationsMessages as $notiMsg)
                                <li class="notification-message unread-notify">
                                    <a href="{{ route('admin.messages.show', $notiMsg->id) }}">
                                        <div class="noti-details">
                                            <span class="noti-title" style="font-weight: 600; color: #1a3d6d;">{{ $notiMsg->name }}</span>
                                            <span style="color: #555;"> sent a new message in </span>
                                            <span class="noti-title" style="color: #009efb;">[{{ $notiMsg->department ?? 'General' }}]</span>
                                        </div>
                                        <div class="noti-time">
                                            <i class="fa fa-clock-o"></i> {{ $notiMsg->created_at->diffForHumans() }}
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li class="text-center p-4">
                                <i class="fa fa-bell-slash-o" style="font-size:26px; color:#ddd;"></i>
                                <p style="color:#bbb; margin-top:8px; font-size:13px;">No new messages</p>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>

            <!-- 👤 User Dropdown -->
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle user-link nav-link" data-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle"
                             src="{{ asset('assets/img/user.jpg') }}"
                             alt="{{ Auth::user()->name }}">
                        <span class="status online"></span>
                    </span>
                    <span class="user-name-text">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-user-header">
                        <img src="{{ asset('assets/img/user.jpg') }}" alt="{{ Auth::user()->name }}">
                        <div class="dropdown-user-info">
                            <p class="user-fullname">{{ Auth::user()->name }}</p>
                            <span class="user-role-badge">Admin</span>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>

                    <li class="{{ request()->routeIs('admin') ? 'active' : '' }}">
                        <a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.doctors') ? 'active' : '' }}">
                        <a href="{{ route('admin.doctors') }}"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.patients') ? 'active' : '' }}">
                        <a href="{{ route('admin.patients') }}"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.appointments') ? 'active' : '' }}">
                        <a href="{{ route('admin.appointments') }}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                    </li>
                    <li class="{{ request()->is('services') ? 'active' : '' }}">
                        <a href="/services"><i class="fa fa-hospital-o"></i> <span>Department</span></a>
                    </li>
                    <li class="{{ request()->is('reports') ? 'active' : '' }}">
                        <a href="/reports"><i class="fa fa-file-text"></i> <span>Reports</span></a>
                    </li>


                    <li class="{{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                    <a href="{{ route('admin.messages') }}">
                        <i class="fa fa-envelope"></i> 
                        <span>Messages</span>
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="badge badge-pill bg-danger float-right" style="margin-top: 3px;">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="page-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>

</div>

<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

@stack('scripts')

<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
$(document).ready(function() {
    $('#notification-toggle').on('click', function() {
        $('#notification-badge').fadeOut(300);
        $.ajax({
            url: '/notifications/mark-all-read',
            type: 'POST',
            data: { "_token": "{{ csrf_token() }}" }
        });
    });
});
</script>

</body>
</html>
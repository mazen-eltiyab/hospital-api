<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <title>@yield('title', 'MediCare')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    
    <style>
        :root {
            --online-green: #55ce63;
            --avatar-size: 38px;
            --gold:          #C9A24D;
            --gold-light:    #e8c97a;
            --gold-faint:    rgba(201,162,77,0.12);
            --navy:          #1F2A44;
            --navy-dark:     #0f172a;
            --gray-light:    #f4f7f9;
            --border:        rgba(201,162,77,0.25);
            --shadow-sm:     0 2px 10px rgba(0,0,0,0.05);
            --shadow-md:     0 12px 40px rgba(15, 23, 42, 0.15);
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
        .user-menu.nav > li {
            list-style: none;
        }

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

        .user-link:hover {
            background: rgba(255,255,255,0.2) !important;
        }

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
            bottom: 0px; 
            right: 0px;
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
            width: 46px;
            height: 46px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.8);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            flex-shrink: 0;
        }
        .dropdown-user-info {
            flex: 1;
        }
        .dropdown-user-info .user-fullname {
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            margin: 0;
            line-height: 1.3;
        }
        .dropdown-user-info .user-role-badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px;
            margin-top: 3px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .lang-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 9px;
            background: rgba(255,255,255,0.12);
            color: #fff !important;
            font-size: 11px;
            font-weight: 600;
            padding: 5px 12px 5px 8px;
            border-radius: 20px;
            text-decoration: none !important;
            transition: all 0.25s ease;
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.25);
            letter-spacing: 0.4px;
        }
        .lang-btn:hover {
            background: rgba(255,255,255,0.25);
            border-color: rgba(255,255,255,0.5);
            color: #fff !important;
            transform: translateY(-1px);
            text-decoration: none !important;
        }
        .lang-btn .lang-globe {
            font-size: 12px;
            opacity: 0.9;
        }
        .lang-btn .lang-divider {
            width: 1px;
            height: 10px;
            background: rgba(255,255,255,0.35);
            display: inline-block;
            flex-shrink: 0;
        }
        .lang-btn .lang-text {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .has-arrow .dropdown-menu .dropdown-item {
            padding: 10px 18px;
            font-size: 13px;
            font-weight: 500;
            color: #444;
            transition: background 0.2s, color 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .has-arrow .dropdown-menu .dropdown-item i {
            width: 16px;
            text-align: center;
            color: #888;
            font-size: 14px;
            transition: color 0.2s;
        }
        .has-arrow .dropdown-menu .dropdown-item:hover {
            background: #f0f6ff;
            color: #1a3d6d;
        }
        .has-arrow .dropdown-menu .dropdown-item:hover i {
            color: #1a3d6d;
        }
        .has-arrow .dropdown-menu .dropdown-item.text-danger:hover {
            background: #fff5f5;
            color: #dc3545 !important;
        }
        .has-arrow .dropdown-menu .dropdown-item.text-danger:hover i {
            color: #dc3545;
        }
        .dropdown-divider { margin: 4px 0; }

        /* إخفاء شريط جوجل ترانسليت */
        .goog-te-banner-frame { display: none !important; }
        .goog-te-menu-value:hover { text-decoration: none !important; }
        .goog-te-gadget { display: none !important; }
        .goog-te-gadget-simple { display: none !important; }
        #goog-gt-tt { display: none !important; }
        .goog-tooltip { display: none !important; }
        .goog-tooltip:hover { display: none !important; }
        .goog-text-highlight { background: none !important; box-shadow: none !important; }
        .VIpgJd-ZVi9od-aZ2wEe-wOHMyf { display: none !important; }
        .VIpgJd-ZVi9od-aZ2wEe { display: none !important; }
        .skiptranslate { display: none !important; }
        iframe.skiptranslate { display: none !important; }
        body { top: 0 !important; position: static !important; }

        @media (max-width: 991px) {
            .user-name-text { display: none; }
            .user-link { padding: 4px !important; border-radius: 50% !important; }
        }

        @media (max-width: 767px) {
            .header { padding: 0 20px; height: 60px; }
            .header-left .logo { display: flex; align-items: center; }
            .header-left .logo img { width: 35px; height: 35px; }
            .header-left .logo span { font-size: 20px; }
            .notifications.dropdown-menu { width: 300px; position: absolute; right: -20px; }
        }

        @media (max-width: 480px) {
            .header-left .logo span { font-size: 18px; letter-spacing: 0; }
            .header-left .logo img { width: 30px; height: 30px; min-width: 30px; }
            .notifications.dropdown-menu { width: calc(100vw - 40px); right: -10px; }
            .card-body { padding: 15px; }
        }

        /* ==========================================================================
           ⚡️ واجهة الشات بوت - Widget عائم (Floating) فوق الصفحة
           ========================================================================== */
        .chat-bubble-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--navy) 0%, #2563a8 100%);
            border: 2px solid var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #fff;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            z-index: 1060;
            transition: transform 0.25s cubic-bezier(0.2,0.9,0.4,1.1), box-shadow 0.25s ease;
        }
        .chat-bubble-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 16px 40px rgba(15,23,42,0.3);
        }
        .chat-bubble-btn.is-hidden { display: none; }

        .chat-bubble-pulse {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid var(--gold);
            animation: bubblePulse 2.2s infinite;
        }
        @keyframes bubblePulse {
            0%   { transform: scale(1); opacity: 0.6; }
            100% { transform: scale(1.6); opacity: 0; }
        }

        .chat-box {
            position: fixed;
            bottom: 100px;
            right: 24px;
            width: 370px;
            max-width: calc(100vw - 32px);
            height: 560px;
            max-height: calc(100vh - 130px);
            margin: 0;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: var(--shadow-md);
            display: none;
            flex-direction: column;
            z-index: 1055;
            border: 1px solid var(--border);
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            transition: box-shadow 0.3s ease;
        }

        .chat-box.is-open {
            display: flex;
            animation: chatPopIn 0.28s cubic-bezier(0.2,0.9,0.4,1.1);
        }

        @keyframes chatPopIn {
            from { opacity: 0; transform: translateY(16px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .chat-box:hover { box-shadow: 0 14px 45px rgba(15, 23, 42, 0.2); }

        .chat-header {
            background: linear-gradient(135deg, var(--navy) 0%, #2563a8 100%);
            color: white;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 2px solid var(--gold);
            flex-shrink: 0;
        }

        .chat-header .bot-avatar-icon {
            width: 40px; height: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; border: 1px solid var(--border);
        }

        .chat-header-info { flex: 1; }
        .chat-header-info h4 { margin: 0; font-size: 15px; font-weight: 700; letter-spacing: 0.3px; }
        .chat-header-info span { font-size: 11px; opacity: 0.85; display: flex; align-items: center; gap: 5px; margin-top: 2px; }
        .chat-header-info .status-dot { width: 7px; height: 7px; background: var(--online-green); border-radius: 50%; display: inline-block; box-shadow: 0 0 8px var(--online-green); }

        .chat-close-btn {
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
            width: 30px; height: 30px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s ease;
            flex-shrink: 0;
        }
        .chat-close-btn:hover { background: rgba(255,255,255,0.3); }

        #chat-messages {
            flex-grow: 1;
            padding: 24px;
            overflow-y: auto;
            background: var(--gray-light);
            display: flex;
            flex-direction: column;
            gap: 16px;
            scroll-behavior: smooth;
        }

        .msg-container {
            display: flex;
            align-items: flex-end;
            gap: 10px;
            max-width: 85%;
            animation: fadeInUp 0.35s ease cubic-bezier(0.25, 1, 0.5, 1);
        }

        .msg-container.user-layout { align-self: flex-end; flex-direction: row-reverse; }
        .msg-container.bot-layout { align-self: flex-start; }
        .msg-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 1px solid rgba(0,0,0,0.05); }
        .msg-bubble { padding: 12px 18px; font-size: 14px; line-height: 1.6; word-wrap: break-word; position: relative; }

        .msg-user .msg-bubble {
            background: linear-gradient(135deg, var(--navy) 0%, #204b85 100%);
            color: white; border-radius: 18px 18px 0px 18px; text-align: right;
            box-shadow: 0 4px 12px rgba(31, 42, 68, 0.15);
        }

        .msg-bot .msg-bubble {
            background: #ffffff; color: var(--navy);
            border-radius: 18px 18px 18px 0px; text-align: right;
            box-shadow: var(--shadow-sm); border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .chips-wrapper { margin-top: 10px; display: flex; flex-wrap: wrap; gap: 8px; justify-content: flex-start; direction: rtl; }

        .chat-chip {
            display: inline-block; background: #ffffff;
            color: var(--navy); border: 1px solid var(--gold);
            padding: 8px 16px; border-radius: 20px;
            font-size: 13px; font-weight: 600; cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
        }

        .chat-chip:hover {
            background: var(--gold); color: #fff;
            border-color: var(--gold-light); transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(201, 162, 77, 0.25);
        }

        .calendar-card {
            margin-top: 10px; background: #ffffff; border: 1px solid var(--border);
            padding: 14px; border-radius: 14px; box-shadow: var(--shadow-sm);
            display: flex; flex-direction: column; gap: 10px; width: 100%; min-width: 240px;
        }
        .calendar-input {
            width: 100%; border: 1px solid var(--gold); border-radius: 8px;
            padding: 10px; font-family: 'Inter', sans-serif; font-size: 14px;
            outline: none; color: var(--navy); text-align: center; background: var(--gray-light);
        }
        .calendar-btn {
            background: var(--navy); color: white; border: none; padding: 10px;
            border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer;
            transition: background 0.2s; text-align: center;
        }
        .calendar-btn:hover { background: var(--gold); }

        .typing-indicator-container { align-self: flex-start; display: flex; align-items: center; gap: 10px; animation: fadeIn 0.3s ease; }
        .typing-indicator { display: inline-flex; align-items: center; gap: 5px; padding: 14px 20px; background: #ffffff; border-radius: 18px 18px 18px 0px; border: 1px solid rgba(0, 0, 0, 0.03); box-shadow: var(--shadow-sm); }
        .typing-indicator span { width: 7px; height: 7px; background: var(--gold); border-radius: 50%; animation: pulse-blink 1.4s infinite both; }
        .typing-indicator span:nth-child(2) { animation-delay: .2s; }
        .typing-indicator span:nth-child(3) { animation-delay: .4s; }

        @keyframes pulse-blink { 0%, 100% { transform: scale(0.7); opacity: .3; } 50% { transform: scale(1); opacity: 1; } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .chat-input-area { padding: 16px 20px; border-top: 1px solid rgba(0, 0, 0, 0.05); display: flex; background: #ffffff; align-items: center; flex-shrink: 0; gap: 12px; }
        .chat-input-wrapper { position: relative; flex: 1; display: flex; align-items: center; }
        .chat-input-wrapper .form-control { border-radius: 24px; padding: 12px 20px; font-size: 14px; flex: 1; outline: none; direction: rtl; border: 1px solid #e2e8f0; background: #f8fafc; transition: all 0.3s ease; box-shadow: none; }
        .chat-input-wrapper .form-control:focus { border-color: var(--navy); background: #ffffff; box-shadow: 0 0 0 3px rgba(31, 42, 68, 0.1); }

        #chat-submit {
            background: var(--navy); color: white; border: none; width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; cursor: pointer;
            transition: all 0.25s ease; box-shadow: 0 4px 10px rgba(31, 42, 68, 0.2); flex-shrink: 0;
        }
        #chat-submit:hover { background: var(--navy-dark); transform: scale(1.05); }
        #chat-submit i { font-size: 15px; transform: scaleX(-1); }

        #chat-messages::-webkit-scrollbar { width: 5px; }
        #chat-messages::-webkit-scrollbar-track { background: transparent; }
        #chat-messages::-webkit-scrollbar-thumb { background: rgba(201,162,77,0.3); border-radius: 10px; }

        @media (max-width: 480px) {
            .chat-box {
                right: 16px;
                left: 16px;
                width: auto;
                bottom: 90px;
                height: calc(100vh - 130px);
            }
            .chat-bubble-btn { bottom: 16px; right: 16px; }
        }
    </style>
    
    @stack('styles')
</head>
<body>
<div class="main-wrapper">

    <!-- ========== HEADER ========== -->
    <div class="header">

        <!-- Logo -->
        <div class="header-left">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="MediCare Logo">
                <span>MediCare</span>
            </a>
        </div>

        <!-- Sidebar Toggle -->
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>

        <!-- Right Menu -->
        <ul class="nav user-menu float-right">

            <!-- 🔔 Notification Bell -->
            <li class="nav-item dropdown">
                <a href="#" class="bell-btn dropdown-toggle" data-toggle="dropdown" id="notification-toggle">
                    <i class="fa fa-bell-o"></i>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span id="notification-badge">
                            {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </a>

                <div class="dropdown-menu notifications dropdown-menu-right">
                    <div class="topnav-dropdown-header">
                        <span>🔔 Notifications</span>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge badge-danger" style="font-size:10px;">
                                {{ auth()->user()->unreadNotifications->count() }} New
                            </span>
                        @endif
                    </div>
                    <ul class="notification-list">
                        @forelse(auth()->user()->notifications->take(10) as $notification)
                            <li class="notification-message {{ $notification->read_at ? '' : 'unread-notify' }}">
                                <a href="{{ $notification->data['url'] ?? '#' }}">
                                    <p class="noti-details">
                                        <span class="noti-title">{{ $notification->data['title'] ?? 'Notification' }}</span><br>
                                        {{ $notification->data['message'] ?? '' }}
                                    </p>
                                    <p class="noti-time">
                                        <i class="fa fa-clock-o"></i> {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </a>
                            </li>
                        @empty
                            <li class="text-center p-4">
                                <i class="fa fa-bell-slash-o" style="font-size:26px; color:#ddd;"></i>
                                <p style="color:#bbb; margin-top:8px; font-size:13px;">No notifications</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </li>

            <!-- 👤 User Dropdown -->
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle user-link nav-link" data-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle"
                             id="user-avatar-source"
                             src="{{ optional(Auth::user()->patient)->avatar ? asset('assets/img/' . Auth::user()->patient->avatar) : asset('assets/img/user.jpg') }}"
                             alt="{{ Auth::user()->name }}">
                        <span class="status online"></span>
                    </span>
                    <span class="user-name-text">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-user-header">
                        <img src="{{ optional(Auth::user()->patient)->avatar ? asset('assets/img/' . Auth::user()->patient->avatar) : asset('assets/img/user.jpg') }}"
                             alt="{{ Auth::user()->name }}">
                        <div class="dropdown-user-info">
                            <p class="user-fullname">{{ Auth::user()->name }}</p>
                            <span class="user-role-badge">Patient</span>

                            <!-- زرار تغيير اللغة -->
                            <a href="javascript:void(0);" class="lang-btn" onclick="toggleLang()">
                                <span class="lang-globe">🌐</span>
                                <span class="lang-divider"></span>
                                <span class="lang-text" id="lang-label">العربية</span>
                            </a>

                        </div>
                    </div>

                    <a class="dropdown-item" href="{{ url('patient/my-profile') }}">
                        <i class="fa fa-user-circle-o"></i> My Profile
                    </a>
                    <a class="dropdown-item" href="{{ url('patient/profile/edit') }}">
                        <i class="fa fa-pencil-square-o"></i> Edit Profile
                    </a>
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
    <!-- END HEADER -->

    <!-- ========== SIDEBAR ========== -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>
                    
                    <li class="{{ request()->path() == 'patient' ? 'active' : '' }}">
                        <a href="{{ url('patient') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    
                    <li class="{{ request()->path() == 'patient_doctors' ? 'active' : '' }}">
                        <a href="{{ url('patient_doctors') }}"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                    </li>
                    
                    <li class="{{ request()->path() == 'appointments_patient' ? 'active' : '' }}">
                        <a href="{{ url('appointments_patient') }}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                    </li>
                    
                    <li class="{{ request()->path() == 'book_appointments' ? 'active' : '' }}">
                        <a href="{{ url('book_appointments') }}"><i class="fa fa-plus-square"></i> <span>Book Appointment</span></a>
                    </li>
                    
                    <li class="{{ request()->path() == 'medical_reports' ? 'active' : '' }}">
                        <a href="{{ url('medical_reports') }}"><i class="fa fa-file-text-o"></i> <span>Medical Reports</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ========== PAGE CONTENT ========== -->
    <div class="page-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>

</div>

<!-- ========== الأيقونة العائمة بتاعة الشات بوت ========== -->
<div class="chat-bubble-btn" id="chat-bubble">
    <span class="chat-bubble-pulse"></span>
    🤖
</div>

<!-- ========== صندوق الشات بوت العائم ========== -->
<div class="chat-box" id="chat-box">
    <div class="chat-header">
        <div class="bot-avatar-icon">🤖</div>
        <div class="chat-header-info">
            <h4>مساعد المستشفى الذكي</h4>
            <span><span class="status-dot"></span> متصل الآن لمساعدتك</span>
        </div>
        <button class="chat-close-btn" id="chat-close-btn" title="إغلاق"><i class="fa fa-times"></i></button>
    </div>

    <div id="chat-messages">
        <div class="msg-container bot-layout msg-bot">
            <div class="msg-avatar" style="background:#eef2f7; display:flex; align-items:center; justify-content:center; font-size:14px;">🤖</div>
            <div class="msg-bubble">
                أهلاً بك في مستشفانا يا فندم! كيف يمكنني مساعدتك في حجز موعدك اليوم؟
            </div>
        </div>
    </div>

    <div class="chat-input-area">
        <div class="chat-input-wrapper">
            <input type="text" id="chat-input" class="form-control" placeholder="اكتب استفسارك هنا..." autocomplete="off">
        </div>
        <button id="chat-submit" title="إرسال"><i class="fa fa-paper-plane"></i></button>
    </div>
</div>

<!-- Google Translate Element (مخفي) -->
<div id="google_translate_element" style="display:none;"></div>

<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
@stack('scripts')
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- ========== Google Translate Scripts ========== -->
<script>
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'ar,en',
        autoDisplay: false
    }, 'google_translate_element');
}

var currentLang = 'en';

// ✅ الدالة الرئيسية: تغير بريفيكس الدكتور حسب اللغة مع ضبط الاتجاه
function updateDoctorPrefixes() {
    var lang = localStorage.getItem('preferred_lang') || 'en';
    var isAr = (lang === 'ar');
    var prefix = isAr ? 'د.' : 'Dr.';

    document.querySelectorAll('.doctor-prefix').forEach(function(el) {
        el.innerText = prefix;
    });

    document.querySelectorAll('.doctor-name-row').forEach(function(row) {
        row.style.direction = isAr ? 'rtl' : 'ltr';
    });
}

function switchLang(lang) {
    var select = document.querySelector('.goog-te-combo');
    if (select) {
        select.value = lang;
        select.dispatchEvent(new Event('change'));
        localStorage.setItem('preferred_lang', lang);
        currentLang = lang;
        document.getElementById('lang-label').innerText = (lang === 'ar') ? 'English' : 'العربية';

        updateDoctorPrefixes();
    }
}

function toggleLang() {
    var current = localStorage.getItem('preferred_lang') || 'en';
    var next = (current === 'ar') ? 'en' : 'ar';
    switchLang(next);
}

window.addEventListener('load', function() {
    var saved = localStorage.getItem('preferred_lang') || 'en';
    currentLang = saved;

    document.getElementById('lang-label').innerText = (saved === 'ar') ? 'English' : 'العربية';

    updateDoctorPrefixes();

    if (saved === 'ar') {
        setTimeout(function() { switchLang('ar'); }, 1500);
    }
});
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

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

<!-- ========== Chatbot Script (الشات بوت العائم) ========== -->
<script>
$(document).ready(function() {

    /* ===================== فتح / قفل صندوق الشات العائم ===================== */
    var $chatBubble = $('#chat-bubble');
    var $chatBox = $('#chat-box');
    var $chatCloseBtn = $('#chat-close-btn');

    function openChat() {
        $chatBox.addClass('is-open');
        $chatBubble.addClass('is-hidden');
        scrollToBottom();
    }

    function closeChat() {
        $chatBox.removeClass('is-open');
        $chatBubble.removeClass('is-hidden');
    }

    $chatBubble.on('click', openChat);
    $chatCloseBtn.on('click', closeChat);
    /* ========================================================================= */

    scrollToBottom();

    $('#chat-submit').click(function() { sendMessage(); });
    $('#chat-input').keypress(function(e) { if(e.which == 13) { sendMessage(); } });

    var chatHistory = [];
    var userAvatarUrl = $('#user-avatar-source').attr('src');
    var isBookingComplete = false;
    var globalSelectedDate = '';

    function scrollToBottom() {
        var container = $('#chat-messages');
        if (container.length) {
            setTimeout(function() {
                container.stop().animate({
                    scrollTop: container.prop("scrollHeight")
                }, 300);
            }, 100);
        }
    }

    function parseBotReply(text) {
        if (text.includes("السنة-الشهر-اليوم") || text.includes("التاريخ المناسب")) {
            var today = new Date().toISOString().split('T')[0];
            var calendarHtml = `
                <div class="calendar-card" style="direction: rtl;">
                    <label style="font-size: 13px; font-weight:600; color:var(--navy);"><i class="fa fa-calendar"></i> اختر تاريخ موعدك:</label>
                    <input type="date" class="calendar-input" id="bot-date-picker" min="${today}">
                    <button class="calendar-btn" onclick="submitSelectedDate()">تأكيد هذا التاريخ ورؤية المواعيد</button>
                </div>`;
            return '<div>' + text + '</div>' + calendarHtml;
        }

        if (text.includes('[') && text.includes(']')) {
            var rawList = text.match(/\[(.*?)\]/);
            if (rawList && rawList[1]) {
                var items = rawList[1].split('-');
                var cleanText = text.replace(/\[.*?\]/, '').trim();

                var html = '<div>' + cleanText + '</div><div class="chips-wrapper">';
                items.forEach(function(item) {
                    var trimmedItem = item.trim();
                    if(trimmedItem) {
                        html += '<span class="chat-chip" onclick="triggerChipClick(\'' + trimmedItem + '\')">' + trimmedItem + '</span>';
                    }
                });
                html += '</div>';
                return html;
            }
        }
        return text;
    }

    window.triggerChipClick = function(value) {
        if (isBookingComplete) return;
        $('#chat-input').val(value);
        sendMessage();
    };

    window.submitSelectedDate = function() {
        if (isBookingComplete) return;
        var dateValue = $('#bot-date-picker').val();
        if (!dateValue) {
            alert("برجاء اختيار التاريخ أولاً يا فندم!");
            return;
        }

        globalSelectedDate = dateValue;

        var userDateHtml = `
            <div class="msg-container user-layout msg-user">
                <img src="${userAvatarUrl}" class="msg-avatar" alt="User">
                <div class="msg-bubble">${dateValue}</div>
            </div>`;
        $('#chat-messages').append(userDateHtml);
        scrollToBottom();

        var tempTypingId = 'fetching_slots';
        $('#chat-messages').append(`<div class="typing-indicator-container" id="${tempTypingId}"><div class="msg-avatar">🤖</div><div class="typing-indicator"><span></span><span></span><span></span></div></div>`);
        scrollToBottom();

        $.ajax({
            url: "/chatbot/message",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                check_date: dateValue
            },
            success: function(res) {
                $('#' + tempTypingId).remove();

                var chipsHtml = '';
                if (res.slots && res.slots.length > 0) {
                    res.slots.forEach(function(slot) {
                        chipsHtml += `<span class="chat-chip" onclick="triggerChipClick('${slot}')">${slot}</span>`;
                    });
                } else {
                    chipsHtml = '<p style="color:#dc3545; font-size:12px; font-weight:600;">⚠️ عذراً، جميع مواعيد هذا اليوم محجوزة بالكامل. يرجى اختيار تاريخ آخر.</p>';
                }

                var hoursHtml = `
                    <div class="msg-container bot-layout msg-bot">
                        <div class="msg-avatar" style="background:#eef2f7; display:flex; align-items:center; justify-content:center; font-size:14px;">🤖</div>
                        <div class="msg-bubble">
                            ⏰ الساعات المتاحة والمتبقية ليوم [ ${res.date} ] في المستشفى هي:
                            <div class="chips-wrapper">
                                ${chipsHtml}
                            </div>
                        </div>
                    </div>`;

                $('#chat-messages').append(hoursHtml);
                scrollToBottom();
                chatHistory.push({ role: 'user', text: dateValue });
            }
        });
    };

    function sendMessage() {
        if (isBookingComplete) return;

        var message = $('#chat-input').val().trim();
        if (message === '') return;

        var userMsgHtml = `
            <div class="msg-container user-layout msg-user">
                <img src="${userAvatarUrl}" class="msg-avatar" alt="User">
                <div class="msg-bubble">${message}</div>
            </div>`;

        $('#chat-messages').append(userMsgHtml);
        $('#chat-input').val('');
        scrollToBottom();

        var typingId = 'typing_' + Date.now();
        var typingHtml = `
            <div class="typing-indicator-container" id="${typingId}">
                <div class="msg-avatar" style="background:#eef2f7; display:flex; align-items:center; justify-content:center; font-size:14px;">🤖</div>
                <div class="typing-indicator"><span></span><span></span><span></span></div>
            </div>`;

        $('#chat-messages').append(typingHtml);
        scrollToBottom();

        $.ajax({
            url: "/chatbot/message",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                message: message,
                history: chatHistory,
                chosen_date: globalSelectedDate
            },
            success: function(response) {
                $('#' + typingId).remove();

                if (response.reply && (response.reply.includes("تم الحجز بنجاح") || response.status === 'success')) {
                    isBookingComplete = true;

                    var successHtml = `
                        <div class="msg-container bot-layout msg-bot">
                            <div class="msg-avatar" style="background:#eef2f7; display:flex; align-items:center; justify-content:center; font-size:14px;">🎉</div>
                            <div class="msg-bubble" style="background: #f0fdf4; color: #166534; border: 1px solid rgba(22,101,52,0.15); font-weight: 600;">
                                ${response.reply}
                            </div>
                        </div>`;
                    $('#chat-messages').append(successHtml);
                    scrollToBottom();

                    setTimeout(function() { location.reload(); }, 2500);
                    return;
                }

                var dynamicReply = parseBotReply(response.reply);

                var botMsgHtml = `
                    <div class="msg-container bot-layout msg-bot">
                        <div class="msg-avatar" style="background:#eef2f7; display:flex; align-items:center; justify-content:center; font-size:14px;">🤖</div>
                        <div class="msg-bubble">${dynamicReply}</div>
                    </div>`;

                $('#chat-messages').append(botMsgHtml);
                scrollToBottom();

                chatHistory.push({ role: 'user', text: message });
                chatHistory.push({ role: 'model', text: response.reply });
            },
            error: function(xhr) {
                $('#' + typingId).remove();
                console.log("خطأ في السيرفر: ", xhr.responseText);
                var errorHtml = `
                    <div class="msg-container bot-layout">
                        <div class="msg-avatar" style="background:#f8d7da; display:flex; align-items:center; justify-content:center; font-size:14px;">⚠️</div>
                        <div class="msg-bubble" style="background: #fff5f5; color: #e53e3e; border: 1px solid rgba(229,62,62,0.15); direction: rtl;">حدث خطأ أثناء معالجة الطلب، يرجى المحاولة لاحقاً.</div>
                    </div>`;
                $('#chat-messages').append(errorHtml);
                scrollToBottom();
            }
        });
    }
});
</script>

</body>
</html>
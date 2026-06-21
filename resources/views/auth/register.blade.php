<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>MediCare - Sign Up</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

    <script>
        (function() {
            try {
                const savedLang = localStorage.getItem('siteLang');
                if (savedLang === 'ar') {
                    document.documentElement.lang = 'ar';
                    document.documentElement.dir = 'rtl';
                } else {
                    document.documentElement.lang = 'en';
                    document.documentElement.dir = 'ltr';
                }
            } catch(e) {}
        })();
    </script>

    <style>
        /* RESET & BASE - RESPONSIVE */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --navy:       #1F2A44;
            --navy-deep:  #0d1526;
            --navy-mid:   #162035;
            --gold:       #C9A24D;
            --gold-dark:  #A88536;
            --gold-light: #e8c97a;
            --white:      #ffffff;
            --gray-50:    #f8f8f6;
            --gray-100:   #f0ede8;
            --gray-200:   #e0ddd6;
            --gray-400:   #a09d96;
            --text-muted: #6b7280;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f1824 0%, #1a2640 40%, #0d1520 100%);
            overflow-x: hidden;
            overflow-y: auto;
            position: relative;
            padding: 20px;
            touch-action: pan-y pinch-zoom;
        }

        /* Background layers (fixed) */
        .bg-particles, .bg-texture, .bg-glow {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }
        .bg-particles { z-index: 1; }
        .bg-texture   { z-index: 2; background-image: radial-gradient(circle, rgba(201,162,77,0.07) 1px, transparent 1px); background-size: 32px 32px; }
        .bg-glow      { z-index: 3; background: radial-gradient(ellipse 55% 55% at 28% 48%, rgba(201,162,77,0.07) 0%, transparent 70%), radial-gradient(ellipse 50% 60% at 72% 60%, rgba(31,42,68,0.35) 0%, transparent 70%); }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(201, 162, 77, 0.18);
            animation: float-particle linear infinite;
        }
        @keyframes float-particle {
            0%   { transform: translateY(100vh) scale(0); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 0.6; }
            100% { transform: translateY(-10vh) scale(1.2); opacity: 0; }
        }

        /* MAIN CARD */
        .mc-card {
            position: relative;
            z-index: 20;
            display: flex;
            width: 100%;
            max-width: 1100px;
            border-radius: 32px;
            overflow: hidden;
            background: transparent;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.5), 0 0 0 0.5px rgba(201, 162, 77, 0.25);
            animation: card-enter 0.85s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        @keyframes card-enter {
            from { transform: translateY(30px) scale(0.96); opacity: 0; filter: blur(4px); }
            to   { transform: none; opacity: 1; filter: none; }
        }

        /* LEFT PANEL */
        .mc-left {
            width: 44%;
            background: linear-gradient(165deg, #1F2A44 0%, #162035 55%, #0d1526 100%);
            padding: 40px 36px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .mc-left::before, .mc-left::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        .mc-left::before {
            width: 260px; height: 260px;
            border: 1px solid rgba(201, 162, 77, 0.12);
            right: -80px; top: -60px;
            animation: spin-ring 20s linear infinite;
        }
        .mc-left::after {
            width: 180px; height: 180px;
            border: 1px solid rgba(201, 162, 77, 0.07);
            right: -40px; top: -20px;
            animation: spin-ring 13s linear infinite reverse;
        }
        .orbit-sm {
            position: absolute;
            width: 100px; height: 100px;
            border-radius: 50%;
            border: 1px solid rgba(201, 162, 77, 0.06);
            right: -15px; top: 30px;
            animation: spin-ring 8s linear infinite;
            pointer-events: none;
        }
        @keyframes spin-ring { to { transform: rotate(360deg); } }
        .left-mesh {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 150px;
            background: linear-gradient(to top, rgba(201,162,77,0.06), transparent);
            pointer-events: none;
        }
        .pulse-dot {
            position: absolute;
            bottom: 32px; right: 30px;
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 0 0 rgba(201, 162, 77, 0.6);
            animation: pulse 2.5s infinite;
        }
        @keyframes pulse {
            0%   { box-shadow: 0 0 0 0 rgba(201, 162, 77, 0.6); }
            70%  { box-shadow: 0 0 0 14px rgba(201, 162, 77, 0); }
            100% { box-shadow: 0 0 0 0 rgba(201, 162, 77, 0); }
        }

        /* Logo */
        .mc-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            animation: fade-up 0.7s 0.15s both;
        }
        .logo-mark {
            width: 50px; height: 50px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--gold) 0%, #9a7228 100%);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 24px; font-weight: 700;
            color: white;
            box-shadow: 0 8px 28px rgba(201, 162, 77, 0.4);
            flex-shrink: 0;
        }
        .logo-text .brand {
            font-family: 'Playfair Display', serif;
            font-size: 24px; font-weight: 700;
            color: white; line-height: 1.2;
            letter-spacing: 0.3px;
        }
        .logo-text .tagline {
            font-size: 9px; color: var(--gold);
            letter-spacing: 2.5px; text-transform: uppercase;
            font-weight: 500; display: block; margin-top: 4px;
        }

        /* Headline */
        .mc-headline {
            font-family: 'Playfair Display', serif;
            font-size: clamp(22px, 5vw, 34px);
            font-weight: 700;
            color: white;
            line-height: 1.25;
            margin-top: 30px;
            animation: fade-up 0.7s 0.3s both;
        }
        .mc-headline em { color: var(--gold); font-style: normal; }
        .mc-desc {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.65);
            line-height: 1.6;
            margin-top: 12px;
            animation: fade-up 0.7s 0.42s both;
        }

        /* Features */
        .mc-features {
            margin-top: 28px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            animation: fade-up 0.7s 0.54s both;
        }
        .mc-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: rgba(255,255,255,0.7);
            transition: transform 0.2s;
        }
        .mc-feature:hover { transform: translateX(4px); color: white; }
        [dir="rtl"] .mc-feature:hover { transform: translateX(-4px); }
        .feature-icon {
            width: 32px; height: 32px;
            border-radius: 10px;
            background: rgba(201,162,77,0.15);
            border: 0.5px solid rgba(201,162,77,0.25);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold);
            flex-shrink: 0;
        }

        /* Step dots */
        .mc-steps {
            display: flex;
            gap: 8px;
            margin-top: 32px;
            animation: fade-up 0.7s 0.65s both;
        }
        .step-dot {
            height: 4px;
            border-radius: 2px;
            background: rgba(201,162,77,0.3);
            transition: width 0.4s ease, background 0.4s ease;
        }
        .step-dot.active { background: var(--gold); }

        /* Avatars */
        .mc-avatars {
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fade-up 0.7s 0.72s both;
        }
        .avatar-stack { display: flex; }
        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 2.5px solid #1F2A44;
            margin-left: -10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 600; color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .avatar:first-child { margin-left: 0; }
        .avatar-text {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        /* RIGHT PANEL */
        .mc-right {
            flex: 1;
            background: var(--white);
            padding: 44px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow-y: auto;
        }
        .mc-right::before {
            content: '';
            position: absolute; inset: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, rgba(31,42,68,0.04) 1px, transparent 1px);
            background-size: 22px 22px;
        }

        /* Tabs */
        .mc-tabs {
            display: flex;
            gap: 28px;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 28px;
            animation: fade-in 0.6s 0.5s both;
        }
        .mc-tab {
            padding: 0 0 14px;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            border-bottom: 2.5px solid transparent;
            transition: all 0.2s;
            text-decoration: none;
        }
        .mc-tab.active {
            color: var(--navy);
            border-bottom-color: var(--navy);
        }
        .mc-tab:hover:not(.active) { color: var(--gold); }

        /* Forms */
        .form-group {
            position: relative;
            margin-bottom: 16px;
            animation: fade-up 0.6s both;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            animation: fade-up 0.6s 0.60s both;
        }
        .form-label {
            display: block;
            font-size: 11px; font-weight: 600;
            color: var(--navy);
            letter-spacing: 1.1px; text-transform: uppercase;
            margin-bottom: 8px;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 14px;
            transition: all 0.2s;
            pointer-events: none;
        }
        .form-control {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1.5px solid var(--gray-200);
            border-radius: 16px;
            font-size: 15px;
            font-family: 'DM Sans', sans-serif;
            color: var(--navy);
            background: var(--gray-50);
            outline: none;
            transition: 0.2s;
        }
        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201, 162, 77, 0.12);
            background: white;
            transform: translateY(-1px);
        }
        .input-wrap:focus-within .input-icon {
            color: var(--gold);
            transform: translateY(-50%) scale(1.1);
        }
        [dir="rtl"] .input-icon { left: auto; right: 14px; }
        [dir="rtl"] .form-control { padding: 13px 42px 13px 14px; }

        /* Password strength */
        .strength-bar {
            height: 3px;
            border-radius: 2px;
            background: var(--gray-200);
            margin-top: 8px;
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            width: 0%;
            transition: width 0.3s, background 0.3s;
        }
        .strength-text {
            font-size: 11px;
            margin-top: 4px;
            color: var(--gray-400);
        }

        .field-error {
            font-size: 12px;
            color: #dc2626;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Buttons */
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--gold) 0%, #b8892e 100%);
            color: white;
            border: none;
            border-radius: 18px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(201, 162, 77, 0.4);
            transition: 0.2s;
            margin-top: 8px;
            position: relative;
            overflow: hidden;
            animation: fade-up 0.6s 0.84s both;
            min-height: 52px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            box-shadow: 0 12px 28px rgba(201, 162, 77, 0.5);
        }
        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0; left: -120%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 3s infinite 1s;
        }
        @keyframes shimmer { to { left: 160%; } }
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            width: 0; height: 0;
            transform: translate(-50%, -50%);
            animation: ripple-expand 0.6s ease-out forwards;
            pointer-events: none;
        }
        @keyframes ripple-expand { to { width: 300px; height: 300px; opacity: 0; } }

        @keyframes fade-up {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }

        /* RESPONSIVE BREAKPOINTS */
        @media (max-width: 900px) {
            .mc-left { padding: 32px 28px; width: 45%; }
            .mc-right { padding: 36px 32px; }
            .logo-text .brand { font-size: 20px; }
        }
        @media (max-width: 768px) {
            body { padding: 16px; align-items: flex-start; }
            .mc-card {
                flex-direction: column;
                border-radius: 28px;
                max-width: 500px;
                margin: 20px auto;
            }
            .mc-left {
                width: 100%;
                padding: 28px 24px;
                border-radius: 28px 28px 0 0;
            }
            .mc-right {
                padding: 28px 24px;
                border-radius: 0 0 28px 28px;
            }
            .form-grid { grid-template-columns: 1fr; gap: 12px; }
            .mc-headline { font-size: 26px; margin-top: 20px; }
            .mc-features { gap: 12px; margin-top: 20px; }
            .mc-steps { margin-top: 24px; }
            .step-dot { height: 4px; }
            .avatar { width: 34px; height: 34px; }
            .btn-submit, .form-control { min-height: 48px; }
            .form-control { padding: 12px 12px 12px 40px; font-size: 14px; }
        }
        @media (max-width: 480px) {
            .mc-left, .mc-right { padding: 20px 18px; }
            .logo-mark { width: 42px; height: 42px; font-size: 20px; }
            .logo-text .brand { font-size: 18px; }
            .logo-text .tagline { font-size: 7px; letter-spacing: 1.5px; }
            .mc-headline { font-size: 22px; }
            .mc-desc { font-size: 13px; }
            .feature-icon { width: 28px; height: 28px; font-size: 12px; }
            .mc-feature span { font-size: 12px; }
            .avatar-text { font-size: 10px; }
            .mc-tab { font-size: 14px; padding-bottom: 10px; }
            .form-label { font-size: 10px; }
            .btn-submit { font-size: 14px; }
        }



         /* Logo */
        .mc-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            animation: fade-up 0.7s 0.15s both;
        }
        .nav-logo {
            display: flex;
            align-items: center;
          
            text-decoration: none;
        }
        .nav-logo-img {
            width:60px;
            height: 60px;
            object-fit: contain;
            transition: transform 0.2s;
        }
        .logo-text .brand {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            letter-spacing: 0.3px;
        }
        .logo-text .tagline {
            font-size: 9px;
            color: var(--gold);
            letter-spacing: 2.5px;
            text-transform: uppercase;
            font-weight: 500;
            display: block;
            margin-top: 4px;
        }
    </style>
</head>
<body>

    <div class="bg-particles" id="bg-particles"></div>
    <div class="bg-texture"></div>
    <div class="bg-glow"></div>

    <div class="mc-card">
        <!-- LEFT PANEL -->
        <div class="mc-left">
            <div class="orbit-sm"></div>
            <div class="left-mesh"></div>
            <div>
<div class="mc-logo">
                    <a href="{{ url('') }}" class="nav-logo">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="MediCare Logo" class="nav-logo-img">
                        <div class="logo-text">
                            <span class="brand">MediCare</span>
                            <span class="tagline">Healthcare Excellence</span>
                        </div>
                    </a>
                </div>
                <h2 class="mc-headline" id="left-title">Join Our<br><em>Community.</em></h2>
                <p class="mc-desc" id="left-desc">Start managing your health and professional tasks efficiently today.</p>
                <div class="mc-features">
                    <div class="mc-feature" id="feature-1">
                        <div class="feature-icon"><i class="fa-solid fa-calendar-check"></i></div>
                        <span id="feat-text-1">Easy appointment booking</span>
                    </div>
                    <div class="mc-feature" id="feature-2">
                        <div class="feature-icon"><i class="fa-solid fa-file-medical"></i></div>
                        <span id="feat-text-2">Digital medical records</span>
                    </div>
                    <div class="mc-feature" id="feature-3">
                        <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <span id="feat-text-3">Secure & private data</span>
                    </div>
                </div>
                <div class="mc-steps">
                    <div class="step-dot" style="width:28px" id="step1"></div>
                    <div class="step-dot" style="width:10px" id="step2"></div>
                    <div class="step-dot" style="width:10px" id="step3"></div>
                </div>
            </div>
            <div class="mc-avatars">
                <div class="avatar-stack">
                    <div class="avatar" style="background: linear-gradient(135deg,#6b9fd4,#4a7db5)">AH</div>
                    <div class="avatar" style="background: linear-gradient(135deg,#e8a87c,#c4784a)">SM</div>
                    <div class="avatar" style="background: linear-gradient(135deg,#a8d8a8,#6cb06c)">NY</div>
                    <div class="avatar" style="background: linear-gradient(135deg,#C9A24D,#8a6420)">+</div>
                </div>
                <span class="avatar-text" id="active-users">+10k active users</span>
            </div>
            <div class="pulse-dot"></div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="mc-right">
            <div class="mc-tabs">
                <a href="{{ route('login') }}" class="mc-tab" id="login-tab">Log In</a>
                <a href="{{ route('register') }}" class="mc-tab active" id="register-tab">Sign Up</a>
            </div>

            <form method="POST" action="{{ route('register') }}" id="register-form">
                @csrf
                <div class="form-group">
                    <label class="form-label" id="name-label">Full Name</label>
                    <div class="input-wrap">
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe" class="form-control" id="name-input">
                        <i class="fa-regular fa-user input-icon"></i>
                    </div>
                    @error('name') <p class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label" id="phone-label">Phone</label>
                        <div class="input-wrap">
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+20..." class="form-control" id="phone-input">
                            <i class="fa-solid fa-phone input-icon"></i>
                        </div>
                        @error('phone') <p class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label" id="age-label">Age</label>
                        <div class="input-wrap">
                            <input type="number" name="age" value="{{ old('age') }}" placeholder="25" min="1" max="120" class="form-control" id="age-input">
                            <i class="fa-solid fa-cake-candles input-icon"></i>
                        </div>
                        @error('age') <p class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top:16px">
                    <label class="form-label" id="email-label">Email Address</label>
                    <div class="input-wrap">
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com" class="form-control" id="email-input">
                        <i class="fa-regular fa-envelope input-icon"></i>
                    </div>
                    @error('email') <p class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label" id="password-label">Password</label>
                        <div class="input-wrap">
                            <input type="password" name="password" required placeholder="••••••••" class="form-control" id="password-input">
                            <i class="fa-solid fa-lock input-icon"></i>
                        </div>
                        <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
                        <div class="strength-text" id="strength-text"></div>
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label" id="confirm-label">Confirm Password</label>
                        <div class="input-wrap">
                            <input type="password" name="password_confirmation" required placeholder="••••••••" class="form-control" id="confirm-input">
                            <i class="fa-solid fa-lock-open input-icon"></i>
                        </div>
                        <div class="strength-text" id="match-text"></div>
                    </div>
                </div>
                @error('password') <p class="field-error" style="margin-top:8px"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror

                <button type="submit" class="btn-submit" id="submit-btn">Create Account</button>
            </form>
        </div>
    </div>

    <script>
        // Particles
        const container = document.getElementById('bg-particles');
        for (let i = 0; i < 24; i++) {
            let p = document.createElement('div');
            p.className = 'particle';
            let sz = Math.random() * 8 + 2;
            p.style.cssText = `width:${sz}px;height:${sz}px;left:${Math.random()*100}%;animation-duration:${Math.random()*14+8}s;animation-delay:-${Math.random()*14}s;opacity:${Math.random()*0.5+0.1}`;
            container.appendChild(p);
        }

        // Step dots animation
        const steps = ['step1','step2','step3'].map(id => document.getElementById(id));
        let stepIdx = 0;
        const updateSteps = () => {
            steps.forEach((step, i) => {
                if (i === stepIdx) {
                    step.style.width = '28px';
                    step.classList.add('active');
                } else {
                    step.style.width = '10px';
                    step.classList.remove('active');
                }
            });
            stepIdx = (stepIdx + 1) % steps.length;
        };
        updateSteps();
        setInterval(updateSteps, 2000);

        // Password strength
        const passInput = document.getElementById('password-input');
        const confirmInput = document.getElementById('confirm-input');
        const strengthFill = document.getElementById('strength-fill');
        const strengthText = document.getElementById('strength-text');
        const matchText = document.getElementById('match-text');

        const strengthLevels = { en: ['', 'Weak', 'Fair', 'Good', 'Strong'], ar: ['', 'ضعيفة', 'مقبولة', 'جيدة', 'قوية'] };
        const strengthColors = ['', '#ef4444', '#f59e0b', '#3b82f6', '#22c55e'];

        const getStrength = (pw) => {
            let score = 0;
            if (!pw) return 0;
            if (pw.length >= 8) score++;
            if (/[A-Z]/.test(pw)) score++;
            if (/[0-9]/.test(pw)) score++;
            if (/[^A-Za-z0-9]/.test(pw)) score++;
            return score;
        };

        const updateStrength = () => {
            const pw = passInput.value;
            const score = getStrength(pw);
            const lang = document.documentElement.lang || 'en';
            const pct = pw.length ? (score / 4) * 100 : 0;
            strengthFill.style.width = `${pct}%`;
            strengthFill.style.background = strengthColors[score] || '';
            strengthText.textContent = pw.length ? (strengthLevels[lang] || strengthLevels.en)[score] : '';
            strengthText.style.color = strengthColors[score] || '';
            checkMatch();
        };

        const checkMatch = () => {
            const pw = passInput.value;
            const cpw = confirmInput.value;
            const lang = document.documentElement.lang || 'en';
            if (!cpw) { matchText.textContent = ''; return; }
            if (pw === cpw) {
                matchText.textContent = lang === 'ar' ? '✓ كلمات المرور متطابقة' : '✓ Passwords match';
                matchText.style.color = '#22c55e';
            } else {
                matchText.textContent = lang === 'ar' ? '✗ كلمات المرور غير متطابقة' : '✗ Passwords do not match';
                matchText.style.color = '#ef4444';
            }
        };

        passInput.addEventListener('input', updateStrength);
        confirmInput.addEventListener('input', checkMatch);

        // Ripple effect
        document.getElementById('submit-btn').addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement('span');
            ripple.className = 'ripple';
            ripple.style.left = (e.clientX - rect.left) + 'px';
            ripple.style.top = (e.clientY - rect.top) + 'px';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
            const btn = this;
            const orig = btn.innerText;
            btn.innerText = '⏳ Creating account…';
            btn.style.opacity = '0.8';
            setTimeout(() => { btn.innerText = orig; btn.style.opacity = ''; }, 2000);
        });

        // Input focus icons
        document.querySelectorAll('.form-control').forEach(inp => {
            const icon = inp.parentElement?.querySelector('.input-icon');
            inp.addEventListener('focus', () => { if(icon) { icon.style.color = 'var(--gold)'; icon.style.transform = 'translateY(-50%) scale(1.1)'; } });
            inp.addEventListener('blur', () => { if(icon) { icon.style.color = ''; icon.style.transform = ''; } });
        });

        // Translations
        const translations = {
            en: {
                leftTitle: "Join Our<br><em>Community.</em>", leftDesc: "Start managing your health and professional tasks efficiently today.",
                feat1: "Easy appointment booking", feat2: "Digital medical records", feat3: "Secure & private data",
                activeUsers: "+10k active users", loginTab: "Log In", registerTab: "Sign Up",
                nameLabel: "Full Name", phoneLabel: "Phone", ageLabel: "Age", emailLabel: "Email Address",
                passwordLabel: "Password", confirmLabel: "Confirm Password", submitBtn: "Create Account",
                namePH: "John Doe", phonePH: "+20...", agePH: "25", emailPH: "name@example.com"
            },
            ar: {
                leftTitle: "انضم إلى<br><em>مجتمعنا.</em>", leftDesc: "ابدأ في إدارة صحتك ومهامك المهنية بكفاءة اليوم.",
                feat1: "حجز المواعيد بسهولة", feat2: "السجلات الطبية الرقمية", feat3: "بيانات آمنة وخاصة",
                activeUsers: "+١٠ آلاف مستخدم نشط", loginTab: "تسجيل الدخول", registerTab: "إنشاء حساب",
                nameLabel: "الاسم الكامل", phoneLabel: "رقم الهاتف", ageLabel: "العمر", emailLabel: "البريد الإلكتروني",
                passwordLabel: "كلمة المرور", confirmLabel: "تأكيد كلمة المرور", submitBtn: "إنشاء حساب",
                namePH: "محمد أحمد", phonePH: "+20...", agePH: "٢٥", emailPH: "name@example.com"
            }
        };

        const applyLang = (lang) => {
            const t = translations[lang];
            if(!t) return;
            document.getElementById('left-title').innerHTML = t.leftTitle;
            document.getElementById('left-desc').innerText = t.leftDesc;
            document.getElementById('feat-text-1').innerText = t.feat1;
            document.getElementById('feat-text-2').innerText = t.feat2;
            document.getElementById('feat-text-3').innerText = t.feat3;
            document.getElementById('active-users').innerText = t.activeUsers;
            document.getElementById('login-tab').innerText = t.loginTab;
            document.getElementById('register-tab').innerText = t.registerTab;
            document.getElementById('name-label').innerText = t.nameLabel;
            document.getElementById('phone-label').innerText = t.phoneLabel;
            document.getElementById('age-label').innerText = t.ageLabel;
            document.getElementById('email-label').innerText = t.emailLabel;
            document.getElementById('password-label').innerText = t.passwordLabel;
            document.getElementById('confirm-label').innerText = t.confirmLabel;
            document.getElementById('submit-btn').innerText = t.submitBtn;
            document.getElementById('name-input').placeholder = t.namePH;
            document.getElementById('phone-input').placeholder = t.phonePH;
            document.getElementById('age-input').placeholder = t.agePH;
            document.getElementById('email-input').placeholder = t.emailPH;
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            if (passInput.value) updateStrength(); // re-run strength & match
        };

        let savedLang = localStorage.getItem('siteLang') || 'en';
        applyLang(savedLang);
        window.addEventListener('storage', (e) => { if(e.key === 'siteLang') applyLang(e.newValue || 'en'); });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>MediCare - Login</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

    {{-- استعادة اللغة فوراً من localStorage --}}
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
        /* ═══════════════════════════════════════
           RESET & BASE - RESPONSIVE READY
        ═══════════════════════════════════════ */
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

        /* خلفية ثابتة */
        .bg-particles,
        .bg-texture,
        .bg-glow {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }
        .bg-particles { z-index: 1; }
        .bg-texture   { z-index: 2; }
        .bg-glow      { z-index: 3; }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(201, 162, 77, 0.18);
            animation: float-particle linear infinite;
        }

        @keyframes float-particle {
            0%   { transform: translateY(100vh) scale(0);   opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 0.6; }
            100% { transform: translateY(-10vh) scale(1.2); opacity: 0; }
        }

        .bg-texture {
            background-image: radial-gradient(circle, rgba(201,162,77,0.07) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        .bg-glow {
            background:
                radial-gradient(ellipse 55% 55% at 28% 48%, rgba(201,162,77,0.07) 0%, transparent 70%),
                radial-gradient(ellipse 50% 60% at 72% 60%, rgba(31,42,68,0.35) 0%, transparent 70%);
        }

        /* ═══════════════════════════════════════
           MAIN CARD - FULLY RESPONSIVE
        ═══════════════════════════════════════ */
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

        /* decorative orbits */
        .mc-left::before,
        .mc-left::after {
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

        /* Stats */
        .mc-stats {
            display: flex;
            gap: 14px;
            margin-top: 28px;
            animation: fade-up 0.7s 0.55s both;
        }
        .mc-stat {
            flex: 1;
            border: 0.5px solid rgba(201, 162, 77, 0.3);
            border-radius: 18px;
            padding: 14px 12px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(8px);
            transition: all 0.3s;
        }
        .stat-num {
            font-size: 22px;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
        }
        .stat-label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.55);
            margin-top: 6px;
            letter-spacing: 0.4px;
        }

        /* Avatars */
        .mc-avatars {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
            animation: fade-up 0.7s 0.68s both;
        }
        .avatar-stack { display: flex; }
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2.5px solid #1F2A44;
            margin-left: -12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .avatar:first-child { margin-left: 0; }
        .avatar-text {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }
        .pulse-dot {
            position: absolute;
            bottom: 32px;
            right: 30px;
            width: 8px;
            height: 8px;
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

        /* RIGHT PANEL */
        .mc-right {
            flex: 1;
            background: var(--white);
            padding: 46px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
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
            margin-bottom: 32px;
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

        /* Form */
        .form-group { margin-bottom: 24px; animation: fade-up 0.6s both; }
        .form-group:nth-child(1) { animation-delay: 0.52s; }
        .form-group:nth-child(2) { animation-delay: 0.62s; }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: var(--navy);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 16px;
            transition: all 0.2s;
            pointer-events: none;
        }
        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 1.5px solid var(--gray-200);
            border-radius: 18px;
            font-size: 15px;
            font-family: 'DM Sans', sans-serif;
            color: var(--navy);
            background: var(--gray-50);
            outline: none;
            transition: 0.2s;
        }
        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201, 162, 77, 0.15);
            background: white;
            transform: translateY(-1px);
        }
        .form-control:focus + .input-icon {
            color: var(--gold);
            transform: translateY(-50%) scale(1.1);
        }
        [dir="rtl"] .input-icon { left: auto; right: 16px; }
        [dir="rtl"] .form-control { padding: 14px 48px 14px 16px; }

        .field-error {
            font-size: 12px;
            color: #dc2626;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
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
            transition: all 0.2s;
            margin-top: 8px;
            position: relative;
            overflow: hidden;
            animation: fade-up 0.6s 0.74s both;
            min-height: 52px;
            touch-action: manipulation;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            box-shadow: 0 12px 28px rgba(201, 162, 77, 0.5);
        }
        .btn-submit:active { transform: translateY(1px); }
        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0; left: -120%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 3s infinite 1s;
        }
        @keyframes shimmer { to { left: 160%; } }

        .mc-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 28px 0 24px;
            animation: fade-in 0.6s 0.86s both;
        }
        .divider-line { flex: 1; height: 1px; background: var(--gray-200); }
        .divider-text { font-size: 12px; color: var(--gray-400); white-space: nowrap; }

        .btn-google {
            width: 100%;
            padding: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: 1.5px solid var(--gray-200);
            border-radius: 18px;
            font-size: 15px;
            font-weight: 600;
            color: var(--navy);
            background: white;
            cursor: pointer;
            transition: all 0.25s;
            animation: fade-up 0.6s 0.92s both;
            text-decoration: none;
            min-height: 52px;
            touch-action: manipulation;
        }
        .btn-google:hover {
            border-color: var(--gold);
            background: var(--gray-50);
            transform: translateY(-1px);
        }

        /* Animations */
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            width: 0; height: 0;
            transform: translate(-50%, -50%);
            animation: ripple-expand 0.6s ease-out forwards;
            pointer-events: none;
        }
        @keyframes ripple-expand {
            to { width: 300px; height: 300px; opacity: 0; }
        }

        /* ═══════════════════════════════════════
           RESPONSIVE BREAKPOINTS
        ═══════════════════════════════════════ */
        @media (max-width: 900px) {
            .mc-left { padding: 32px 28px; width: 45%; }
            .mc-right { padding: 36px 32px; }
            .brand { font-size: 20px; }
            .nav-logo-img { width: 60px; height: 60px; }
        }

        @media (max-width: 768px) {
              .nav-logo-img {
            width:60px !important;
            height: 60px !important;
            object-fit: contain;
            transition: transform 0.2s;
        }
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
                padding: 32px 24px;
                border-radius: 0 0 28px 28px;
            }
            .mc-stats { gap: 12px; margin-top: 20px; }
            .mc-stat { padding: 12px 10px; }
            .stat-num { font-size: 20px; }
            .avatar { width: 34px; height: 34px; }
            .mc-headline { margin-top: 20px; font-size: 26px; }
            .mc-desc { font-size: 13px; }
            .mc-tabs { gap: 20px; margin-bottom: 24px; }
            .form-control { padding: 13px 16px 13px 44px; font-size: 14px; }
            .btn-submit, .btn-google { min-height: 48px; padding: 12px; }
        }

        @media (max-width: 480px) {
            .mc-left, .mc-right { padding: 20px 18px; }
            .brand { font-size: 18px; }
            .nav-logo-img { width: 38px; height: 38px; }
            .logo-text .tagline { font-size: 7px; letter-spacing: 1.5px; }
            .mc-headline { font-size: 22px; }
            .mc-stats { gap: 8px; }
            .stat-num { font-size: 18px; }
            .stat-label { font-size: 9px; }
            .avatar-text { font-size: 10px; }
            .mc-tab { font-size: 14px; padding-bottom: 10px; }
            .form-label { font-size: 10px; }
            .btn-submit, .btn-google { font-size: 14px; }
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
                <h2 class="mc-headline" id="left-title">Precision Care,<br><em>Personal Touch.</em></h2>
                <p class="mc-desc" id="left-desc">Your all-in-one portal to manage appointments, records, and your health journey.</p>
                <div class="mc-stats">
                    <div class="mc-stat">
                        <div class="stat-num" id="counter1">0</div>
                        <div class="stat-label" id="stat-label-1">Active patients</div>
                    </div>
                    <div class="mc-stat">
                        <div class="stat-num" id="counter2">0</div>
                        <div class="stat-label" id="stat-label-2">Doctors online</div>
                    </div>
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
                <a href="{{ route('login') }}" class="mc-tab active" id="login-tab">Log In</a>
                <a href="{{ route('register') }}" class="mc-tab" id="register-tab">Sign Up</a>
            </div>
            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf
                <div class="form-group">
                    <label class="form-label" id="email-label">Email Address</label>
                    <div class="input-wrap">
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com" class="form-control" id="email-input">
                        <i class="fa-regular fa-envelope input-icon"></i>
                    </div>
                    @error('email') <p class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" id="password-label">Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" required placeholder="••••••••" class="form-control" id="password-input">
                        <i class="fa-solid fa-lock input-icon"></i>
                    </div>
                    @error('password') <p class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn-submit" id="submit-btn">Access Portal</button>
            </form>
            <div class="mc-divider">
                <div class="divider-line"></div>
                <span class="divider-text" id="divider-text">or continue with</span>
                <div class="divider-line"></div>
            </div>
            <a href="{{ url('auth/google') }}" class="btn-google" id="google-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                <span id="google-text">Continue with Google</span>
            </a>
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

        // Counters
        function animateCount(el, target, suffix, duration, delay) {
            setTimeout(() => {
                let start = Date.now();
                let step = () => {
                    let elapsed = Date.now() - start;
                    let prog = Math.min(elapsed/duration,1);
                    let val = Math.round(prog * target);
                    el.textContent = val + suffix;
                    if(prog<1) requestAnimationFrame(step);
                };
                step();
            }, delay);
        }
        animateCount(document.getElementById('counter1'), 10, 'k+', 1600, 900);
        animateCount(document.getElementById('counter2'), 320, '', 1600, 1100);

        // Ripple
        document.getElementById('submit-btn').addEventListener('click', function(e) {
            let rect = this.getBoundingClientRect();
            let ripple = document.createElement('span');
            ripple.className = 'ripple';
            ripple.style.left = (e.clientX - rect.left) + 'px';
            ripple.style.top = (e.clientY - rect.top) + 'px';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
            let btn = this;
            let orig = btn.innerText;
            btn.innerText = '⏳ Authenticating…';
            btn.style.opacity = '0.8';
            setTimeout(() => { btn.innerText = orig; btn.style.opacity = ''; }, 2000);
        });

        // Tabs visual
        document.querySelectorAll('.mc-tab').forEach(t => t.addEventListener('click', function() {
            document.querySelectorAll('.mc-tab').forEach(tab => tab.classList.remove('active'));
            this.classList.add('active');
        }));

        // Input focus icons
        document.querySelectorAll('.form-control').forEach(inp => {
            let icon = inp.parentElement?.querySelector('.input-icon');
            inp.addEventListener('focus', () => { if(icon) { icon.style.color = 'var(--gold)'; icon.style.transform = 'translateY(-50%) scale(1.1)'; } });
            inp.addEventListener('blur', () => { if(icon) { icon.style.color = ''; icon.style.transform = ''; } });
        });

        // Translations
        const translations = {
            en: { leftTitle:"Precision Care,<br><em>Personal Touch.</em>", leftDesc:"Your all-in-one portal to manage appointments, records, and your health journey.", statLabel1:"Active patients", statLabel2:"Doctors online", activeUsers:"+10k active users", loginTab:"Log In", registerTab:"Sign Up", emailLabel:"Email Address", passwordLabel:"Password", submitBtn:"Access Portal", dividerText:"or continue with", googleText:"Continue with Google", emailPlaceholder:"name@example.com", passwordPlaceholder:"••••••••" },
            ar: { leftTitle:"رعاية دقيقة،<br><em>لمسة شخصية.</em>", leftDesc:"بوابتك الشاملة لإدارة المواعيد والسجلات ورحلتك الصحية.", statLabel1:"مريض نشط", statLabel2:"طبيب متاح", activeUsers:"+١٠ آلاف مستخدم نشط", loginTab:"تسجيل الدخول", registerTab:"إنشاء حساب", emailLabel:"البريد الإلكتروني", passwordLabel:"كلمة المرور", submitBtn:"الدخول إلى البوابة", dividerText:"أو تابع بواسطة", googleText:"المتابعة بواسطة Google", emailPlaceholder:"البريد@example.com", passwordPlaceholder:"••••••••" }
        };
        function applyLang(lang) {
            let t = translations[lang];
            if(!t) return;
            document.getElementById('left-title').innerHTML = t.leftTitle;
            document.getElementById('left-desc').innerText = t.leftDesc;
            document.getElementById('stat-label-1').innerText = t.statLabel1;
            document.getElementById('stat-label-2').innerText = t.statLabel2;
            document.getElementById('active-users').innerText = t.activeUsers;
            document.getElementById('login-tab').innerText = t.loginTab;
            document.getElementById('register-tab').innerText = t.registerTab;
            document.getElementById('email-label').innerText = t.emailLabel;
            document.getElementById('password-label').innerText = t.passwordLabel;
            document.getElementById('submit-btn').innerText = t.submitBtn;
            document.getElementById('divider-text').innerText = t.dividerText;
            document.getElementById('google-text').innerText = t.googleText;
            document.getElementById('email-input').placeholder = t.emailPlaceholder;
            document.getElementById('password-input').placeholder = t.passwordPlaceholder;
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
        }
        let saved = localStorage.getItem('siteLang') || 'en';
        applyLang(saved);
        window.addEventListener('storage', (e) => { if(e.key === 'siteLang') applyLang(e.newValue || 'en'); });
    </script>
</body>
</html>
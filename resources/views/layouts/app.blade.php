{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'MediCare')</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        /* ========== CSS Variables ========== */
        :root {
            --gold:        #C9A24D;
            --gold-light:  #e8c97a;
            --gold-faint:  rgba(201,162,77,0.12);
            --navy:        #1F2A44;
            --navy-dark:   #0f172a;
            --white:       #ffffff;
            --gray-light:  #f4f7f9;
            --gray-mid:    #6b7a8d;
            --border:      rgba(201,162,77,0.25);
            --transition:  0.3s cubic-bezier(0.2,0.9,0.4,1.1);
            --nav-height:  70px;
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #fcfcfc;
            color: var(--navy);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ================================
           MAIN CONTENT OFFSET (avoid fixed navbar)
        ================================ */
        .page-content {
            min-height: 100vh;
            padding-top: var(--nav-height);
        }

        /* ================================
           NAVBAR - WITH LOAD ANIMATION
        ================================ */
        @keyframes navbarSlideDown {
            0% {
                opacity: 0;
                transform: translateY(-100%);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: transparent;
            transition: background 0.4s ease, box-shadow 0.4s ease, padding 0.4s ease;
            padding: 18px 0;
            animation: navbarSlideDown 0.55s cubic-bezier(0.15, 0.85, 0.35, 1) forwards;
        }

        .navbar.scrolled {
            background: var(--navy-dark);
            box-shadow: 0 8px 28px rgba(0,0,0,0.25);
            padding: 12px 0;
            backdrop-filter: blur(2px);
        }

        .nav-inner {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .nav-logo {
            display: flex;
            align-items: center;
          
            text-decoration: none;
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }
        .nav-logo-img {
            width: 58px;
            height: 58px;
            object-fit: contain;
            transition: transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .nav-logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        .nav-logo-text .brand {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 0.5px;
            transition: color 0.2s ease;
        }
        .nav-logo-text .tagline {
            font-size: 9px;
            color: var(--gold);
            letter-spacing: 2px;
            font-weight: 600;
            text-transform: uppercase;
            transition: transform 0.2s ease;
        }
        .nav-logo:hover {
            transform: scale(1.02);
        }
        .nav-logo:hover .nav-logo-img {
            transform: scale(1.07) rotate(-2deg);
        }
        .nav-logo:hover .nav-logo-text .brand {
            color: var(--gold);
            text-shadow: 0 0 6px rgba(201,162,77,0.3);
        }
        .nav-logo:hover .nav-logo-text .tagline {
            transform: translateX(3px);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 8px;
            transition: all 0.25s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 4px; left: 50%;
            width: 0; height: 2px;
            background: var(--gold);
            border-radius: 2px;
            transform: translateX(-50%);
            transition: width 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--white);
            background: var(--gold-faint);
            transform: translateY(-1px);
        }

        .nav-links a:hover::after,
        .nav-links a.active::after { width: 70%; }

        .nav-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .lang-btn {
            background: transparent;
            color: var(--gold);
            border: 1px solid var(--gold);
            padding: 7px 16px;
            border-radius: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            min-width: 105px;
            justify-content: center;
            transition: all 0.25s cubic-bezier(0.18, 0.89, 0.32, 1.28);
            font-family: 'Inter', sans-serif;
        }

        .lang-btn:hover {
            background: var(--gold);
            color: var(--white);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(201,162,77,0.35);
            border-color: var(--gold-light);
        }

        .lang-btn:active { transform: scale(0.97); transition: 0.05s; }

        .btn-cta {
            background: var(--gold);
            color: var(--white);
            border: none;
            padding: 9px 22px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.3s cubic-bezier(0.18, 0.89, 0.32, 1.2);
            white-space: nowrap;
        }

        .btn-cta:hover {
            background: var(--gold-light);
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(201,162,77,0.45);
        }


        

        .btn-cta:active { transform: translateY(2px); transition: 0.05s; }

        /* ========== MOBILE MENU ========== */
        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 6px;
            background: none;
            border: none;
            z-index: 1100;
        }

        .menu-toggle span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--white);
            border-radius: 2px;
            transition: transform 0.35s ease, opacity 0.25s ease;
        }

        .menu-toggle.is-active span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .menu-toggle.is-active span:nth-child(2) { opacity: 0; transform: scaleX(0.8); }
        .menu-toggle.is-active span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        .nav-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            pointer-events: none;
        }

        .nav-backdrop.visible {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        /* ================================
           FOOTER
        ================================ */
        .site-footer {
            background: var(--navy-dark);
            color: rgba(255,255,255,0.75);
            padding: 70px 0 0;
            position: relative;
            overflow: hidden;
        }

        .site-footer::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent 0%, var(--gold) 30%, var(--gold-light) 50%, var(--gold) 70%, transparent 100%);
        }

        .site-footer::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 80% 20%, rgba(201,162,77,0.04) 0%, transparent 50%),
                              radial-gradient(circle at 10% 80%, rgba(201,162,77,0.03) 0%, transparent 40%);
            pointer-events: none;
        }

        .footer-inner {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }

        .footer-grid > *,
        .footer-emergency,
        .social-links,
        .footer-bottom {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1), transform 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .site-footer.footer-visible .footer-grid > *,
        .site-footer.footer-visible .footer-emergency,
        .site-footer.footer-visible .social-links,
        .site-footer.footer-visible .footer-bottom {
            opacity: 1;
            transform: translateY(0);
        }

        .site-footer.footer-visible .footer-grid > :nth-child(1) { transition-delay: 0.05s; }
        .site-footer.footer-visible .footer-grid > :nth-child(2) { transition-delay: 0.1s; }
        .site-footer.footer-visible .footer-grid > :nth-child(3) { transition-delay: 0.15s; }
        .site-footer.footer-visible .footer-grid > :nth-child(4) { transition-delay: 0.2s; }
        .site-footer.footer-visible .footer-emergency { transition-delay: 0.1s; }
        .site-footer.footer-visible .social-links { transition-delay: 0.15s; }
        .site-footer.footer-visible .footer-bottom { transition-delay: 0.25s; }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1.2fr;
            gap: 48px;
            padding-bottom: 56px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 18px;
            transition: transform 0.2s ease;
        }
        .footer-logo:hover { transform: translateX(5px); }
        .footer-logo-icon {
            width: 42px; height: 42px;
            background: var(--gold);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            color: var(--white);
            transition: all 0.25s ease;
        }
        .footer-logo:hover .footer-logo-icon {
            background: var(--gold-light);
            transform: scale(1.05);
        }
        .footer-logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }
        .footer-logo-text .brand {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--white);
        }
        .footer-logo-text .tagline {
            font-size: 9px;
            color: var(--gold);
            letter-spacing: 2px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .footer-brand p {
            font-size: 13.5px;
            line-height: 1.75;
            max-width: 280px;
            margin-bottom: 24px;
            color: rgba(255,255,255,0.6);
        }
        .social-links {
            display: flex;
            gap: 10px;
        }
        .social-link {
            width: 38px; height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(201,162,77,0.35);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold);
            font-size: 15px;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .social-link:hover {
            background: var(--gold);
            color: var(--white);
            border-color: var(--gold);
            transform: translateY(-4px) scale(1.08);
            box-shadow: 0 8px 18px rgba(201,162,77,0.3);
        }
        .footer-col h4 {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 20px;
            transition: letter-spacing 0.2s;
        }
        .footer-col:hover h4 { letter-spacing: 2.5px; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-col ul li a {
            text-decoration: none;
            color: rgba(255,255,255,0.6);
            font-size: 13.5px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .footer-col ul li a i { font-size: 11px; color: var(--gold); opacity: 0.7; transition: transform 0.2s; }
        .footer-col ul li a:hover {
            color: var(--white);
            padding-left: 6px;
        }
        .footer-col ul li a:hover i { transform: translateX(4px); opacity: 1; }
        .footer-contact-list { display: flex; flex-direction: column; gap: 14px; }
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: transform 0.2s ease;
        }
        .contact-item:hover { transform: translateX(5px); }
        .contact-icon {
            width: 34px; height: 34px;
            background: var(--gold-faint);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold);
            font-size: 13px;
            flex-shrink: 0;
            margin-top: 2px;
            transition: background 0.2s, transform 0.2s;
        }
        .contact-item:hover .contact-icon {
            background: var(--gold);
            color: var(--white);
            transform: scale(1.05);
        }
        .contact-item p {
            font-size: 13px;
            line-height: 1.5;
            color: rgba(255,255,255,0.6);
        }
        .contact-item p strong {
            display: block;
            color: var(--white);
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 0;
            gap: 16px;
            flex-wrap: wrap;
        }
        .footer-bottom p {
            font-size: 12.5px;
            color: rgba(255,255,255,0.4);
        }
        .footer-bottom p span { color: var(--gold); transition: color 0.2s; }
        .footer-bottom-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }
        .footer-bottom-links a {
            font-size: 12.5px;
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .footer-bottom-links a:hover { color: var(--gold); transform: translateY(-2px); }
        .footer-emergency {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(201,162,77,0.1);
            border: 1px solid rgba(201,162,77,0.25);
            padding: 10px 18px;
            border-radius: 30px;
            margin-bottom: 24px;
            transition: all 0.25s;
        }
        .footer-emergency:hover {
            background: rgba(201,162,77,0.2);
            border-color: var(--gold);
            transform: scale(1.02);
        }
        .footer-emergency i { color: var(--gold); font-size: 14px; transition: transform 0.2s; }
        .footer-emergency:hover i { transform: rotate(8deg); }
        .footer-emergency span { font-size: 13px; color: rgba(255,255,255,0.75); }
        .footer-emergency strong { color: var(--gold); font-weight: 700; }

        /* ================================
           RESPONSIVE
        ================================ */
        @media (max-width: 1024px) {
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 36px; }
            .footer-brand { grid-column: 1 / -1; }
        }

        @media (max-width: 768px) {
            :root { --nav-height: 60px; }
            .navbar { padding: 12px 0; }
            .page-content { padding-top: var(--nav-height); }
            .nav-inner {
                max-width: 1140px;
                margin: 0 auto;
                padding: 0 24px;
                display: flex;
                align-items: center;
                justify-content: normal;
                gap: 30px;
            }

            /* =============================================
               FIX: الـ navbar يبقى ظاهر دايماً على الموبايل
            ============================================= */
            .navbar {
                position: fixed !important;
                top: 0 !important;
                left: 0;
                width: 100% !important;
                z-index: 9999 !important;
                background: var(--navy-dark) !important;
                box-shadow: 0 4px 20px rgba(0,0,0,0.3) !important;
            }

            .nav-logo-img {
                width: 60px !important;
                height: 60px !important;
                max-width: 100%;
                object-fit: contain;
            }
            .nav-logo-text .brand { font-size:20px !important; }
            .nav-logo-text .tagline { display: none; }
            
            .nav-links {
                position: fixed;
                top: 0;
                right: 0;
                width: 85%;
                max-width: 320px;
                height: 100dvh;
                background: var(--navy-dark);
                flex-direction: column;
                justify-content: flex-start;
                gap: 8px;
                z-index: 1050;
                box-shadow: -8px 0 30px rgba(0,0,0,0.5);
                padding: 80px 24px 40px;
                overflow-y: auto;
                transform: translateX(100%);
                transition: transform 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1), visibility 0.2s;
                visibility: hidden;
                pointer-events: none;
            }
            .nav-links.active {
                transform: translateX(0);
                visibility: visible;
                pointer-events: auto;
            }
            html[dir="rtl"] .nav-links {
                right: auto;
                left: 0;
                transform: translateX(-100%);
                box-shadow: 8px 0 30px rgba(0,0,0,0.5);
            }
            html[dir="rtl"] .nav-links.active {
                transform: translateX(0);
            }
            .nav-links.active a {
                color: rgba(255,255,255,0.9);
                font-size: 1.1rem;
                padding: 14px 20px;
                width: 100%;
                text-align: center;
                border-radius: 12px;
                justify-content: center;
                gap: 12px;
            }
            .nav-links.active a:hover,
            .nav-links.active a.active {
                background: rgba(201,162,77,0.2);
                color: var(--gold);
                transform: translateX(5px);
            }
            .mobile-appointment {
                margin-top: 24px;
                border-top: 1px solid rgba(255,255,255,0.15);
                padding-top: 24px;
                
            }
            .btn-cta-mobile {
                background: var(--gold);
                color: var(--white) !important;
                border-radius: 40px !important;
                font-weight: 700;
                transition: all 0.25s;
            }
            .btn-cta-mobile:hover {
                background: var(--gold-light);
                transform: scale(1.02);
            }
            .nav-controls .btn-cta {
                display: none;
            }
            .menu-toggle {
                display: flex;
            }
            .footer-grid { grid-template-columns: 1fr; gap: 40px; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .footer-bottom-links { justify-content: center; }
        }

        @media (min-width: 769px) {
            .mobile-appointment { display: none; }
        }

        @media (max-width: 480px) {
            :root { --nav-height: 55px; }
            .nav-logo-img { width: 40px; height: 40px; }
            .nav-logo-text .brand { font-size: 24px !important; }
            .lang-btn span { display: inline; }
            .lang-btn { min-width: unset; padding: 6px 12px; font-size: 12px; }
            .btn-cta { padding: 6px 14px; font-size: 12px; }
            .nav-inner { padding: 0 16px; }
            .footer-bottom-links { gap: 12px; flex-wrap: wrap; }
            .footer-logo-icon { width: 36px; height: 36px; font-size: 16px; }
            .footer-logo-text .brand { font-size: 18px; }
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- FIX: Immediately restore language from localStorage before any content renders --}}
    <script>
        (function() {
            try {
                const savedLang = localStorage.getItem('siteLang');
                if (savedLang === 'ar') {
                    document.documentElement.lang = 'ar';
                    document.documentElement.dir = 'rtl';
                } else if (savedLang === 'en') {
                    document.documentElement.lang = 'en';
                    document.documentElement.dir = 'ltr';
                } else {
                    document.documentElement.lang = 'en';
                    document.documentElement.dir = 'ltr';
                }
            } catch(e) { /* ignore */ }
        })();
    </script>

    {{-- ==================== NAVBAR ==================== --}}
    <nav class="navbar" id="mainNav">
        <div class="nav-inner">
            <a href="{{ url('') }}" class="nav-logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="MediCare Logo" class="nav-logo-img">
                <div class="nav-logo-text">
                    <span class="brand">MediCare</span>
                    <span class="tagline">Healthcare Excellence</span>
                </div>
            </a>

            <div class="nav-backdrop" id="navBackdrop"></div>

            <ul class="nav-links" id="navLinks">
                <li><a href="{{ url('/') }}" id="navHome" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/about') }}" id="navAbout" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ url('/servicess') }}" id="navServices" class="{{ request()->is('servicess') ? 'active' : '' }}">Services</a></li>
                <li>
                    <a href="{{ url('/doctorss') }}"
                       id="navDoctors"
                       class="{{ request()->is('doctorss') || request()->is('doctorss/*') ? 'active' : '' }}">
                        Doctors
                    </a>
                </li>
                <li><a href="{{ url('/contact') }}" id="navContact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
                <li class="mobile-appointment">
                    <a href="{{ url('/doctors') }}" id="navMobileBooking" class="btn-cta-mobile">
                        <i class="fas fa-calendar-check"></i> Book Appointment
                    </a>
                </li>
            </ul>

            <div class="nav-controls">
                <button class="lang-btn" id="langToggle" onclick="toggleLanguage()" title="Switch Language">
                    <i class="fas fa-globe"></i>
                    <span id="langLabel">العربية</span>
                </button>
                <a href="{{ url('/doctors') }}" id="navBooking" class="btn-cta">
                    <i class="fas fa-calendar-check"></i>
                    Book Appointment
                </a>
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    {{-- ==================== PAGE CONTENT ==================== --}}
    <main class="page-content">
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="site-footer" id="mainFooter">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-brand">
                            <a href="{{ url('') }}" class="nav-logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="MediCare Logo" class="nav-logo-img">
                <div class="nav-logo-text">
                    <span class="brand">MediCare</span>
                    <span class="tagline">Healthcare Excellence</span>
                </div>
            </a>
                    <p id="footerBrandDesc">Dedicated to providing exceptional healthcare services with compassion, innovation, and a patient-first approach. Serving our community since 2008.</p>
                    <div class="footer-emergency">
                        <i class="fas fa-phone-alt"></i>
                        <span id="footerEmergencyText">24/7 Emergency:</span> <strong id="footerEmergencyNumber">+1 (800) 555-0199</strong>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4 id="footerColQuickTitle">Quick Links</h4>
                    <ul id="footerQuickLinks">
                        <li><a href="{{ url('/') }}"><i class="fas fa-chevron-right"></i> <span class="link-text">Home</span></a></li>
                        <li><a href="{{ url('/about') }}"><i class="fas fa-chevron-right"></i> <span class="link-text">About Us</span></a></li>
                        <li><a href="{{ url('/services') }}"><i class="fas fa-chevron-right"></i> <span class="link-text">Services</span></a></li>
                        <li><a href="{{ url('/doctors') }}"><i class="fas fa-chevron-right"></i> <span class="link-text">Our Doctors</span></a></li>
                        <li><a href="{{ url('/appointment') }}"><i class="fas fa-chevron-right"></i> <span class="link-text">Book Appointment</span></a></li>
                        <li><a href="{{ url('/contact') }}"><i class="fas fa-chevron-right"></i> <span class="link-text">Contact Us</span></a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 id="footerColSpecialtiesTitle">Specialties</h4>
                    <ul id="footerSpecialtiesLinks">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> <span class="link-text">Cardiology</span></a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> <span class="link-text">Neurology</span></a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> <span class="link-text">Pediatrics</span></a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> <span class="link-text">Surgery</span></a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> <span class="link-text">Oncology</span></a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> <span class="link-text">Emergency Care</span></a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 id="footerColContactTitle">Contact</h4>
                    <div class="footer-contact-list" id="footerContactDetails">
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <p><strong id="contactAddressLabel">Address</strong><span id="contactAddressValue">123 Healthcare Blvd, Medical District, NY 10001</span></p>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <p><strong id="contactPhoneLabel">Main Line</strong><span id="contactPhoneValue">+1 (800) 555-0100</span></p>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <p><strong id="contactEmailLabel">Email</strong><span id="contactEmailValue">info@medicare-hospital.com</span></p>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-clock"></i></div>
                            <p><strong id="contactHoursLabel">Working Hours</strong><span id="contactHoursValue">Mon – Sat: 8:00 AM – 9:00 PM</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p id="footerCopyright">&copy; {{ date('Y') }} <span>MediCare</span>. All rights reserved. Designed with <span>♥</span> for better healthcare.</p>
                <ul class="footer-bottom-links" id="footerBottomLinks">
                    <li><a href="{{ url('/privacy') }}" id="footerPrivacyLink">Privacy Policy</a></li>
                    <li><a href="{{ url('/terms') }}" id="footerTermsLink">Terms of Service</a></li>
                    <li><a href="{{ url('/sitemap') }}" id="footerSitemapLink">Sitemap</a></li>
                </ul>
            </div>
        </div>
    </footer>

    {{-- ==================== SCRIPTS ==================== --}}
    <script>
        // =============================================
        // FIX: Navbar ثابت على الموبايل - لا يختفي أبداً
        // =============================================
        const navbar = document.getElementById('mainNav');

        function updateNavbar() {
            if (window.innerWidth <= 768) {
                // على الموبايل: الـ navbar يبقى ظاهر دايماً بـ background داكن
                navbar.classList.add('scrolled');
            } else {
                // على الـ Desktop: شفاف في الأول ويتلوّن بعد الـ scroll
                navbar.classList.toggle('scrolled', window.scrollY > 50);
            }
        }

        // تشغيل فوراً عند تحميل الصفحة
        updateNavbar();

        // تحديث عند الـ scroll
        window.addEventListener('scroll', updateNavbar, { passive: true });

        // تحديث عند تغيير حجم الشاشة (مثلاً تحويل الموبايل أفقياً)
        window.addEventListener('resize', updateNavbar, { passive: true });

        // Mobile menu: smooth slide + backdrop transition
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        const navBackdrop = document.getElementById('navBackdrop');

        function closeMenu() {
            navLinks.classList.remove('active');
            menuToggle.classList.remove('is-active');
            navBackdrop.classList.remove('visible');
            document.body.style.overflow = '';
        }

        function openMenu() {
            navLinks.classList.add('active');
            menuToggle.classList.add('is-active');
            navBackdrop.classList.add('visible');
            document.body.style.overflow = 'hidden';
        }

        menuToggle.addEventListener('click', () => {
            if (navLinks.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        navBackdrop.addEventListener('click', closeMenu);

        // Footer Intersection Observer: smooth fade-in when footer enters viewport
        const footer = document.getElementById('mainFooter');
        if (footer) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        footer.classList.add('footer-visible');
                        observer.unobserve(footer);
                    }
                });
            }, { threshold: 0.1, rootMargin: "0px 0px -20px 0px" });
            observer.observe(footer);
            if (footer.getBoundingClientRect().top < window.innerHeight) {
                footer.classList.add('footer-visible');
                observer.unobserve(footer);
            }
        }

        // ==================== LANGUAGE PERSISTENCE + FULL TRANSLATION ====================
        let currentLang = localStorage.getItem('siteLang') || 'en';

        // Navigation translations
        const navTranslations = {
            en: {
                home: "Home",
                about: "About Us",
                services: "Services",
                doctors: "Doctors",
                contact: "Contact",
                booking: "Book Appointment",
                mobileBooking: "Book Appointment"
            },
            ar: {
                home: "الرئيسية",
                about: "من نحن",
                services: "خدماتنا",
                doctors: "الأطباء",
                contact: "اتصل بنا",
                booking: "حجز موعد",
                mobileBooking: "حجز موعد"
            }
        };

        // Footer translations
        const footerTranslations = {
            en: {
                brandDesc: "Dedicated to providing exceptional healthcare services with compassion, innovation, and a patient-first approach. Serving our community since 2008.",
                emergencyText: "24/7 Emergency:",
                quickTitle: "Quick Links",
                specialtiesTitle: "Specialties",
                contactTitle: "Contact",
                quickLinks: ["Home", "About Us", "Services", "Our Doctors", "Book Appointment", "Contact Us"],
                specialtiesLinks: ["Cardiology", "Neurology", "Pediatrics", "Surgery", "Oncology", "Emergency Care"],
                contactAddressLabel: "Address", contactAddressValue: "123 Healthcare Blvd, Medical District, NY 10001",
                contactPhoneLabel: "Main Line", contactPhoneValue: "+1 (800) 555-0100",
                contactEmailLabel: "Email", contactEmailValue: "info@medicare-hospital.com",
                contactHoursLabel: "Working Hours", contactHoursValue: "Mon – Sat: 8:00 AM – 9:00 PM",
                copyright: "All rights reserved. Designed with ♥ for better healthcare.",
                privacyLink: "Privacy Policy",
                termsLink: "Terms of Service",
                sitemapLink: "Sitemap"
            },
            ar: {
                brandDesc: "ملتزمون بتقديم خدمات رعاية صحية استثنائية برحمة وابتكار ونهج يركز على المريض أولاً. نخدم مجتمعنا منذ عام ٢٠٠٨.",
                emergencyText: "طوارئ على مدار الساعة:",
                quickTitle: "روابط سريعة",
                specialtiesTitle: "التخصصات",
                contactTitle: "اتصل بنا",
                quickLinks: ["الرئيسية", "من نحن", "الخدمات", "أطباؤنا", "حجز موعد", "اتصل بنا"],
                specialtiesLinks: ["أمراض القلب", "طب الأعصاب", "طب الأطفال", "الجراحة", "الأورام", "رعاية الطوارئ"],
                contactAddressLabel: "العنوان", contactAddressValue: "١٢٣ شارع المركز الطبي، الحي الطبي، نيويورك ١٠٠٠١",
                contactPhoneLabel: "الخط الرئيسي", contactPhoneValue: "+1 (800) 555-0100",
                contactEmailLabel: "البريد الإلكتروني", contactEmailValue: "info@medicare-hospital.com",
                contactHoursLabel: "ساعات العمل", contactHoursValue: "الاثنين – السبت: ٨ ص – ٩ م",
                copyright: "جميع الحقوق محفوظة. صمم بـ ♥ من أجل رعاية صحية أفضل.",
                privacyLink: "سياسة الخصوصية",
                termsLink: "شروط الخدمة",
                sitemapLink: "خريطة الموقع"
            }
        };

        function applyNavTranslation(lang) {
            const t = navTranslations[lang];
            if (!t) return;
            const homeLink = document.getElementById('navHome');
            const aboutLink = document.getElementById('navAbout');
            const servicesLink = document.getElementById('navServices');
            const doctorsLink = document.getElementById('navDoctors');
            const contactLink = document.getElementById('navContact');
            const bookingBtn = document.getElementById('navBooking');
            const mobileBookingBtn = document.getElementById('navMobileBooking');
            if (homeLink) homeLink.innerText = t.home;
            if (aboutLink) aboutLink.innerText = t.about;
            if (servicesLink) servicesLink.innerText = t.services;
            if (doctorsLink) doctorsLink.innerText = t.doctors;
            if (contactLink) contactLink.innerText = t.contact;
            if (bookingBtn) bookingBtn.innerHTML = `<i class="fas fa-calendar-check"></i> ${t.booking}`;
            if (mobileBookingBtn) mobileBookingBtn.innerHTML = `<i class="fas fa-calendar-check"></i> ${t.mobileBooking}`;
        }

        function applyFooterTranslation(lang) {
            const t = footerTranslations[lang];
            if (!t) return;
            const brandDesc = document.getElementById('footerBrandDesc');
            if (brandDesc) brandDesc.innerText = t.brandDesc;
            const emergencyTextSpan = document.getElementById('footerEmergencyText');
            if (emergencyTextSpan) emergencyTextSpan.innerText = t.emergencyText;
            const quickTitle = document.getElementById('footerColQuickTitle');
            if (quickTitle) quickTitle.innerText = t.quickTitle;
            const specsTitle = document.getElementById('footerColSpecialtiesTitle');
            if (specsTitle) specsTitle.innerText = t.specialtiesTitle;
            const contactTitle = document.getElementById('footerColContactTitle');
            if (contactTitle) contactTitle.innerText = t.contactTitle;
            const quickLinksList = document.getElementById('footerQuickLinks');
            if (quickLinksList) {
                const items = quickLinksList.querySelectorAll('li .link-text');
                items.forEach((item, idx) => {
                    if (t.quickLinks[idx]) item.innerText = t.quickLinks[idx];
                });
            }
            const specsLinksList = document.getElementById('footerSpecialtiesLinks');
            if (specsLinksList) {
                const items = specsLinksList.querySelectorAll('li .link-text');
                items.forEach((item, idx) => {
                    if (t.specialtiesLinks[idx]) item.innerText = t.specialtiesLinks[idx];
                });
            }
            const addressLabel = document.getElementById('contactAddressLabel');
            if (addressLabel) addressLabel.innerText = t.contactAddressLabel;
            const addressValue = document.getElementById('contactAddressValue');
            if (addressValue) addressValue.innerText = t.contactAddressValue;
            const phoneLabel = document.getElementById('contactPhoneLabel');
            if (phoneLabel) phoneLabel.innerText = t.contactPhoneLabel;
            const phoneValue = document.getElementById('contactPhoneValue');
            if (phoneValue) phoneValue.innerText = t.contactPhoneValue;
            const emailLabel = document.getElementById('contactEmailLabel');
            if (emailLabel) emailLabel.innerText = t.contactEmailLabel;
            const emailValue = document.getElementById('contactEmailValue');
            if (emailValue) emailValue.innerText = t.contactEmailValue;
            const hoursLabel = document.getElementById('contactHoursLabel');
            if (hoursLabel) hoursLabel.innerText = t.contactHoursLabel;
            const hoursValue = document.getElementById('contactHoursValue');
            if (hoursValue) hoursValue.innerText = t.contactHoursValue;
            const copyrightP = document.getElementById('footerCopyright');
            if (copyrightP) {
                const year = new Date().getFullYear();
                copyrightP.innerHTML = `&copy; ${year} <span>MediCare</span>. ${t.copyright}`;
            }
            const privacyLink = document.getElementById('footerPrivacyLink');
            if (privacyLink) privacyLink.innerText = t.privacyLink;
            const termsLink = document.getElementById('footerTermsLink');
            if (termsLink) termsLink.innerText = t.termsLink;
            const sitemapLink = document.getElementById('footerSitemapLink');
            if (sitemapLink) sitemapLink.innerText = t.sitemapLink;
        }

        function applyLanguageAndDirection(lang) {
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            const langLabelSpan = document.getElementById('langLabel');
            if (langLabelSpan) {
                langLabelSpan.textContent = lang === 'ar' ? 'English' : 'العربية';
            }
            applyNavTranslation(lang);
            applyFooterTranslation(lang);
            if (typeof window.applyPageTranslation === 'function') {
                window.applyPageTranslation(lang);
            }
        }

        function setAndSaveLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('siteLang', lang);
            applyLanguageAndDirection(lang);
        }

        function toggleLanguage() {
            const newLang = currentLang === 'en' ? 'ar' : 'en';
            setAndSaveLanguage(newLang);
        }

        // Initialize language on page load
        setAndSaveLanguage(currentLang);

        // Also run again when DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            const savedLang = localStorage.getItem('siteLang');
            if (savedLang && savedLang !== currentLang) {
                setAndSaveLanguage(savedLang);
            } else if (savedLang) {
                applyLanguageAndDirection(savedLang);
            }
        });

        
    </script>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="I_3niiqEY5aubfRKxyH3j";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
    @stack('scripts')
</body>
</html>
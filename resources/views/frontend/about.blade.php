{{-- resources/views/about.blade.php --}}

@extends('layouts.app')

@section('title', 'MediCare - About Us')

@push('styles')
<style>

/* التأثير الأساسي - hover أنيق واحترافي */
.lang-btn {
    background: transparent;
    color: #c9a24d;
    border: 1px solid #c9a24d;
    padding: 6px 15px;
    border-radius: 30px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: bold;
    flex-shrink: 0;
    min-width: 100px;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
}

.lang-btn:hover {
    background: #c9a24d;
    color: #ffffff;
    transform: scale(1.05);
    box-shadow: 0 6px 14px rgba(201, 162, 77, 0.35);
    border-color: #c9a24d;
}

.lang-btn:active {
    transform: scale(0.98);
    transition: 0.05s;
}

    /* ========== فقط أنماط محتوى صفحة About Us ========== */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }

    body {
        background-color: #fcfcfc;
        color: #1F2A44;
        overflow-x: hidden;
        line-height: 1.6;
    }

    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* HERO SECTION */
    .hero {
        height: 400px;
        background: linear-gradient(rgba(31, 42, 68, 0.8), rgba(31, 42, 68, 0.8)), url('{{ asset("mon/images/home.png") }}') center/cover;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        position: relative;
    }

    .top-badge {
        background: rgba(201,162,77,0.2);
        color: #C9A24D;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 20px;
        display: inline-block;
        backdrop-filter: blur(4px);
    }

    .hero h1 { font-size: 42px; margin-bottom: 15px; }
    .highlight { color: #C9A24D; }
    .hero p { max-width: 600px; margin: 0 auto; font-size: 15px; opacity: 0.9; }

    /* MISSION & VISION CARDS */
    .mission-vision { margin-top: -50px; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .card { padding: 40px; border-radius: 15px; color: white; transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1), box-shadow 0.4s ease; position: relative; overflow: hidden; cursor: pointer; }
    .card-cyan { background: #1F2A44; }
    .card-dark { background: #0f172a; }
    .card i { font-size: 40px; margin-bottom: 20px; color: #C9A24D; transition: transform 0.3s ease; }
    .card:hover { transform: translateY(-8px); box-shadow: 0 25px 40px -12px rgba(0,0,0,0.25); }
    .card:hover i { transform: scale(1.1); }

    /* VALUES SECTION */
    .values { padding: 80px 0; text-align: center; }
    .section-tag { color: #C9A24D; font-weight: 700; font-size: 12px; letter-spacing: 2px; display: block; margin-bottom: 10px; }
    .section-title { font-size: 32px; margin-bottom: 40px; }
    .values-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
    .value-icon { width: 60px; height: 60px; background: #f0f4f8; color: #1F2A44; display: flex; align-items: center; justify-content: center; border-radius: 50%; margin: 0 auto 15px; font-size: 20px; transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1); }
    .value-item { transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer; border-radius: 24px; padding: 20px 12px; }
    .value-item:hover { transform: translateY(-6px); background: white; box-shadow: 0 20px 30px -12px rgba(0,0,0,0.08); }
    .value-item:hover .value-icon { background: #C9A24D; color: white; transform: scale(1.05); }

    /* TIMELINE */
    .milestones { background: #f4f7f9; padding: 80px 0; }
    .timeline { position: relative; max-width: 800px; margin: 40px auto; }
    .timeline-line { position: absolute; left: 50%; width: 2px; height: 100%; background: #C9A24D; transform: translateX(-50%); }
    .timeline-item { width: 100%; margin-bottom: 40px; display: flex; align-items: center; position: relative; }
    .timeline-content { width: 45%; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer; }
    .timeline-content:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 15px 30px -10px rgba(0,0,0,0.12); }
    .left { justify-content: flex-start; }
    .right { justify-content: flex-end; }
    .timeline-dot { width: 14px; height: 14px; background: #C9A24D; border-radius: 50%; position: absolute; left: 50%; transform: translateX(-50%); border: 3px solid #f4f7f9; transition: all 0.2s ease; }
    .timeline-item:hover .timeline-dot { transform: translateX(-50%) scale(1.4); background: white; box-shadow: 0 0 0 4px rgba(201,162,77,0.3); }
    .year { color: #C9A24D; font-weight: 700; font-size: 18px; display: block; }

    /* IMAGE + STATS */
    .img-stats-section { padding: 80px 0; background: #fff; }
    .img-stats-grid { display: grid; grid-template-columns: 1.1fr 1fr; gap: 60px; align-items: center; }
    .img-gallery { display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: auto auto; gap: 14px; }
    .img-gallery .img-main-wrap { grid-column: 1 / -1; border-radius: 18px; overflow: hidden; }
    .img-gallery .img-main-wrap img { width: 100%; height: 270px; object-fit: cover; display: block; transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1); will-change: transform; }
    .img-gallery .img-main-wrap img:hover { transform: scale(1.05); }
    .img-gallery .img-sec { border-radius: 14px; overflow: hidden; }
    .img-gallery .img-sec img { width: 100%; height: 150px; object-fit: cover; display: block; transition: transform 0.4s ease; }
    .img-gallery .img-sec img:hover { transform: scale(1.08); }
    .stats-content-box h3 { font-size: 1.6rem; color: #1a2e44; font-weight: 700; margin-bottom: 14px; }
    .stats-content-box > p { color: #6b7a8d; line-height: 1.8; margin-bottom: 32px; }
    .stats-list { display: flex; flex-direction: column; gap: 0; }
    .stat-row { display: flex; align-items: flex-start; gap: 20px; padding: 22px 0; border-bottom: 1px solid #f0ece4; transition: all 0.3s ease; cursor: pointer; border-radius: 12px; padding-left: 8px; padding-right: 8px; }
    .stat-row:first-child { border-top: 1px solid #f0ece4; }
    .stat-row:hover { transform: translateX(10px); background: rgba(201,162,77,0.05); border-color: #C9A24D; }
    .stat-num-big { font-size: 2rem; font-weight: 800; color: #C9A24D; min-width: 80px; line-height: 1; flex-shrink: 0; }
    .stat-info h5 { font-size: 0.95rem; font-weight: 700; color: #1a2e44; margin-bottom: 4px; }
    .stat-info p { font-size: 0.84rem; color: #6b7a8d; margin: 0; }

    /* PROMISE SECTION */
    .promise-section { padding: 80px 0; background: #f8f9fb; }
    .promise-section .sec-label { display: block; text-align: center; color: #C9A24D; font-size: 12px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 12px; }
    .promise-section h2 { text-align: center; font-size: 1.9rem; color: #1a2e44; font-weight: 700; margin-bottom: 50px; }
    .promise-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
    .promise-card { background: #fff; border-radius: 18px; padding: 36px 28px; text-align: center; transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1), box-shadow 0.4s ease; border: 1.5px solid #f0ece4; cursor: pointer; position: relative; overflow: hidden; }
    .promise-card::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0%; height: 3px; background: #C9A24D; transition: width 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1); }
    .promise-card:hover::after { width: 100%; }
    .promise-card:hover { transform: translateY(-8px); box-shadow: 0 20px 35px -12px rgba(201,162,77,0.15); border-color: #C9A24D; }
    .promise-icon { width: 64px; height: 64px; background: #fff7e6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 26px; color: #C9A24D; transition: background 0.3s ease, transform 0.2s ease; }
    .promise-card:hover .promise-icon { background: #C9A24D; color: #fff; transform: scale(1.05); }
    .promise-card h4 { font-size: 1.1rem; font-weight: 700; color: #1a2e44; margin-bottom: 12px; }
    .promise-card p { color: #6b7a8d; font-size: 0.9rem; line-height: 1.7; margin: 0; }

    /* SPECIALTIES SECTION */
    .specialties-section { padding: 80px 0; background: #fff; }
    .specialties-section .sec-label { display: block; text-align: center; color: #C9A24D; font-size: 12px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 12px; }
    .specialties-section h2 { text-align: center; font-size: 1.9rem; color: #1a2e44; font-weight: 700; margin-bottom: 12px; }
    .specialties-section .sec-desc { text-align: center; color: #6b7a8d; max-width: 580px; margin: 0 auto 50px; line-height: 1.7; }
    .specialties-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 18px; margin-bottom: 60px; }
    .spec-item { background: #f8f9fb; border-radius: 14px; padding: 28px 12px; text-align: center; border: 1.5px solid transparent; transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1); cursor: pointer; }
    .spec-item:hover { background: #fff7e6; border-color: #C9A24D; transform: translateY(-4px); }
    .spec-item i { font-size: 28px; color: #C9A24D; display: block; margin-bottom: 10px; transition: transform 0.3s cubic-bezier(0.34, 1.2, 0.64, 1); }
    .spec-item:hover i { transform: scale(1.2) rotate(3deg); }
    .spec-item span { font-size: 0.82rem; font-weight: 700; color: #1a2e44; }
    .accred-section { background: #f8f9fb; border-radius: 20px; padding: 48px 40px; }
    .accred-section h3 { text-align: center; font-size: 1.4rem; color: #1a2e44; font-weight: 700; margin-bottom: 10px; }
    .accred-section .sec-desc { text-align: center; color: #6b7a8d; margin-bottom: 40px; }
    .accred-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 16px; align-items: center; justify-items: center; }
    .accred-item { background: #fff; border-radius: 12px; border: 1.5px solid #f0ece4; padding: 20px 16px; display: flex; align-items: center; justify-content: center; width: 100%; min-height: 80px; transition: all 0.3s ease; cursor: pointer; }
    .accred-item:hover { border-color: #C9A24D; transform: translateY(-3px); box-shadow: 0 12px 20px -10px rgba(201,162,77,0.2); background: #fffef7; }
    .accred-item i { font-size: 28px; color: #C9A24D; transition: transform 0.2s ease; }
    .accred-item:hover i { transform: scale(1.1); }
    .accred-item span { font-size: 11px; font-weight: 700; color: #1a2e44; text-align: center; display: block; margin-top: 6px; }
    .accred-inner { display: flex; flex-direction: column; align-items: center; gap: 6px; }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .values-grid { grid-template-columns: repeat(2, 1fr); }
        .img-stats-grid { grid-template-columns: 1fr; }
        .promise-grid { grid-template-columns: 1fr; }
        .specialties-grid { grid-template-columns: repeat(3, 1fr); }
        .accred-grid { grid-template-columns: repeat(3, 1fr); }
        .grid-2 { grid-template-columns: 1fr; }
    }
   @media (max-width: 768px) {
    .nav-links {
        display: none !important;
    }
    .nav-links.active {
        display: flex !important;
        position: fixed;
        top: 0;
        right: 0;
        width: 70%;
        max-width: 300px;
        height: 100vh;
        background: #1F2A44;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        z-index: 1050;
        box-shadow: -5px 0 15px rgba(0,0,0,0.3);
    }
    body[dir="rtl"] .nav-links.active {
        right: auto;
        left: 0;
    }
    .menu-toggle.is-active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
    .menu-toggle.is-active span:nth-child(2) { opacity: 0; }
    .menu-toggle.is-active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }
}
    @media (max-width: 600px) {
        .specialties-grid { grid-template-columns: repeat(2, 1fr); }
        .accred-grid { grid-template-columns: repeat(2, 1fr); }
    }   
    
    /* ========== إعدادات أولية خفيفة للأنيمشن (بدون تداخل) ========== */
    /* نخفي العناصر مؤقتاً إلى أن يظهرها GSAP مرة واحدة فقط */
    .hero .hero-overlay .top-badge,
    .hero .hero-overlay h1,
    .hero .hero-overlay p,
    .mission-vision .card,
    .value-item, .promise-card, .spec-item, .accred-item, .stat-row,
    .timeline-item, .img-main-wrap, .img-sec, .stats-content-box h3,
    .stats-content-box > p, .section-tag, .section-title, .sec-label {
        opacity: 0;
        transform: translateY(25px);
        will-change: transform, opacity;
    }
</style>
@endpush

@section('content')
    <main class="page-content" id="mainContent">
        <header class="hero">
            <div class="hero-overlay">
              <br>  <br>  <span class="top-badge" id="hero-badge">ABOUT MEDICARE</span> 
                <h1 id="hero-title">Transforming Healthcare <br> <span class="highlight">Since 2008</span></h1>
                <p id="hero-desc">We are committed to providing exceptional healthcare services with compassion, innovation, and a patient-first approach.</p>
                <br> <br> <br> <br> <br> <br>
            </div>
        </header>

        <section class="mission-vision">
            <div class="container grid-2">
                <div class="card card-cyan">
                    <i class="fas fa-bullseye"></i>
                    <h3 id="mission-title">Our Mission</h3>
                    <p id="mission-desc">To deliver exceptional, compassionate healthcare that improves the lives of our patients and communities.</p>
                </div>
                <div class="card card-dark">
                    <i class="fas fa-eye"></i>
                    <h3 id="vision-title">Our Vision</h3>
                    <p id="vision-desc">To be the leading healthcare provider known for excellence in patient care, medical innovation, and community wellness globally.</p>
                </div>
            </div>
        </section>

        <section class="img-stats-section">
            <div class="container">
                <div class="img-stats-grid">
                    <div class="img-gallery">
                        <div class="img-main-wrap"><img src="{{ asset('mon/images/why-choose-us.jpg') }}" alt="Medical Facility"></div>
                        <div class="img-sec"><img src="{{ asset('mon/images/cardiology.jpg') }}" alt="Medical Team"></div>
                        <div class="img-sec"><img src="{{ asset('mon/images/neurology.jpg') }}" alt="Patient Consultation"></div>
                    </div>
                    <div class="stats-content-box">
                        <h3 id="sc-title">Trusted Healthcare Provider</h3>
                        <p id="sc-desc">We combine cutting-edge medical technology with compassionate, personalized treatment to ensure every patient receives the highest standard of care.</p>
                        <div class="stats-list">
                            <div class="stat-row"><div class="stat-num-big">22K+</div><div class="stat-info"><h5 id="sr1-title">Successful Treatments</h5><p id="sr1-desc">Completed with excellent patient outcomes</p></div></div>
                            <div class="stat-row"><div class="stat-num-big">95%</div><div class="stat-info"><h5 id="sr2-title">Patient Satisfaction</h5><p id="sr2-desc">Based on comprehensive feedback surveys</p></div></div>
                            <div class="stat-row"><div class="stat-num-big">85+</div><div class="stat-info"><h5 id="sr3-title">Medical Professionals</h5><p id="sr3-desc">Specialists across various departments</p></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="values">
            <div class="container">
                <span class="section-tag" id="values-tag">OUR VALUES</span>
                <h2 class="section-title" id="values-title">What We Stand For</h2>
                <div class="values-grid">
                    <div class="value-item"><div class="value-icon"><i class="fas fa-heart"></i></div><h4 id="value1">Compassion</h4></div>
                    <div class="value-item"><div class="value-icon"><i class="fas fa-shield-alt"></i></div><h4 id="value2">Excellence</h4></div>
                    <div class="value-item"><div class="value-icon"><i class="fas fa-users"></i></div><h4 id="value3">Teamwork</h4></div>
                    <div class="value-item"><div class="value-icon"><i class="fas fa-handshake"></i></div><h4 id="value4">Integrity</h4></div>
                </div>
            </div>
        </section>

        <section class="promise-section">
            <div class="container">
                <span class="sec-label" id="prom-label">OUR COMMITMENTS</span>
                <h2 id="prom-title">Our Mission, Vision & Promise</h2>
                <div class="promise-grid">
                    <div class="promise-card"><div class="promise-icon"><i class="fa-solid fa-heart-pulse"></i></div><h4 id="pc1-title">Our Mission</h4><p id="pc1-desc">To provide comprehensive, patient-centered healthcare that combines medical excellence with genuine compassion.</p></div>
                    <div class="promise-card"><div class="promise-icon"><i class="fa-solid fa-eye"></i></div><h4 id="pc2-title">Our Vision</h4><p id="pc2-desc">To be the leading healthcare provider in our region, recognized for innovative treatments and exceptional outcomes.</p></div>
                    <div class="promise-card"><div class="promise-icon"><i class="fa-solid fa-star"></i></div><h4 id="pc3-title">Our Promise</h4><p id="pc3-desc">Every patient will receive the highest quality care in a comfortable, supportive environment.</p></div>
                </div>
            </div>
        </section>

        <section class="milestones">
            <div class="container">
                <span class="section-tag" id="timeline-tag">OUR JOURNEY</span>
                <h2 class="section-title" id="timeline-title">Milestones & Achievements</h2>
                <div class="timeline">
                    <div class="timeline-line"></div>
                    <div class="timeline-item left"><div class="timeline-content"><span class="year" id="year1">2008</span><h4 id="timeline1-title">Foundation</h4><p id="timeline1-desc">MediCare was started with a vision to transform healthcare in the region.</p></div><div class="timeline-dot"></div></div>
                    <div class="timeline-item right"><div class="timeline-dot"></div><div class="timeline-content"><span class="year" id="year2">2012</span><h4 id="timeline2-title">First Expansion</h4><p id="timeline2-desc">Opened our second branch to serve more communities with quality care.</p></div></div>
                    <div class="timeline-item left"><div class="timeline-content"><span class="year" id="year3">2022</span><h4 id="timeline3-title">Global Recognition</h4><p id="timeline3-desc">Received international awards for excellence in healthcare services.</p></div><div class="timeline-dot"></div></div>
                </div>
            </div>
        </section>

        <section class="specialties-section">
            <div class="container">
                <span class="sec-label" id="spec-label">WHAT WE OFFER</span>
                <h2 id="spec-title">Areas of Excellence</h2>
                <p class="sec-desc" id="spec-desc">Our specialized departments work together to provide comprehensive care across multiple medical disciplines</p>
                <div class="specialties-grid">
                    <div class="spec-item"><i class="fa-solid fa-heart-pulse"></i><span id="spec1">Cardiology</span></div>
                    <div class="spec-item"><i class="fa-solid fa-brain"></i><span id="spec2">Neurology</span></div>
                    <div class="spec-item"><i class="fa-solid fa-baby"></i><span id="spec3">Pediatrics</span></div>
                    <div class="spec-item"><i class="fa-solid fa-scissors"></i><span id="spec4">Surgery</span></div>
                    <div class="spec-item"><i class="fa-solid fa-ribbon"></i><span id="spec5">Oncology</span></div>
                    <div class="spec-item"><i class="fa-solid fa-kit-medical"></i><span id="spec6">Emergency</span></div>
                </div>
                <div class="accred-section">
                    <h3 id="accred-title">Recognized Excellence</h3>
                    <p class="sec-desc" id="accred-desc">Our commitment to quality is validated by prestigious healthcare organizations</p>
                    <div class="accred-grid">
                        <div class="accred-item"><div class="accred-inner"><i class="fa-solid fa-award"></i><span id="accred1">JCI Accredited</span></div></div>
                        <div class="accred-item"><div class="accred-inner"><i class="fa-solid fa-certificate"></i><span id="accred2">ISO Certified</span></div></div>
                        <div class="accred-item"><div class="accred-inner"><i class="fa-solid fa-shield-halved"></i><span id="accred3">Quality Assured</span></div></div>
                        <div class="accred-item"><div class="accred-inner"><i class="fa-solid fa-star"></i><span id="accred4">5-Star Rated</span></div></div>
                        <div class="accred-item"><div class="accred-inner"><i class="fa-solid fa-trophy"></i><span id="accred5">Best Hospital</span></div></div>
                        <div class="accred-item"><div class="accred-inner"><i class="fa-solid fa-medal"></i><span id="accred6">Excellence Award</span></div></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
// ========== أنيمشن واحد نظيف بدون تداخل ==========

// Define translation function globally (used by layout's toggleLanguage)
window.applyPageTranslation = function(lang) {
    const translations = {
        en: {
            heroBadge: 'ABOUT MEDICARE',
            heroTitle: 'Transforming Healthcare <br><span class="highlight">Since 2008</span>',
            heroDesc: 'We are committed to providing exceptional healthcare services with compassion, innovation, and a patient-first approach.',
            missionTitle: 'Our Mission',
            missionDesc: 'To deliver exceptional, compassionate healthcare that improves the lives of our patients and communities.',
            visionTitle: 'Our Vision',
            visionDesc: 'To be the leading healthcare provider known for excellence in patient care, medical innovation, and community wellness globally.',
            scTitle: 'Trusted Healthcare Provider',
            scDesc: 'We combine cutting-edge medical technology with compassionate, personalized treatment to ensure every patient receives the highest standard of care.',
            sr1Title: 'Successful Treatments', sr1Desc: 'Completed with excellent patient outcomes',
            sr2Title: 'Patient Satisfaction', sr2Desc: 'Based on comprehensive feedback surveys',
            sr3Title: 'Medical Professionals', sr3Desc: 'Specialists across various departments',
            valuesTag: 'OUR VALUES',
            valuesTitle: 'What We Stand For',
            value1: 'Compassion', value2: 'Excellence', value3: 'Teamwork', value4: 'Integrity',
            promLabel: 'OUR COMMITMENTS', promTitle: 'Our Mission, Vision & Promise',
            pc1Title: 'Our Mission', pc1Desc: 'To provide comprehensive, patient-centered healthcare that combines medical excellence with genuine compassion.',
            pc2Title: 'Our Vision', pc2Desc: 'To be the leading healthcare provider in our region, recognized for innovative treatments and exceptional outcomes.',
            pc3Title: 'Our Promise', pc3Desc: 'Every patient will receive the highest quality care in a comfortable, supportive environment.',
            timelineTag: 'OUR JOURNEY',
            timelineTitle: 'Milestones & Achievements',
            year1: '2008', timeline1Title: 'Foundation', timeline1Desc: 'MediCare was started with a vision to transform healthcare in the region.',
            year2: '2012', timeline2Title: 'First Expansion', timeline2Desc: 'Opened our second branch to serve more communities with quality care.',
            year3: '2022', timeline3Title: 'Global Recognition', timeline3Desc: 'Received international awards for excellence in healthcare services.',
            specLabel: 'WHAT WE OFFER', specTitle: 'Areas of Excellence',
            specDesc: 'Our specialized departments work together to provide comprehensive care across multiple medical disciplines',
            spec1: 'Cardiology', spec2: 'Neurology', spec3: 'Pediatrics', spec4: 'Surgery', spec5: 'Oncology', spec6: 'Emergency',
            accredTitle: 'Recognized Excellence',
            accredDesc: 'Our commitment to quality is validated by prestigious healthcare organizations',
            accred1: 'JCI Accredited', accred2: 'ISO Certified', accred3: 'Quality Assured', accred4: '5-Star Rated', accred5: 'Best Hospital', accred6: 'Excellence Award'
        },
        ar: {
            heroBadge: 'نبذة عن ميديكير',
            heroTitle: 'تحويل الرعاية الصحية <br><span class="highlight">منذ ٢٠٠٨</span>',
            heroDesc: 'نحن ملتزمون بتقديم خدمات رعاية صحية استثنائية برحمة وابتكار ونهج يركز على المريض أولاً.',
            missionTitle: 'رسالتنا',
            missionDesc: 'تقديم رعاية صحية استثنائية ورحيمة تعمل على تحسين حياة مرضانا ومجتمعاتنا.',
            visionTitle: 'رؤيتنا',
            visionDesc: 'أن نكون مقدم الرعاية الصحية الرائد المعروف بالتميز في رعاية المرضى والابتكار الطبي والرفاهية المجتمعية عالمياً.',
            scTitle: 'مزود رعاية صحية موثوق',
            scDesc: 'ندمج التكنولوجيا الطبية المتطورة مع العلاج الرحيم والشخصي لضمان حصول كل مريض على أعلى مستوى من الرعاية.',
            sr1Title: 'علاجات ناجحة', sr1Desc: 'مكتملة بنتائج ممتازة للمرضى',
            sr2Title: 'رضا المرضى', sr2Desc: 'بناءً على استطلاعات شاملة',
            sr3Title: 'متخصصون طبيون', sr3Desc: 'أخصائيون في مختلف الأقسام',
            valuesTag: 'قيمنا',
            valuesTitle: 'ما نؤمن به',
            value1: 'الرحمة', value2: 'التميز', value3: 'العمل الجماعي', value4: 'النزاهة',
            promLabel: 'التزاماتنا', promTitle: 'رسالتنا ورؤيتنا ووعدنا',
            pc1Title: 'رسالتنا', pc1Desc: 'تقديم رعاية صحية شاملة تتمحور حول المريض تجمع بين التميز الطبي والرحمة الحقيقية.',
            pc2Title: 'رؤيتنا', pc2Desc: 'أن نكون مزود الرعاية الصحية الرائد في منطقتنا، المعروف بالعلاجات المبتكرة والنتائج الاستثنائية.',
            pc3Title: 'وعدنا', pc3Desc: 'سيحصل كل مريض على أعلى جودة من الرعاية في بيئة مريحة وداعمة.',
            timelineTag: 'رحلتنا',
            timelineTitle: 'المحطات والإنجازات',
            year1: '٢٠٠٨', timeline1Title: 'التأسيس', timeline1Desc: 'بدأت ميديكير برؤية لتغيير الرعاية الصحية في المنطقة.',
            year2: '٢٠١٢', timeline2Title: 'التوسع الأول', timeline2Desc: 'افتتحنا فرعنا الثاني لخدمة المزيد من المجتمعات برعاية عالية الجودة.',
            year3: '٢٠٢٢', timeline3Title: 'الاعتراف العالمي', timeline3Desc: 'حصلنا على جوائز دولية للتميز في خدمات الرعاية الصحية.',
            specLabel: 'ما نقدمه', specTitle: 'مجالات التميز',
            specDesc: 'تتعاون أقسامنا المتخصصة لتقديم رعاية شاملة عبر العديد من التخصصات الطبية',
            spec1: 'أمراض القلب', spec2: 'طب الأعصاب', spec3: 'طب الأطفال', spec4: 'الجراحة', spec5: 'الأورام', spec6: 'الطوارئ',
            accredTitle: 'تميز معترف به',
            accredDesc: 'التزامنا بالجودة معتمد من قِبل المنظمات الصحية المرموقة',
            accred1: 'معتمد JCI', accred2: 'معتمد ISO', accred3: 'جودة مضمونة', accred4: 'تصنيف 5 نجوم', accred5: 'أفضل مستشفى', accred6: 'جائزة التميز'
        }
    };
    const t = translations[lang];
    if (!t) return;
    const setText = (id, text) => { const el = document.getElementById(id); if (el) el.innerHTML = text; };
    
    // Hero
    setText('hero-badge', t.heroBadge);
    setText('hero-title', t.heroTitle);
    setText('hero-desc', t.heroDesc);
    
    // Mission & Vision
    setText('mission-title', t.missionTitle);
    setText('mission-desc', t.missionDesc);
    setText('vision-title', t.visionTitle);
    setText('vision-desc', t.visionDesc);
    
    // Stats section
    setText('sc-title', t.scTitle);
    setText('sc-desc', t.scDesc);
    setText('sr1-title', t.sr1Title);
    setText('sr1-desc', t.sr1Desc);
    setText('sr2-title', t.sr2Title);
    setText('sr2-desc', t.sr2Desc);
    setText('sr3-title', t.sr3Title);
    setText('sr3-desc', t.sr3Desc);
    
    // Values
    setText('values-tag', t.valuesTag);
    setText('values-title', t.valuesTitle);
    setText('value1', t.value1);
    setText('value2', t.value2);
    setText('value3', t.value3);
    setText('value4', t.value4);
    
    // Promise
    setText('prom-label', t.promLabel);
    setText('prom-title', t.promTitle);
    setText('pc1-title', t.pc1Title);
    setText('pc1-desc', t.pc1Desc);
    setText('pc2-title', t.pc2Title);
    setText('pc2-desc', t.pc2Desc);
    setText('pc3-title', t.pc3Title);
    setText('pc3-desc', t.pc3Desc);
    
    // Timeline
    setText('timeline-tag', t.timelineTag);
    setText('timeline-title', t.timelineTitle);
    setText('year1', t.year1);
    setText('timeline1-title', t.timeline1Title);
    setText('timeline1-desc', t.timeline1Desc);
    setText('year2', t.year2);
    setText('timeline2-title', t.timeline2Title);
    setText('timeline2-desc', t.timeline2Desc);
    setText('year3', t.year3);
    setText('timeline3-title', t.timeline3Title);
    setText('timeline3-desc', t.timeline3Desc);
    
    // Specialties
    setText('spec-label', t.specLabel);
    setText('spec-title', t.specTitle);
    setText('spec-desc', t.specDesc);
    setText('spec1', t.spec1);
    setText('spec2', t.spec2);
    setText('spec3', t.spec3);
    setText('spec4', t.spec4);
    setText('spec5', t.spec5);
    setText('spec6', t.spec6);
    
    // Accreditation
    setText('accred-title', t.accredTitle);
    setText('accred-desc', t.accredDesc);
    setText('accred1', t.accred1);
    setText('accred2', t.accred2);
    setText('accred3', t.accred3);
    setText('accred4', t.accred4);
    setText('accred5', t.accred5);
    setText('accred6', t.accred6);
};

// Immediately apply saved language before any animation or content rendering
(function() {
    try {
        const savedLang = localStorage.getItem('siteLang');
        if (savedLang === 'ar' || savedLang === 'en') {
            window.applyPageTranslation(savedLang);
        } else {
            // Default to English
            window.applyPageTranslation('en');
        }
    } catch(e) { /* ignore */ }
})();

document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);
    
    // Ensure translation is applied again after DOM is fully loaded (in case external script changed)
    const currentLang = localStorage.getItem('siteLang') || 'en';
    window.applyPageTranslation(currentLang);
    
    // تجنب الحركة إذا كان المستخدم يفضل التقليل
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        gsap.set([".hero .hero-overlay .top-badge", ".hero .hero-overlay h1", ".hero .hero-overlay p",
                  ".mission-vision .card", ".value-item", ".promise-card", ".spec-item", 
                  ".accred-item", ".stat-row", ".timeline-item", ".img-main-wrap", 
                  ".img-sec", ".stats-content-box h3", ".stats-content-box > p",
                  ".section-tag", ".section-title", ".sec-label"], { opacity: 1, y: 0 });
        return;
    }
    
    // --- 1. أنيمشن الهيرو (مرة واحدة فقط، بدون CSS animation) ---
    const heroBadge = document.querySelector(".hero .top-badge");
    const heroTitle = document.querySelector(".hero h1");
    const heroPara = document.querySelector(".hero p");
    
    // تأكد من أنهم مخفيون في البداية
    gsap.set([heroBadge, heroTitle, heroPara], { opacity: 0, y: 30 });
    
    // تشغيل الحركة فوراً (مرة واحدة فقط)
    gsap.to(heroBadge, { opacity: 1, y: 0, duration: 0.7, ease: "power2.out", delay: 0.1 });
    gsap.to(heroTitle, { opacity: 1, y: 0, duration: 0.8, ease: "power2.out", delay: 0.2 });
    gsap.to(heroPara, { opacity: 1, y: 0, duration: 0.7, ease: "power2.out", delay: 0.35 });
    
    // --- 2. ظهور باقي العناصر عند التمرير ---
    const elementsToReveal = [
        { selector: ".mission-vision .card", stagger: 0.1, y: 20 },
        { selector: ".value-item", stagger: 0.07, y: 18 },
        { selector: ".promise-card", stagger: 0.08, y: 20 },
        { selector: ".spec-item", stagger: 0.05, y: 15 },
        { selector: ".accred-item", stagger: 0.06, y: 15 },
        { selector: ".stat-row", stagger: 0.08, y: 18 },
        { selector: ".timeline-item", stagger: 0.12, y: 25 },
        { selector: ".section-tag, .section-title, .sec-label, .specialties-section h2, .specialties-section .sec-desc, .accred-section h3, .accred-section .sec-desc", stagger: 0.07, y: 15 },
        { selector: ".img-main-wrap, .img-sec, .stats-content-box h3, .stats-content-box > p", stagger: 0.1, y: 20 }
    ];
    
    elementsToReveal.forEach(item => {
        const elements = document.querySelectorAll(item.selector);
        if (elements.length === 0) return;
        
        gsap.set(elements, { opacity: 0, y: item.y });
        
        ScrollTrigger.batch(elements, {
            interval: 0.08,
            batchMax: 4,
            onEnter: (batch) => {
                gsap.to(batch, {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    ease: "power2.out",
                    stagger: item.stagger,
                    overwrite: true
                });
            },
            start: "top 88%",
            toggleActions: "play none none reverse"
        });
    });
    
    // --- 3. تأثير متابعة الماوس للبطاقات (خفيف) ---
    const cardsWithGlow = document.querySelectorAll(".card");
    cardsWithGlow.forEach(card => {
        card.addEventListener("mousemove", (e) => {
            const rect = card.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            card.style.setProperty('--mouse-x', `${x}%`);
            card.style.setProperty('--mouse-y', `${y}%`);
        });
    });
    
    // --- 4. ميكرو تفاعلات hover (خفيفة) ---
    const interactiveEls = document.querySelectorAll(".card, .value-item, .promise-card, .spec-item, .accred-item, .stat-row, .timeline-content");
    interactiveEls.forEach(el => {
        el.addEventListener("mouseenter", () => {
            gsap.to(el, { duration: 0.2, scale: 1.01, ease: "power1.out" });
        });
        el.addEventListener("mouseleave", () => {
            gsap.to(el, { duration: 0.3, scale: 1, ease: "power1.out" });
        });
    });
    
    // تحديث ScrollTrigger بعد تحميل الصور
    window.addEventListener('load', () => ScrollTrigger.refresh());
});
</script>
@endpush
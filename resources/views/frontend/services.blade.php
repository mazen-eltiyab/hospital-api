{{-- resources/views/services.blade.php --}}
@extends('layouts.app')

@section('title', 'MediCare - Medical Services')

@push('styles')
<style>
  html, body {
    width: 100%;
    overflow-x: hidden;
    position: relative;
  }

  /* ===== تحسين زر اللغة ===== */
  .lang-btn {
    background: transparent;
    color: #c9a24d;
    border: 1px solid #c9a24d;
    padding: 6px 15px;
    border-radius: 30px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: bold;
    margin: 0 15px;
    transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
  }
  .lang-btn:hover {
    background: #c9a24d;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 6px 14px rgba(201,162,77,0.35);
  }
  .lang-btn:active {
    transform: scale(0.98);
  }

  .nav-controls {
    display: flex;
    align-items: center;
    gap: 0px !important;
    flex-shrink: 0;
  }

  /* ========== الأنماط العامة ========== */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Arial, sans-serif;
  }

  :root {
    --main-color: #1F2A44;
    --accent-color: #C9A24D;
    --light-bg: #f5f7fa;
    --white: #ffffff;
    --ease-premium: cubic-bezier(0.25, 0.46, 0.45, 0.94);
    --ease-spring: cubic-bezier(0.68, -0.55, 0.265, 1.55);
  }

  body {
    background-color: var(--white);
    color: var(--main-color);
    line-height: 1.6;
    overflow-x: hidden;
  }

  .container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 20px;
  }

  /* ===== HERO ===== */
  .hero {
    text-align: center;
    padding: 80px 20px;
    background: var(--light-bg);
    position: relative;
    overflow: hidden;
  }
  .hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(201,162,77,0.08) 0%, rgba(31,42,68,0) 70%);
    animation: rotateBg 30s linear infinite;
    pointer-events: none;
  }
  @keyframes rotateBg {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  .badge {
    display: inline-block;
    background: var(--accent-color);
    padding: 6px 15px;
    border-radius: 20px;
    color: var(--main-color);
    font-weight: bold;
    font-size: 12px;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
  }
  .hero h1 {
    font-size: 2.5rem;
    margin-bottom: 15px;
    position: relative;
    z-index: 2;
  }
  .hero h1 span { color: var(--accent-color); }
  .hero p {
    max-width: 700px;
    margin: 0 auto;
    color: #666;
    position: relative;
    z-index: 2;
  }

  /* ===== SERVICES GRID ===== */
  .services {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    padding: 60px 20px;
  }
  .service-card {
    background: var(--main-color);
    padding: 30px;
    border-radius: 15px;
    color: var(--white);
    position: relative;
    overflow: hidden;
    cursor: pointer;
    transform-style: preserve-3d;
    will-change: transform;
    transition: transform 0.4s var(--ease-premium), box-shadow 0.4s ease;
  }
  .service-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0%;
    height: 4px;
    background: var(--accent-color);
    transition: width 0.4s var(--ease-premium);
  }
  .service-card:hover::after { width: 100%; }
  .service-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 25px 35px -12px rgba(201,162,77,0.4);
  }
  .service-card i {
    font-size: 35px;
    color: var(--accent-color);
    margin-bottom: 15px;
    transition: transform 0.3s var(--ease-spring);
    display: inline-block;
  }
  .service-card:hover i { transform: scale(1.2) rotate(5deg); }
  .service-card h3 { margin-bottom: 15px; }
  .service-card ul.service-list { list-style: none; padding: 0; margin: 0; }
  .service-card ul.service-list li {
    font-size: 14px;
    margin-bottom: 8px;
    opacity: 0.8;
    display: flex;
    align-items: center;
  }
  
  body[dir="rtl"] .service-card ul.service-list li::before {
    content: "•";
    color: var(--accent-color);
    margin-left: 8px;
    margin-right: 0;
  }
  body:not([dir="rtl"]) .service-card ul.service-list li::before {
    content: "•";
    color: var(--accent-color);
    margin-right: 8px;
    margin-left: 0;
  }

  /* ===== EMERGENCY ===== */
  .emergency {
    background: linear-gradient(135deg, #0b132b, #1F2A44);
    color: var(--white);
    text-align: center;
    padding: 100px 20px;
    position: relative;
    overflow: hidden;
  }
  .emergency::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(201,162,77,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
    opacity: 0.3;
    pointer-events: none;
  }
  .emergency-small { color: var(--accent-color); letter-spacing: 2px; font-weight: bold; margin-bottom: 15px; }
  .emergency-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin: 50px 0;
  }
  .em-card {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(8px);
    padding: 25px;
    border-radius: 12px;
    text-align: left;
    border-bottom: 3px solid transparent;
    transition: all 0.4s var(--ease-premium);
    cursor: pointer;
  }
  .em-card:hover {
    transform: translateY(-8px);
    background: rgba(255,255,255,0.15);
    border-bottom-color: var(--accent-color);
  }
  .em-card i {
    color: var(--accent-color);
    font-size: 24px;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
  }
  .em-card:hover i { transform: translateX(5px); }
  .emergency-phone { color: var(--accent-color); font-size: 32px; font-weight: 800; }

  /* ===== HOW IT WORKS ===== */
  .how {
    padding: 90px 20px;
    text-align: center;
    background: #fff;
  }
  .how-small {
    color: #1F2A44;
    letter-spacing: 2px;
    font-size: 12px;
    margin-bottom: 10px;
    font-weight: bold;
  }
  .how h2 {
    font-size: 32px;
    margin-bottom: 50px;
    color: #1F2A44;
  }
  .how-steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
  }
  .how-step {
    padding: 10px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
  }
  .how-step span {
    font-size: 44px;
    color: #ccefed;
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
    transition: all 0.3s var(--ease-spring);
  }
  .how-step:hover span {
    transform: scale(1.15);
    color: var(--accent-color);
  }
  .how-step h4 {
    margin-bottom: 8px;
    font-size: 18px;
    color: #1F2A44;
    transition: color 0.2s;
  }
  .how-step:hover h4 { color: var(--accent-color); }
  .how-step p {
    font-size: 14px;
    opacity: 0.7;
    line-height: 1.5;
    color: #1F2A44;
  }

  /* ===== CTA ===== */
  .cta {
    background: var(--main-color);
    padding: 70px 20px;
    text-align: center;
    color: var(--white);
  }
  .cta-btn {
    margin-top: 25px;
    padding: 15px 40px;
    background: var(--accent-color);
    border: none;
    border-radius: 30px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s var(--ease-spring);
    position: relative;
    overflow: hidden;
    z-index: 1;
  }
  .cta-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
    z-index: -1;
  }
  .cta-btn:hover::before { left: 100%; }
  .cta-btn:hover {
    transform: translateY(-5px) scale(1.03);
    background: var(--white);
    color: var(--main-color);
    box-shadow: 0 15px 25px -8px rgba(0,0,0,0.3);
  }
  .cta-btn:active { transform: translateY(2px); }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .services, .emergency-cards, .how-steps {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 768px) {
    .nav-links {
      display: none !important;
    }
    .nav-inner {
      max-width: 1140px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      align-items: center;
      justify-content: normal;
      gap: 10px !important;
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

    .hero::before {
      animation: none !important;
      transform: none !important;
    }
  }

  .hero.hero-no-anim::before {
    animation: none !important;
    animation-play-state: paused !important;
    transform: none !important;
  }

  .service-card, .em-card, .how-step, .cta-btn {
    opacity: 0;
    transform: translateY(40px);
    will-change: transform, opacity;
  }
</style>
@endpush

@section('content')
<section class="hero">
  <div class="container">
    <span class="badge" id="hero-badge">Our Services</span><br><br><br>
    <h1 id="hero-h1">Comprehensive <span>Healthcare Services</span></h1>
    <p id="hero-p">We offer a wide range of medical services delivered by experienced healthcare professionals using modern technology.</p>
  </div>
</section>

<!-- الـ Grid الديناميكي النظيف الخالي من حشو الكلمات والمطابق للأول تماماً بالملّي -->
<section class="services container" id="services-section">
  @isset($services)
    @forelse($services as $service)
      <div class="service-card" data-en-title="{{ $service->service_name }}" data-en-desc="{{ $service->description }}">
        
        <!-- استدعاء الأيقونات الفردية المتميزة لكل كارت تلقائياً -->
        @php
          $slug = Str::lower($service->service_name);
        @endphp
        <i class="fa-solid 
          @if(Str::contains($slug, 'cardio') || Str::contains($slug, 'قلب')) fa-heart-pulse 
          @elseif(Str::contains($slug, 'neuro') || Str::contains($slug, 'أعصاب')) fa-brain 
          @elseif(Str::contains($slug, 'pedia') || Str::contains($slug, 'أطفال')) fa-child 
          @elseif(Str::contains($slug, 'ortho') || Str::contains($slug, 'عظام')) fa-bone 
          @elseif(Str::contains($slug, 'ophthal') || Str::contains($slug, 'عيون')) fa-eye 
          @elseif(Str::contains($slug, 'general') || Str::contains($slug, 'عام')) fa-user-doctor 
          @elseif(Str::contains($slug, 'lab') || Str::contains($slug, 'مختبر') || Str::contains($slug, 'تحاليل')) fa-flask 
          @elseif(Str::contains($slug, 'radio') || Str::contains($slug, 'أشعة')) fa-x-ray 
          @else fa-stethoscope 
          @endif">
        </i>
        
        <h3 class="service-title">{{ $service->service_name }}</h3>
        
        <!-- اللائحة النقطية للخصائص التي تنقسم تلقائياً بناءً على ما أدخلته في الـ Admin -->
        <ul class="service-list">
          @php
            $features = preg_split('/[,;\n]+/', $service->description);
          @endphp
          @foreach($features as $feature)
            @if(trim($feature) != '')
              <li>{{ trim($feature) }}</li>
            @endif
          @endforeach
        </ul>
      </div>
    @empty
      <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #999;">
         <i class="fa-solid fa-folder-open" style="font-size: 40px; color: #ccc; margin-bottom: 10px;"></i>
         <p>No services found in the database.</p>
      </div>
    @endforelse
  @endisset
</section>

<section class="emergency">
  <div class="container">
    <p class="emergency-small" id="em-badge">EMERGENCY CARE</p>
    <h2 id="em-h2">24/7 Emergency Services</h2>
    <p class="emergency-desc" id="em-desc">Our emergency department is equipped to handle all medical emergencies with rapid response and expert care.</p>

    <div class="emergency-cards">
      <div class="em-card">
        <i class="fa-solid fa-power-off"></i>
        <h4 id="em1-title">24/7 Emergency</h4>
        <p id="em1-desc">Round-the-clock emergency medical services</p>
      </div>
      <div class="em-card">
        <i class="fa-solid fa-heart-pulse"></i>
        <h4 id="em2-title">Trauma Care</h4>
        <p id="em2-desc">Specialized trauma and critical care units</p>
      </div>
      <div class="em-card">
        <i class="fa-solid fa-bed-pulse"></i>
        <h4 id="em3-title">ICU Services</h4>
        <p id="em3-desc">Intensive care with advanced monitoring</p>
      </div>
      <div class="em-card">
        <i class="fa-solid fa-kit-medical"></i>
        <h4 id="em4-title">Urgent Care</h4>
        <p id="em4-desc">Walk-in urgent care for minor emergencies</p>
      </div>
    </div>

    <p class="hotline" id="hotline-text">Emergency Hotline</p>
    <p class="emergency-phone">+1 (555) 911-HELP</p>
  </div>
</section>

<section class="how container">
  <p class="how-small">HOW IT WORKS</p>
  <h2 id="how-h2">Simple Appointment Process</h2>
  <div class="how-steps">
    <div class="how-step">
      <span>01</span>
      <h4 id="step1-title">Choose Service</h4>
      <p id="step1-desc">Select the medical service you need</p>
    </div>
    <div class="how-step">
      <span>02</span>
      <h4 id="step2-title">Select Doctor</h4>
      <p id="step2-desc">Pick from our qualified specialists</p>
    </div>
    <div class="how-step">
      <span>03</span>
      <h4 id="step3-title">Book Time</h4>
      <p id="step3-desc">Choose your preferred date and time</p>
    </div>
    <div class="how-step">
      <span>04</span>
      <h4 id="step4-title">Get Care</h4>
      <p id="step4-desc">Visit us and receive quality treatment</p>
    </div>
  </div>
</section>

<section class="cta">
  <div class="container">
    <h2 id="cta-h2">Ready to Book Your Appointment?</h2>
    <button class="cta-btn" id="cta-btn">Book Appointment Now</button>
  </div>
</section>
<br><br><br><br><br>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
// ====================== ترجمات صفحة الخدمات ======================
const servicesTranslations = {
  en: {
    heroBadge: "Our Services",
    heroH1: "Comprehensive <span>Healthcare Services</span>",
    heroP: "We offer a wide range of medical services delivered by experienced healthcare professionals using modern technology.",
    emBadge: "EMERGENCY CARE",
    emH2: "24/7 Emergency Services",
    emDesc: "Our emergency department is equipped to handle all medical emergencies with rapid response and expert care.",
    emCards: [
      { title: "24/7 Emergency", desc: "Round-the-clock emergency medical services" },
      { title: "Trauma Care", desc: "Specialized trauma and critical care units" },
      { title: "ICU Services", desc: "Intensive care with advanced monitoring" },
      { title: "Urgent Care", desc: "Walk-in urgent care for minor emergencies" }
    ],
    hotline: "Emergency Hotline",
    howH2: "Simple Appointment Process",
    steps: [
      { title: "Choose Service", desc: "Select the medical service you need" },
      { title: "Select Doctor", desc: "Pick from our qualified specialists" },
      { title: "Book Time", desc: "Choose your preferred date and time" },
      { title: "Get Care", desc: "Visit us and receive quality treatment" }
    ],
    ctaH2: "Ready to Book Your Appointment?",
    ctaBtn: "Book Appointment Now"
  },
  ar: {
    heroBadge: "خدماتنا",
    heroH1: "خدمات <span>رعاية صحية</span> شاملة",
    heroP: "نقدم مجموعة واسعة من الخدمات الطبية التي يقدمها خبراء الرعاية الصحية باستخدام أحدث التقنيات.",
    emBadge: "رعاية الطوارئ",
    emH2: "خدمات طوارئ على مدار الساعة",
    emDesc: "قسم الطوارئ لدينا مجهز للتعامل مع جميع الحالات الطارئة بسرعة استجابة فائقة ورعاية خبيرة.",
    emCards: [
      { title: "طوارئ 24/7", desc: "خدمات طبية طارئة على مدار الساعة" },
      { title: "رعاية الصدمات", desc: "وحدات متخصصة للصدمات والرعاية الحرجة" },
      { title: "العناية المركزة", desc: "رعاية مكثفة مع مراقبة متقدمة" },
      { title: "رعاية عاجلة", desc: "رعاية عاجلة للحالات الطارئة البسيطة" }
    ],
    hotline: "الخط الساخن للطوارئ",
    howH2: "خطوات حجز موعد بسيط",
    steps: [
      { title: "اختر الخدمة", desc: "اختر الخدمة الطبية التي تحتاجها" },
      { title: "اختر الطبيب", desc: "اختر من بين المتخصصين المؤهلين لدينا" },
      { title: "احجز الموعد", desc: "اختر التاريخ والوقت المفضل لديك" },
      { title: "احصل على الرعاية", desc: "قم بزيارتنا واحصل على علاج عالي الجودة" }
    ],
    ctaH2: "هل أنت مستعد لحجز موعدك؟",
    ctaBtn: "احجز موعدك الآن"
  }
};

// القاموس الفرعي المترجم لإعادة إنتاج اللائحة النقطية بالعربية مباشرة للبيانات
const dbServicesArabic = {
    "cardiology": { title: "أمراض القلب", list: ["جراحة القلب", "تأهيل القلب", "رسم القلب"] },
    "neurology": { title: "طب الأعصاب", list: ["اضطرابات الدماغ", "رعاية السكتة الدماغية", "فحص الأعصاب"] },
    "pediatrics": { title: "طب الأطفال", list: ["رعاية الطفل", "التطعيمات", "فحص النمو"] },
    "orthopedics": { title: "طب العظام", list: ["رعاية المفاصل", "الكسور", "العلاج الطبيعي"] },
    "ophthalmology": { title: "طب العيون", list: ["فحص العين", "جراحة الليزر", "رعاية الرؤية"] },
    "general medicine": { title: "الطب العام", list: ["فحص صحي", "التشخيص", "الاستشارات"] },
    "laboratory": { title: "المختبر", list: ["فحص الدم", "التحاليل", "الأحياء الدقيقة"] },
    "radiology": { title: "الأشعة", list: ["الأشعة السينية", "الأشعة المقطعية", "الرنين المغناطيسي"] }
};

(function() {
  try {
    const savedLang = localStorage.getItem('siteLang');
    window.currentLanguage = (savedLang === 'ar' || savedLang === 'en') ? savedLang : 'en';
  } catch(e) {
    window.currentLanguage = 'en';
  }
})();

window.applyPageTranslation = function(lang) {
  const t = servicesTranslations[lang];
  if (!t) return;

  document.getElementById('hero-badge').innerText = t.heroBadge;
  document.getElementById('hero-h1').innerHTML = t.heroH1;
  document.getElementById('hero-p').innerText = t.heroP;

  const serviceCards = document.querySelectorAll('#services-section .service-card');
  serviceCards.forEach((card) => {
    const enTitle = card.getAttribute('data-en-title') || '';
    const enDesc = card.getAttribute('data-en-desc') || '';
    const cleanKey = enTitle.toLowerCase().trim();

    const titleEl = card.querySelector('.service-title');
    const listContainer = card.querySelector('.service-list');

    if (lang === 'ar') {
        if (titleEl) titleEl.innerText = dbServicesArabic[cleanKey] ? dbServicesArabic[cleanKey].title : enTitle;
        
        if (listContainer) {
            listContainer.innerHTML = '';
            const items = dbServicesArabic[cleanKey] ? dbServicesArabic[cleanKey].list : enDesc.split(/[,;\n]+/);
            items.forEach(item => {
                if(item.trim() != '') listContainer.innerHTML += `<li>${item.trim()}</li>`;
            });
        }
    } else {
        if (titleEl) titleEl.innerText = enTitle;
        if (listContainer) {
            const defaultEnglishLists = {
                "cardiology": ["Heart Surgery", "Cardiac Rehab", "ECG"],
                "neurology": ["Brain Disorders", "Stroke Care", "Nerve Testing"],
                "pediatrics": ["Child Care", "Vaccination", "Growth Check"],
                "orthopedics": ["Joint Care", "Fractures", "Physiotherapy"],
                "ophthalmology": ["Eye Exam", "Laser Surgery", "Vision Care"],
                "general medicine": ["Health Check", "Diagnosis", "Consultation"],
                "laboratory": ["Blood Test", "Pathology", "Microbiology"],
                "radiology": ["X-Ray", "CT Scan", "MRI"]
            };
            
            listContainer.innerHTML = '';
            const items = defaultEnglishLists[cleanKey] ? defaultEnglishLists[cleanKey] : enDesc.split(/[,;\n]+/);
            items.forEach(item => {
                if(item.trim() != '') listContainer.innerHTML += `<li>${item.trim()}</li>`;
            });
        }
    }
  });

  document.getElementById('em-badge').innerText = t.emBadge;
  document.getElementById('em-h2').innerText = t.emH2;
  document.getElementById('em-desc').innerText = t.emDesc;
  for (let i = 1; i <= 4; i++) {
    const titleEl = document.getElementById(`em${i}-title`);
    const descEl = document.getElementById(`em${i}-desc`);
    if (titleEl) titleEl.innerText = t.emCards[i-1].title;
    if (descEl) descEl.innerText = t.emCards[i-1].desc;
  }
  document.getElementById('hotline-text').innerText = t.hotline;

  document.getElementById('how-h2').innerText = t.howH2;
  for (let i = 1; i <= 4; i++) {
    const titleEl = document.getElementById(`step${i}-title`);
    const descEl = document.getElementById(`step${i}-desc`);
    if (titleEl) titleEl.innerText = t.steps[i-1].title;
    if (descEl) descEl.innerText = t.steps[i-1].desc;
  }

  document.getElementById('cta-h2').innerText = t.ctaH2;
  document.getElementById('cta-btn').innerText = t.ctaBtn;
};

// ====================== GSAP Animations ======================
document.addEventListener('DOMContentLoaded', function() {
  const isMobile = window.innerWidth <= 768;
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (isMobile) {
    document.querySelector('.hero').classList.add('hero-no-anim');
  }

  if (prefersReduced) {
    document.querySelectorAll('.hero .badge, .hero h1, .hero p, .service-card, .em-card, .how-step, .cta-btn').forEach(function(el) {
      el.style.opacity = '1';
      el.style.transform = 'none';
    });
    const savedLangReduced = localStorage.getItem('siteLang');
    const langReduced = (savedLangReduced === 'ar' || savedLangReduced === 'en') ? savedLangReduced : 'en';
    window.applyPageTranslation(langReduced);
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  const savedLang = localStorage.getItem('siteLang');
  const langToApply = (savedLang === 'ar' || savedLang === 'en') ? savedLang : 'en';
  window.applyPageTranslation(langToApply);

  const heroBadge = document.querySelector('.hero .badge');
  const heroH1 = document.querySelector('.hero h1');
  const heroPara = document.querySelector('.hero p');

  if (!isMobile) {
    gsap.set([heroBadge, heroH1, heroPara], { opacity: 0, y: 40 });
    gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.8 } })
      .fromTo(heroBadge, { opacity: 0, scale: 0.9 }, { opacity: 1, scale: 1, duration: 0.5 })
      .fromTo(heroH1, { opacity: 0, y: 50, filter: 'blur(6px)' }, { opacity: 1, y: 0, filter: 'blur(0px)', duration: 0.7 }, '-=0.2')
      .fromTo(heroPara, { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.6 }, '-=0.3');
  }

  const serviceCards = gsap.utils.toArray('.service-card');
  gsap.set(serviceCards, { opacity: 0, y: 50 });
  ScrollTrigger.batch(serviceCards, {
    interval: 0.1,
    batchMax: 2,
    onEnter: (batch) => {
      gsap.to(batch, { opacity: 1, y: 0, duration: 0.7, ease: 'back.out(0.7)', stagger: 0.15, overwrite: true });
    },
    start: 'top 85%',
    toggleActions: 'play none none reverse'
  });

  const emCards = gsap.utils.toArray('.em-card');
  gsap.set(emCards, { opacity: 0, x: -40, rotationY: -15 });
  ScrollTrigger.batch(emCards, {
    interval: 0.12,
    onEnter: (batch) => { gsap.to(batch, { opacity: 1, x: 0, rotationY: 0, duration: 0.6, stagger: 0.1, ease: 'power2.out' }); },
    start: 'top 85%'
  });

  const howSteps = gsap.utils.toArray('.how-step');
  gsap.set(howSteps, { opacity: 0, scale: 0.8 });
  ScrollTrigger.batch(howSteps, {
    interval: 0.1,
    onEnter: (batch) => { gsap.to(batch, { opacity: 1, scale: 1, duration: 0.5, stagger: 0.12, ease: 'elastic.out(1, 0.4)' }); },
    start: 'top 85%'
  });

  const cta = document.querySelector('.cta-btn');
  gsap.set(cta, { opacity: 0, y: 40 });
  ScrollTrigger.create({
    trigger: '.cta',
    start: 'top 80%',
    onEnter: () => gsap.to(cta, { opacity: 1, y: 0, duration: 0.8, ease: 'back.out(1)' })
  });

  window.addEventListener('load', () => ScrollTrigger.refresh());
});
</script>
@endpush
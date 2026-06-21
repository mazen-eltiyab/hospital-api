{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'MediCare - Contact')

@push('styles')
<style>
/* ===== زر اللغة (كما هو) ===== */
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

/* ========== أنماط المحتوى الأساسية (بدون نافبار أو فوتر) ========== */
:root {
    --primary: #C9A24D;
    --primary-dark: #1F2A44;
    --dark: #1F2A44;
    --light-bg: #f9fafb;
    --text: #333333;
    --text-muted: #6b7280;
    --white: #ffffff;
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --ease-premium: cubic-bezier(0.25, 0.46, 0.45, 0.94);
    --ease-spring: cubic-bezier(0.68, -0.55, 0.265, 1.55);
    --ease-smooth: cubic-bezier(0.2, 0.9, 0.4, 1.1);
}

/* Hero Section */
.hero {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.92)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1353&q=80');
    background-size: cover;
    background-position: center;
    position: relative;
    will-change: transform;
}
.badge {
    display: inline-block;
    color: var(--primary);
    border-bottom: 2px solid var(--primary);
    font-size: 0.9rem;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 20px;
    padding-bottom: 5px;
}
.hero h1 {
    font-size: 2.8rem;
    margin-bottom: 20px;
    color: var(--dark);
    line-height: 1.2;
}
.highlight { color: var(--primary); }
.hero p {
    font-size: 1.1rem;
    color: var(--text-muted);
    max-width: 700px;
    margin: 0 auto 30px;
}

/* Emergency Bar */
.emergency-bar {
    background: #C9A24D;
    color: var(--white);
    text-align: center;
    padding: 12px;
    font-size: 0.9rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.emergency-bar i {
    animation: pulse 1.5s infinite;
}
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-bottom: 60px;
}

.card {
    background: var(--white);
    padding: 30px;
    border-radius: 12px;
    box-shadow: var(--shadow);
    text-align: center;
    cursor: pointer;
    transition: transform 0.4s var(--ease-premium), box-shadow 0.4s ease;
    will-change: transform;
}
.card:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 35px -12px rgba(201, 162, 77, 0.3);
}
.icon-box {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
    background: #1F2A44;
    color: #C9A24D;
    transition: all 0.3s var(--ease-spring);
}
.card:hover .icon-box {
    transform: scale(1.1) rotate(3deg);
    background: #C9A24D;
    color: white;
}
.card h3 { margin-bottom: 15px; color: var(--dark); }
.card p { color: var(--text-muted); font-size: 0.9rem; }

.main-content {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 40px;
}
@media (max-width: 992px) {
    .main-content { grid-template-columns: 1fr; }
}

.contact-form {
    background: var(--white);
    padding: 40px;
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    transition: transform 0.4s var(--ease-premium), box-shadow 0.4s ease;
}
.contact-form:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 30px -15px rgba(0,0,0,0.15);
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
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
    .form-row { grid-template-columns: 1fr; }
}
.input-group input,
.input-group select,
.input-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #f9fafb;
    transition: all 0.3s;
}
.input-group input:focus,
.input-group select:focus,
.input-group textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(201,162,77,0.2);
    transform: scale(1.01);
}
.submit-btn {
    width: 100%;
    background: var(--primary);
    color: var(--white);
    padding: 15px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s var(--ease-spring);
    font-size: 1rem;
    margin-top: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    position: relative;
    overflow: hidden;
}
.submit-btn::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255,255,255,0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.5s, height 0.5s;
}
.submit-btn:hover::after {
    width: 200%;
    height: 200%;
}
.submit-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 12px 20px -10px rgba(0,0,0,0.3);
}
.submit-btn:active { transform: translateY(1px); }

.map-mock {
    height: 250px;
    background: #e5e7eb;
    border-radius: 15px;
    position: relative;
    margin-bottom: 30px;
    overflow: hidden;
    background-size: cover;
    background-position: center;
    transition: transform 0.5s var(--ease-premium);
}
.map-mock:hover {
    transform: scale(1.02);
}
.map-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.9);
    padding: 15px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: var(--shadow-lg);
    backdrop-filter: blur(5px);
    transition: all 0.3s;
}
.map-mock:hover .map-overlay {
    background: white;
    box-shadow: 0 15px 25px -10px rgba(0,0,0,0.2);
}

.faq { margin-top: 30px; }
.faq-item {
    background: var(--white);
    padding: 18px;
    border-radius: 10px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: all 0.3s var(--ease-smooth);
    border-left: 4px solid transparent;
    transform: translateX(0);
}
.faq-item:hover {
    border-left-color: var(--primary);
    transform: translateX(6px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}
.faq-item.active {
    background: #fef9e6;
    border-left-color: var(--primary);
}
.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
}
.faq-question i { transition: transform 0.3s; }
.faq-item.active .faq-question i { transform: rotate(180deg); }
.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease-out;
    margin-top: 0;
    color: var(--text-muted);
    font-size: 0.9rem;
}
.faq-item.active .faq-answer {
    max-height: 200px;
    margin-top: 10px;
}
body[dir="rtl"] .faq-item {
    border-left: none;
    border-right: 4px solid transparent;
}
body[dir="rtl"] .faq-item:hover,
body[dir="rtl"] .faq-item.active {
    border-right-color: var(--primary);
    transform: translateX(-6px);
}

/* ========== أنماط أولية لأنيمشن GSAP ========== */
.hero .badge, .hero h1, .hero p,
.emergency-bar,
.card, .contact-form, .map-mock, .faq-item,
.submit-btn {
    opacity: 0;
    transform: translateY(40px);
}
</style>
@endpush

@section('content')
<section class="hero">
    <span class="badge" id="heroBadge">Get In Touch</span><br> <br> <br>
    <h1 id="heroTitle">We're Here to <span class="highlight">Help You</span></h1>
    <p id="heroDesc">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
</section>

<div class="emergency-bar">
    <i class="fas fa-phone-alt"></i>
    <span id="emergencyText">Emergency? Call our 24/7 emergency line:</span>
    <strong id="emergencyNumbers">911</strong> <span id="emergencyOr">or</span> <strong>+1 (555) 123-4567</strong>
</div>

<div class="container">
    <div class="info-grid">
        <div class="card"><div class="icon-box"><i class="fas fa-phone"></i></div><h3 id="cardPhoneTitle">Phone</h3><p id="cardPhoneDetails">+1 (555) 123-4567<br>+1 (555) 987-6543</p></div>
        <div class="card"><div class="icon-box"><i class="fas fa-envelope"></i></div><h3 id="cardEmailTitle">Email</h3><p id="cardEmailDetails">contact@medicare.com<br>support@medicare.com</p></div>
        <div class="card"><div class="icon-box"><i class="fas fa-map-marker-alt"></i></div><h3 id="cardLocationTitle">Location</h3><p id="cardLocationDetails">123 Medical Center Drive,<br>Healthcare City, HC 12345</p></div>
        <div class="card"><div class="icon-box"><i class="fas fa-clock"></i></div><h3 id="cardHoursTitle">Working Hours</h3><p id="cardHoursDetails">Mon - Fri: 8:00 AM - 8:00 PM<br>Sat - Sun: 9:00 AM - 5:00 PM</p></div>
    </div>

    <div class="main-content">
        <div class="contact-form">
            <h2 id="formTitle">Send us a Message</h2>
            <p class="subtitle" id="formSubtitle">Fill out the form and we'll be in touch soon.</p>
            
            <!-- تم إضافة معرف id للفورم لإمساكه بالجافاسكريبت -->
            <form action="{{ route('contact.store') }}" method="POST" id="ajaxContactForm">
                @csrf

                <!-- مكان ظهور رسائل النجاح أو الأخطاء عبر الأجاكس ديناميكياً -->
                <div id="formResponseStatus"></div>

                <div class="form-row">
                    <div class="input-group">
                        <label id="labelName">Full Name</label>
                        <input type="text" name="name" placeholder="John Doe" required>
                    </div>
                    <div class="input-group">
                        <label id="labelEmail">Email Address</label>
                        <input type="email" name="email" placeholder="john@example.com" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="input-group">
                        <label id="labelPhone">Phone Number</label>
                        <input type="text" name="phone" placeholder="+1 (555) 000-0000">
                    </div>
                    <div class="input-group">
                        <label id="labelDept">Department</label>
                        <select id="selectDept" name="department">
                            <option value="">Select Department</option>
                            @isset($services)
                                @foreach($services as $service)
                                    <option value="{{ $service->service_name }}">
                                        {{ $service->service_name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                
                <div class="input-group">
                    <label id="labelMessage">Message</label>
                    <textarea rows="4" name="message" placeholder="How can we help you?" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn" id="submitBtn"><i class="fas fa-paper-plane"></i> Send Message</button>
            </form>
        </div>

        <div class="sidebar">
            <div class="map-mock">
                <div class="map-overlay">
                    <i class="fas fa-hospital" style="color:#C9A24D; font-size:1.5rem;"></i>
                    <div><strong id="mapHospitalName">MediCare Hospital</strong><br><span id="mapAddress">123 Medical Center Drive</span></div>
                </div>
            </div>
            <div class="faq">
                <h3 id="faqTitle">Frequently Asked Questions</h3>
                <div class="faq-item active" id="faq1">
                    <div class="faq-question" id="faq1Q">How do I book an appointment? <i class="fas fa-chevron-down"></i></div>
                    <div class="faq-answer" id="faq1A">You can book online through our patient portal or call our desk.</div>
                </div>
                <div class="faq-item" id="faq2">
                    <div class="faq-question" id="faq2Q">What insurance do you accept? <i class="fas fa-chevron-down"></i></div>
                    <div class="faq-answer" id="faq2A">We accept most major insurance providers.</div>
                </div>
            </div>
        </div>
    </div>
</div>
<br> <br>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
// ====================== الترجمة (نفس الكود الأصلي مع تحسينات طفيفة) ======================
window.applyPageTranslation = function(lang) {
    const translations = {
        en: {
            heroBadge: "Get In Touch",
            heroTitle: "We're Here to <span class='highlight'>Help You</span>",
            heroDesc: "Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.",
            emergencyText: "Emergency? Call our 24/7 emergency line:",
            emergencyNumbers: "911",
            emergencyOr: "or",
            cardPhoneTitle: "Phone",
            cardPhoneDetails: "+1 (555) 123-4567<br>+1 (555) 987-6543",
            cardEmailTitle: "Email",
            cardEmailDetails: "contact@medicare.com<br>support@medicare.com",
            cardLocationTitle: "Location",
            cardLocationDetails: "123 Medical Center Drive,<br>Healthcare City, HC 12345",
            cardHoursTitle: "Working Hours",
            cardHoursDetails: "Mon - Fri: 8:00 AM - 8:00 PM<br>Sat - Sun: 9:00 AM - 5:00 PM",
            formTitle: "Send us a Message",
            formSubtitle: "Fill out the form and we'll be in touch soon.",
            labelName: "Full Name",
            labelEmail: "Email Address",
            labelPhone: "Phone Number",
            labelDept: "Department",
            deptDefault: "Select Department",
            labelMessage: "Message",
            submitBtn: "Send Message",
            mapHospitalName: "MediCare Hospital",
            mapAddress: "123 Medical Center Drive",
            faqTitle: "Frequently Asked Questions",
            faq1Q: "How do I book an appointment?",
            faq1A: "You can book online through our patient portal or call our desk.",
            faq2Q: "What insurance do you accept?",
            faq2A: "We accept most major insurance providers."
        },
        ar: {
            heroBadge: "تواصل معنا",
            heroTitle: "نحن هنا <span class='highlight'>لمساعدتك</span>",
            heroDesc: "لديك أسئلة؟ يسعدنا التواصل معك. أرسل لنا رسالة وسنرد في أقرب وقت ممكن.",
            emergencyText: "طوارئ؟ اتصل بخط الطوارئ على مدار الساعة:",
            emergencyNumbers: "٩١١",
            emergencyOr: "أو",
            cardPhoneTitle: "الهاتف",
            cardPhoneDetails: "+1 (555) 123-4567<br>+1 (555) 987-6543",
            cardEmailTitle: "البريد الإلكتروني",
            cardEmailDetails: "contact@medicare.com<br>support@medicare.com",
            cardLocationTitle: "الموقع",
            cardLocationDetails: "١٢٣ شارع المركز الطبي،<br>المدينة الصحية، ر ع ١٢٣٤٥",
            cardHoursTitle: "ساعات العمل",
            cardHoursDetails: "الاثنين - الجمعة: ٨ ص - ٨ م<br>السبت - الأحد: ٩ ص - ٥ م",
            formTitle: "أرسل لنا رسالة",
            formSubtitle: "املأ النموذج وسنتواصل معك قريباً.",
            labelName: "الاسم الكامل",
            labelEmail: "البريد الإلكتروني",
            labelPhone: "رقم الهاتف",
            labelDept: "القسم",
            deptDefault: "اختر القسم",
            labelMessage: "الالرسالة",
            submitBtn: "إرسال الرسالة",
            mapHospitalName: "مستشفى ميدي كير",
            mapAddress: "١٢٣ شارع المركز الطبي",
            faqTitle: "الأسئلة الشائعة",
            faq1Q: "كيف يمكنني حجز موعد؟",
            faq1A: "يمكنك الحجز عبر الإنترنت من خلال بوابة المرضى أو الاتصال بمكتب الاستقبال.",
            faq2Q: "ما هو التأمين الذي تقبلونه؟",
            faq2A: "نحن نقبل معظم مزودي التأمين الرئيسيين."
        }
    };
    const t = translations[lang];
    if (!t) return;
    const setText = (id, txt) => { const el = document.getElementById(id); if (el) el.innerText = txt; };
    const setHtml = (id, html) => { const el = document.getElementById(id); if (el) el.innerHTML = html; };
    setText('heroBadge', t.heroBadge);
    setHtml('heroTitle', t.heroTitle);
    setText('heroDesc', t.heroDesc);
    setText('emergencyText', t.emergencyText);
    setText('emergencyNumbers', t.emergencyNumbers);
    setText('emergencyOr', t.emergencyOr);
    setText('cardPhoneTitle', t.cardPhoneTitle);
    setHtml('cardPhoneDetails', t.cardPhoneDetails);
    setText('cardEmailTitle', t.cardEmailTitle);
    setHtml('cardEmailDetails', t.cardEmailDetails);
    setText('cardLocationTitle', t.cardLocationTitle);
    setHtml('cardLocationDetails', t.cardLocationDetails);
    setText('cardHoursTitle', t.cardHoursTitle);
    setHtml('cardHoursDetails', t.cardHoursDetails);
    setText('formTitle', t.formTitle);
    setText('formSubtitle', t.formSubtitle);
    setText('labelName', t.labelName);
    setText('labelEmail', t.labelEmail);
    setText('labelPhone', t.labelPhone);
    setText('labelDept', t.labelDept);
    const deptSelect = document.getElementById('selectDept');
    if (deptSelect && deptSelect.options[0]) deptSelect.options[0].text = t.deptDefault;
    setText('labelMessage', t.labelMessage);
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) submitBtn.innerHTML = `<i class="fas fa-paper-plane"></i> ${t.submitBtn}`;
    setText('mapHospitalName', t.mapHospitalName);
    setText('mapAddress', t.mapAddress);
    setText('faqTitle', t.faqTitle);
    setText('faq1Q', t.faq1Q);
    setText('faq1A', t.faq1A);
    setText('faq2Q', t.faq2Q);
    setText('faq2A', t.faq2A);
};

// ====================== إرسال الفورم بواسطة AJAX (بدون ريفريش) ======================
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ajaxContactForm');
    const responseDiv = document.getElementById('formResponseStatus');
    const submitButton = document.getElementById('submitBtn');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // مـنع الريفريش نهائياً 🛑

            // تحويل الزر لحالة التحميل
            const isAr = window.currentLanguage === 'ar';
            submitButton.disabled = true;
            submitButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${isAr ? 'جاري الإرسال...' : 'Sending...'}`;

            // تجهيز البيانات المتواجدة داخل الحقول
            const formData = new FormData(form);

            // إرسال الطلب للخلفية عبر Fetch API
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                // تصفير زر الإرسال وإعادته لطبيعته
                submitButton.disabled = false;
                submitButton.innerHTML = `<i class="fas fa-paper-plane"></i> ${isAr ? 'إرسال الرسالة' : 'Send Message'}`;

                if (response.ok) {
                    // عرض رسالة نجاح مبهجة ومتحركة تتبع لغة الموقع الحالية
                    responseDiv.innerHTML = `
                        <div style="background-color: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #c3e6cb; font-size: 0.9rem;">
                            <i class="fas fa-check-circle"></i> ${isAr ? 'شكراً لك! تم إرسال رسالتك بنجاح دون أي مشاكل.' : 'Thank you! Your message has been sent successfully.'}
                        </div>
                    `;
                    form.reset(); // تفريغ حقول الفورم بعد النجاح ✨
                    
                    // أنيمشن خفيفة لظهور رسالة النجاح
                    gsap.fromTo(responseDiv, { opacity: 0, scale: 0.9 }, { opacity: 1, scale: 1, duration: 0.4 });
                } else {
                    // عرض رسالة خطأ في حال حدوث مشكلة بالسيرفر
                    responseDiv.innerHTML = `
                        <div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb; font-size: 0.9rem;">
                            <i class="fas fa-exclamation-circle"></i> ${isAr ? 'حدث خطأ ما، يرجى التأكد من ملء الحقول المطلوبة.' : 'Something went wrong. Please check your inputs.'}
                        </div>
                    `;
                }
            })
            .catch(error => {
                submitButton.disabled = false;
                submitButton.innerHTML = `<i class="fas fa-paper-plane"></i> ${isAr ? 'إرسال الرسالة' : 'Send Message'}`;
                responseDiv.innerHTML = `
                    <div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb; font-size: 0.9rem;">
                        <i class="fas fa-wifi"></i> ${isAr ? 'مشكلة في الاتصال بالسيرفر.' : 'Network error occurred.'}
                    </div>
                `;
            });
        });
    }
});

// ====================== أنيمشن GSAP فائقة الاحترافية ======================
document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);
    
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        gsap.set([".hero .badge", ".hero h1", ".hero p", ".emergency-bar", ".card", ".contact-form", ".map-mock", ".faq-item", ".submit-btn"], { opacity: 1, y: 0 });
        return;
    }
    
    if (typeof window.currentLanguage !== 'undefined') window.applyPageTranslation(window.currentLanguage);
    else window.applyPageTranslation('en');
    
    const heroBadge = document.querySelector(".hero .badge");
    const heroTitle = document.querySelector(".hero h1");
    const heroPara = document.querySelector(".hero p");
    const emergencyBar = document.querySelector(".emergency-bar");
    
    gsap.set([heroBadge, heroTitle, heroPara, emergencyBar], { opacity: 0, y: 40 });
    const tlHero = gsap.timeline({ defaults: { ease: "power3.out", duration: 0.8 } });
    tlHero.fromTo(heroBadge, { opacity: 0, scale: 0.9 }, { opacity: 1, scale: 1, duration: 0.5 })
          .fromTo(heroTitle, { opacity: 0, y: 50, filter: "blur(6px)" }, { opacity: 1, y: 0, filter: "blur(0px)", duration: 0.7 }, "-=0.2")
          .fromTo(heroPara, { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.6 }, "-=0.3")
          .fromTo(emergencyBar, { opacity: 0, y: -30 }, { opacity: 1, y: 0, duration: 0.5 }, "-=0.2");
    
    gsap.to(".hero", {
        backgroundPosition: "50% 60%",
        ease: "none",
        scrollTrigger: {
            trigger: ".hero",
            start: "top top",
            end: "bottom top",
            scrub: 0.8
        }
    });
    
    const cards = gsap.utils.toArray(".card");
    gsap.set(cards, { opacity: 0, y: 40 });
    ScrollTrigger.batch(cards, {
        interval: 0.1,
        batchMax: 2,
        onEnter: (batch) => {
            gsap.to(batch, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "back.out(0.7)",
                stagger: 0.15,
                overwrite: true
            });
        },
        start: "top 85%",
        toggleActions: "play none none reverse"
    });
    
    cards.forEach((card, i) => {
        gsap.to(card, {
            y: -6,
            duration: 2.5,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut",
            delay: i * 0.1
        });
    });
    
    const contactForm = document.querySelector(".contact-form");
    gsap.set(contactForm, { opacity: 0, y: 40 });
    ScrollTrigger.create({
        trigger: contactForm,
        start: "top 85%",
        onEnter: () => gsap.to(contactForm, { opacity: 1, y: 0, duration: 0.7, ease: "power2.out" })
    });
    
    const mapMock = document.querySelector(".map-mock");
    gsap.set(mapMock, { opacity: 0, scale: 0.92 });
    ScrollTrigger.create({
        trigger: mapMock,
        start: "top 85%",
        onEnter: () => gsap.to(mapMock, { opacity: 1, scale: 1, duration: 0.6, ease: "back.out(0.6)" })
    });
    
    const faqItems = gsap.utils.toArray(".faq-item");
    gsap.set(faqItems, { opacity: 0, x: -30 });
    ScrollTrigger.batch(faqItems, {
        interval: 0.15,
        onEnter: (batch) => {
            gsap.to(batch, { opacity: 1, x: 0, duration: 0.5, stagger: 0.1, ease: "power2.out" });
        },
        start: "top 85%"
    });
    
    const submitBtn = document.querySelector(".submit-btn");
    gsap.set(submitBtn, { opacity: 0, y: 30 });
    ScrollTrigger.create({
        trigger: contactForm,
        start: "top 80%",
        onEnter: () => gsap.to(submitBtn, { opacity: 1, y: 0, duration: 0.5, delay: 0.2 })
    });
    
    submitBtn.addEventListener("mousemove", (e) => {
        const rect = submitBtn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width/2;
        const y = e.clientY - rect.top - rect.height/2;
        gsap.to(submitBtn, { duration: 0.3, x: x * 0.15, y: y * 0.15, ease: "power2.out" });
    });
    submitBtn.addEventListener("mouseleave", () => {
        gsap.to(submitBtn, { duration: 0.4, x: 0, y: 0, ease: "elastic.out(1, 0.3)" });
    });
    
    faqItems.forEach(item => {
        item.addEventListener("mouseenter", () => gsap.to(item, { duration: 0.2, scale: 1.02, ease: "power1.out" }));
        item.addEventListener("mouseleave", () => gsap.to(item, { duration: 0.3, scale: 1, ease: "elastic.out(1,0.3)" }));
    });
    
    window.addEventListener('load', () => ScrollTrigger.refresh());
    
    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelectorAll('.faq-item').forEach(other => {
                if (other !== this && other.classList.contains('active')) other.classList.remove('active');
            });
            this.classList.toggle('active');
            ScrollTrigger.refresh();
        });
    });
});

(function() {
    try {
        const savedLang = localStorage.getItem('siteLang');
        if (savedLang === 'ar' || savedLang === 'en') {
            window.currentLanguage = savedLang;
            if (typeof window.applyPageTranslation === 'function') {
                window.applyPageTranslation(savedLang);
            }
        } else {
            window.currentLanguage = 'en';
            if (typeof window.applyPageTranslation === 'function') {
                window.applyPageTranslation('en');
            }
        }
    } catch(e) { window.currentLanguage = 'en'; }
})();
</script>
@endpush
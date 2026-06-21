{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'MediCare - Home')

@push('styles')
<style>
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
  
        /* ===========================
            GENERAL STYLES
        =========================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #1F2A44;
            background-color: #FFFFFF;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 20px;
        }

        a { text-decoration: none; transition: 0.3s; }
        ul { list-style: none; }
        img { max-width: 100%; height: auto; display: block; }

        

        /* ===========================
            HERO SECTION
        =========================== */
        .hero-start {
            padding: 80px 0;
            background-color: #ECECEC;
        }

        .hero-container {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .hero-text { flex: 1; }
        .hero-image { flex: 1; text-align: right; }
        .hero-image img { border-radius: 20px; box-shadow: 20px 30px 6px rgba(31, 42, 68, 0.05); display: inline-block; }

        .trusted-tag {
            background: #F5F0D6;
            color: #C9A24D;
            border-radius: 30px;
            display: inline-block;
            font-size: 14px;
            padding: 5px 15px;
            margin-bottom: 20px;
        }

        .hero-text h1 { font-size: 43px; line-height: 1.1; margin-bottom: 20px; }
        .highlight { color: #C9A24D; }

        .hero-btns { display: flex; gap: 20px; margin-top: 30px; }
        .btn-book { background: #C9A24D; color: #fff; border: none; padding: 15px 30px; border-radius: 8px; cursor: pointer; font-weight: bold; }
        .btn-video { background: white; border: 1px solid #ddd; padding: 15px 30px; border-radius: 8px; cursor: pointer; color: #1F2A44; }

        /* ===========================
            STATS SECTION
        =========================== */
        .stats {
            display: flex;
            justify-content: space-around;
            padding: 60px 0;
            background: #fff;
            text-align: center;
        }

        .stats h3 { font-size: 36px; color: #C9A24D; margin-bottom: 5px; font-weight: bold; }

        /* ===========================
            SERVICES SECTION
        =========================== */
        .services { padding: 80px 0; background-color: #ECECEC; text-align: center; }
        .services h2 { font-size: 30px; margin-bottom: 10px; }
        .services > p { margin-bottom: 50px; color: #666; }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .card { background: #fff; border-radius: 12px; overflow: hidden; transition: 0.3s; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .card:hover { transform: translateY(-10px); }
        .card-image { height: 220px; overflow: hidden; }
        .card-image img { width: 100%; height: 100%; object-fit: cover; }
        .card-content { padding: 25px; text-align: left; }
        .card-content h4 { margin-bottom: 10px; font-size: 20px; color: #1F2A44; }
        .card-content p { font-size: 14px; color: #555; }
        .learn-more { color: #C9A24D; font-weight: bold; display: inline-block; margin-top: 15px; }

        /* ===========================
            WHY CHOOSE US
        =========================== */
        .why-choose-us { padding: 80px 0; background: #fff; }
        .why-container { display: flex; align-items: center; gap: 50px; }
        .why-content { flex: 1; }
        .why-image { flex: 1; position: relative; }
        .why-image img { border-radius: 20px; width: 100%; }
        .sup-why { color: #C9A24D; font-weight: bold; font-size: 14px; display: block; margin-bottom: 10px; }

        .features-list { margin-top: 30px; }
        .features-item { display: flex; gap: 15px; margin-bottom: 25px; align-items: flex-start; }
        .features-icon i { color: #C9A24D; font-size: 24px; background: #F5F0D6; padding: 10px; border-radius: 8px; }
        .features-text h4 { margin-bottom: 5px; color: #1F2A44; }

        /* ===========================
            TESTIMONIALS
        =========================== */
        .testimonials-section { background: #1F2A44; color: #fff; padding: 80px 0; }
        .testimonials-header { text-align: center; margin-bottom: 60px; }
        .testimonials-header h2 { font-size: 36px; margin: 15px 0; }
        .badge { background: rgba(201,162,77,0.2); color: #C9A24D; padding: 5px 15px; border-radius: 20px; font-size: 14px; }

        .testimonials-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }
        .testimonial-card { background: rgba(255,255,255,0.05); padding: 30px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.1); text-align: left; }
        .stars { color: #C9A24D; margin-bottom: 15px; }
        .testimonial-text { font-style: italic; color: #ddd; margin-bottom: 25px; }
        .patient-info { display: flex; align-items: center; gap: 15px; }
        .patient-info img { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
        .patient-details h4 { font-size: 17px; margin: 0; }
        .patient-details span { font-size: 13px; color: #C9A24D; }

        /* ===========================
            CTA (GET STARTED)
        =========================== */
        .get-started { padding: 80px 0; background: #ECECEC; }
        .cta-box { background: linear-gradient(135deg, #1F2A44 0%, #C9A24D 100%); padding: 60px; border-radius: 20px; color: #fff; text-align: center; }
        .cta-box h2 { font-size: 32px; margin-bottom: 20px; }
        .cta-btns { margin-top: 30px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        .btn-white { background: #fff; color: #1F2A44; padding: 12px 30px; border-radius: 8px; font-weight: bold; }
        .btn-outline { border: 1px solid #fff; color: #fff; padding: 12px 30px; border-radius: 8px; }

       

        /* ===========================
            RESPONSIVE MEDIA QUERIES
        =========================== */
        @media (max-width: 992px) {
            .hero-container, .why-container { flex-direction: column; text-align: center; }
            .hero-btns, .cta-btns { justify-content: center; }
            .hero-text h1 { font-size: 36px; }
            .stats { flex-wrap: wrap; }
            .stat-item { width: 50%; margin-bottom: 30px; }
            .hero-image, .why-image { text-align: center; }
        }

      

       
        
        

        /* ===== ABOUT ===== */
        .about-section { padding: 80px 0; background: #fff; }
        .about-section .section-label { color: #C9A24D; font-size: 13px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; display: block; margin-bottom: 12px; }
        .about-section h2 { font-size: 2rem; color: #1a2e44; margin-bottom: 16px; font-weight: 700; }
        .about-section .lead-desc { color: #6b7a8d; font-size: 1rem; line-height: 1.8; margin-bottom: 32px; }
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
        .about-images { position: relative; display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: auto auto; gap: 14px; }
        .about-images .img-main { grid-column: 1 / -1; border-radius: 16px; overflow: hidden; position: relative; }
        .about-images .img-main img { width: 100%; height: 260px; object-fit: cover; display: block; }
        .about-images .img-badge { position: absolute; bottom: 16px; left: 16px; background: #C9A24D; color: #fff; padding: 8px 16px; border-radius: 30px; font-size: 13px; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .about-images .img-small { border-radius: 12px; overflow: hidden; }
        .about-images .img-small img { width: 100%; height: 140px; object-fit: cover; display: block; transition: transform 0.3s; }
        .about-images .img-small img:hover { transform: scale(1.04); }
        .about-content .highlight-box { display: flex; gap: 16px; background: #f8f6f1; border-left: 4px solid #C9A24D; border-radius: 12px; padding: 20px; margin-bottom: 28px; }
        body[dir="rtl"] .about-content .highlight-box { border-left: none; border-right: 4px solid #C9A24D; }
        .highlight-box .hi-icon { width: 48px; height: 48px; min-width: 48px; background: #C9A24D; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; }
        .highlight-box .hi-text h4 { color: #1a2e44; font-size: 1rem; font-weight: 700; margin-bottom: 6px; }
        .highlight-box .hi-text p { color: #6b7a8d; font-size: 0.9rem; line-height: 1.6; margin: 0; }
        .about-checklist { list-style: none; padding: 0; margin: 0 0 28px; display: flex; flex-direction: column; gap: 12px; }
        .about-checklist li { display: flex; align-items: center; gap: 12px; color: #3a4a5c; font-size: 0.95rem; }
        .about-checklist li i { color: #C9A24D; font-size: 16px; min-width: 18px; }
        .about-metrics { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 32px; }
        .metric-box { background: #f8f6f1; border-radius: 12px; padding: 18px 16px; text-align: center; }
        .metric-box .metric-num { font-size: 1.8rem; font-weight: 800; color: #C9A24D; display: block; }
        .metric-box .metric-label { font-size: 0.82rem; color: #6b7a8d; margin-top: 4px; }
        .about-actions { display: flex; gap: 14px; flex-wrap: wrap; }
        .btn-explore { background: #C9A24D; color: #fff; padding: 12px 26px; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: background 0.3s; }
        .btn-explore:hover { background: #b8912e; color: #fff; }
        .btn-consult { background: transparent; color: #C9A24D; padding: 12px 26px; border-radius: 30px; border: 2px solid #C9A24D; text-decoration: none; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; transition: all 0.3s; }
        .btn-consult:hover { background: #C9A24D; color: #fff; }

        /* ===== DEPARTMENTS ===== */
        .departments-section { padding: 80px 0; background: #f8f9fb; }
        .departments-section h2 { text-align: center; font-size: 2rem; color: #1a2e44; font-weight: 700; margin-bottom: 10px; }
        .departments-section .sub { text-align: center; color: #6b7a8d; margin-bottom: 50px; }
        .dept-featured { background: #fff; border-radius: 20px; overflow: hidden; display: grid; grid-template-columns: 1fr 1fr; margin-bottom: 40px; box-shadow: 0 4px 30px rgba(0,0,0,0.07); }
        .dept-featured-img { position: relative; min-height: 300px; }
        .dept-featured-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .dept-featured-content { padding: 48px 40px; }
        .dept-category { color: #C9A24D; font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; display: block; margin-bottom: 12px; }
        .dept-featured-content h2 { font-size: 1.5rem; color: #1a2e44; font-weight: 700; margin-bottom: 14px; text-align: left; }
        .dept-featured-content p { color: #6b7a8d; line-height: 1.7; margin-bottom: 24px; }
        .dept-feat-list { list-style: none; padding: 0; margin: 0 0 28px; display: flex; flex-direction: column; gap: 10px; }
        .dept-feat-list li { display: flex; align-items: center; gap: 10px; color: #3a4a5c; font-size: 0.9rem; }
        .dept-feat-list li i { color: #C9A24D; }
        .dept-learn-link { color: #C9A24D; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: gap 0.2s; }
        .dept-learn-link:hover { gap: 14px; }
        .depts-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 40px; }
        .dept-card { background: #fff; border-radius: 16px; padding: 28px 24px; box-shadow: 0 2px 20px rgba(0,0,0,0.06); transition: transform 0.3s, box-shadow 0.3s; }
        .dept-card:hover { transform: translateY(-6px); box-shadow: 0 10px 40px rgba(201,162,77,0.15); }
        .dept-card .dept-icon { width: 52px; height: 52px; background: #fff7e6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; color: #C9A24D; margin-bottom: 16px; }
        .dept-card h3 { font-size: 1.05rem; color: #1a2e44; font-weight: 700; margin-bottom: 8px; }
        .dept-card p { color: #6b7a8d; font-size: 0.88rem; line-height: 1.6; margin-bottom: 18px; }
        .dept-card-stats { display: flex; gap: 20px; border-top: 1px solid #f0ece4; padding-top: 14px; }
        .dept-card-stats .ds { display: flex; flex-direction: column; }
        .dept-card-stats .ds-num { font-size: 1.1rem; font-weight: 800; color: #C9A24D; }
        .dept-card-stats .ds-label { font-size: 0.78rem; color: #6b7a8d; }
        .depts-cta { background: linear-gradient(135deg, #1a2e44 0%, #243f5c 100%); border-radius: 20px; padding: 48px 40px; display: flex; align-items: center; justify-content: space-between; gap: 32px; flex-wrap: wrap; }
        .depts-cta h3 { color: #fff; font-size: 1.4rem; font-weight: 700; margin-bottom: 8px; }
        .depts-cta p { color: #8fa8c4; margin: 0; font-size: 0.95rem; }
        .btn-depts { background: #C9A24D; color: #fff; padding: 14px 32px; border-radius: 30px; text-decoration: none; font-weight: 700; white-space: nowrap; transition: background 0.3s; }
        .btn-depts:hover { background: #b8912e; color: #fff; }

        /* ===== FIND A DOCTOR ===== */
        .find-doctor-section { padding: 80px 0; background: #fff; }
        .find-doctor-section h2 { text-align: center; font-size: 2rem; color: #1a2e44; font-weight: 700; margin-bottom: 10px; }
        .find-doctor-section .sub { text-align: center; color: #6b7a8d; margin-bottom: 40px; }
        .search-box { background: #f8f9fb; border-radius: 16px; padding: 28px 32px; margin-bottom: 48px; display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end; }
        .search-field { display: flex; flex-direction: column; gap: 6px; flex: 1; min-width: 180px; }
        .search-field label { font-size: 12px; font-weight: 700; color: #6b7a8d; text-transform: uppercase; letter-spacing: 1px; }
        .search-field .input-wrap { position: relative; }
        .search-field .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #C9A24D; font-size: 14px; }
        body[dir="rtl"] .search-field .input-wrap i { left: auto; right: 14px; }
        .search-field input, .search-field select { width: 100%; padding: 11px 16px 11px 40px; border: 1.5px solid #e8e4da; border-radius: 10px; font-size: 0.9rem; color: #1a2e44; background: #fff; transition: border 0.2s; box-sizing: border-box; }
        body[dir="rtl"] .search-field input, body[dir="rtl"] .search-field select { padding: 11px 40px 11px 16px; }
        .search-field input:focus, .search-field select:focus { outline: none; border-color: #C9A24D; }
        .btn-search { background: #C9A24D; color: #fff; border: none; padding: 12px 28px; border-radius: 10px; font-size: 0.95rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.3s; min-height: 46px; align-self: flex-end; }
        .btn-search:hover { background: #b8912e; }
        .doctors-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 40px; }
        .doctor-card { background: #fff; border: 1.5px solid #f0ece4; border-radius: 16px; padding: 24px; transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s; }
        .doctor-card:hover { transform: translateY(-4px); box-shadow: 0 10px 40px rgba(201,162,77,0.12); border-color: #C9A24D; }
        .doctor-card.featured-doc { border-color: #C9A24D; background: #fffdf6; }
        .doctor-profile { display: flex; gap: 14px; align-items: center; margin-bottom: 16px; }
        .doc-img-wrap { position: relative; min-width: 60px; }
        .doc-img-wrap img { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #f0ece4; }
        .doc-status { position: absolute; bottom: 2px; right: 2px; width: 13px; height: 13px; border-radius: 50%; border: 2px solid #fff; }
        .doc-status.active { background: #22c55e; }
        .doc-status.busy { background: #f59e0b; }
        .doc-status.offline { background: #94a3b8; }
        .doc-info h3 { font-size: 1rem; color: #1a2e44; font-weight: 700; margin: 0 0 4px; }
        .doc-specialty { color: #C9A24D; font-size: 0.82rem; font-weight: 600; margin: 0 0 6px; }
        .doc-badges { display: flex; gap: 6px; flex-wrap: wrap; }
        .doc-badge { background: #f8f6f1; color: #8a6d2e; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
        .doc-exp { background: #e8f0f8; color: #1a5fa0; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
        .doc-rating { display: flex; align-items: center; gap: 8px; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #f0ece4; }
        .doc-stars { display: flex; gap: 2px; }
        .doc-stars i { color: #C9A24D; font-size: 12px; }
        .doc-score { font-weight: 800; color: #1a2e44; font-size: 0.95rem; }
        .doc-reviews { color: #6b7a8d; font-size: 0.82rem; }
        .doc-actions { display: flex; gap: 10px; }
        .doc-btn { flex: 1; padding: 9px 0; border-radius: 8px; font-size: 0.85rem; font-weight: 700; text-align: center; text-decoration: none; cursor: pointer; border: none; transition: all 0.2s; }
        .doc-btn.outline { background: #fff; color: #C9A24D; border: 1.5px solid #C9A24D; }
        .doc-btn.outline:hover { background: #fff7e6; }
        .doc-btn.primary { background: #C9A24D; color: #fff; }
        .doc-btn.primary:hover { background: #b8912e; }
        .find-doctor-cta { text-align: center; }
        .btn-browse { display: inline-flex; align-items: center; gap: 8px; color: #C9A24D; font-weight: 700; text-decoration: none; font-size: 1rem; border-bottom: 2px solid transparent; transition: border-color 0.2s; }
        .btn-browse:hover { border-color: #C9A24D; }

        /* ---------- RESPONSIVE ENHANCEMENTS (like about page) ---------- */
        @media (max-width: 992px) {
            .hero-container, .why-container, .about-grid, .dept-featured, .depts-grid, .doctors-grid { grid-template-columns: 1fr; flex-direction: column; text-align: center; }
            .hero-btns, .cta-btns { justify-content: center; }
            .hero-text h1 { font-size: 36px; }
            .stats { flex-wrap: wrap; }
            .stat-item { width: 50%; margin-bottom: 30px; }
            .hero-image, .why-image { text-align: center; }
            .about-images .img-main { grid-column: 1; }
            .dept-featured-content h2 { text-align: center; }
            .search-box { flex-direction: column; align-items: stretch; }
            .btn-search { align-self: stretch; justify-content: center; }
            .doctors-grid { gap: 20px; }
            .depts-grid { gap: 20px; }
            .dept-featured { grid-template-columns: 1fr; }
            .dept-featured-img { min-height: 250px; }
            .dept-featured-content { padding: 32px 24px; text-align: center; }
            .dept-feat-list { align-items: center; }
            .depts-cta { flex-direction: column; text-align: center; }
        }

        @media (max-width: 768px) {
            /* Navigation (matching about page) */
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

            /* Page specific adjustments */
            .hero-start { padding: 50px 0; }
            .hero-text h1 { font-size: 30px; }
            .hero-btns { flex-direction: column; gap: 15px; align-items: center; }
            .btn-book, .btn-video { width: 80%; max-width: 260px; text-align: center; }
            .stats { padding: 40px 0; }
            .stat-item { width: 100%; margin-bottom: 25px; }
            .stats h3 { font-size: 30px; }
            .services, .why-choose-us, .departments-section, .find-doctor-section, .testimonials-section, .get-started { padding: 60px 0; }
            .services h2, .departments-section h2, .find-doctor-section h2, .testimonials-header h2 { font-size: 28px; }
            .cards, .depts-grid, .doctors-grid { grid-template-columns: 1fr; gap: 20px; }
            .card .card-content { padding: 20px; }
            .about-section { padding: 60px 0; }
            .about-grid { gap: 30px; }
            .about-images .img-main img { height: 200px; }
            .about-images .img-small img { height: 120px; }
            .about-content h2 { font-size: 28px; }
            .highlight-box { flex-direction: column; align-items: center; text-align: center; }
            .about-actions { flex-direction: column; align-items: center; gap: 12px; }
            .btn-explore, .btn-consult { width: 100%; text-align: center; justify-content: center; }
            .why-container { gap: 30px; }
            .features-item { flex-direction: column; align-items: center; text-align: center; }
            .features-icon i { margin-bottom: 10px; }
            .testimonials-cards { grid-template-columns: 1fr; }
            .cta-box { padding: 40px 20px; }
            .cta-box h2 { font-size: 28px; }
            .cta-btns { flex-direction: column; align-items: center; gap: 15px; }
            .btn-white, .btn-outline { width: 80%; max-width: 260px; text-align: center; }
            .dept-featured-content { padding: 24px; }
            .dept-card { padding: 20px; text-align: center; }
            .dept-card .dept-icon { margin: 0 auto 16px; }
            .dept-card-stats { justify-content: center; }
            .search-box { padding: 20px; }
            .search-field { min-width: 100%; }
            .doctor-card { padding: 20px; }
            .doctor-profile { flex-direction: column; text-align: center; }
            .doc-rating { justify-content: center; }
            .doc-actions { flex-direction: column; gap: 8px; }
        }

        @media (max-width: 480px) {
            .container { padding: 0 16px; }
            .hero-text h1 { font-size: 26px; }
            .trusted-tag { font-size: 12px; }
            .hero-btns .btn-book, .hero-btns .btn-video { width: 100%; max-width: none; }
            .stats h3 { font-size: 28px; }
            .services h2, .departments-section h2, .find-doctor-section h2, .testimonials-header h2, .about-content h2, .cta-box h2 { font-size: 24px; }
            .section-label, .sup-why, .badge { font-size: 12px; }
            .card-content h4 { font-size: 18px; }
            .about-images .img-badge { font-size: 11px; padding: 4px 12px; bottom: 8px; left: 8px; }
            .metric-box .metric-num { font-size: 1.5rem; }
            .dept-featured-content h2 { font-size: 1.3rem; }
            .btn-search, .btn-explore, .btn-consult { font-size: 0.85rem; padding: 10px 20px; }
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
</style>

{{-- ═══════════════════════════════════════════
     ANIMATION ENHANCEMENT LAYER (unchanged)
     ═══════════════════════════════════════════ --}}
<style>
/* ============================================================
   ANIMATION TOKENS
   ============================================================ */
:root {
  --ease-smooth: cubic-bezier(0.25, 0.46, 0.45, 0.94);
  --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
  --ease-sharp:  cubic-bezier(0.22, 1, 0.36, 1);
  --dur-fast:    0.3s;
  --dur-base:    0.55s;
  --dur-slow:    0.8s;
  --dur-enter:   1s;
}

/* ============================================================
   SCROLL REVEAL — base state (hidden)
   ============================================================ */
.sr {
  opacity: 0;
  transform: translateY(32px);
  transition: opacity var(--dur-slow) var(--ease-smooth),
              transform var(--dur-slow) var(--ease-smooth);
}
.sr.sr-left  { transform: translateX(-40px); }
.sr.sr-right { transform: translateX(40px);  }
.sr.sr-scale { transform: scale(0.92) translateY(20px); }
.sr.sr-up    { transform: translateY(48px); }
.sr.visible  { opacity: 1; transform: translate(0) scale(1); }

.sr-stagger > * { opacity: 0; transform: translateY(28px); transition: opacity var(--dur-base) var(--ease-smooth), transform var(--dur-base) var(--ease-smooth); }
.sr-stagger.visible > * { opacity: 1; transform: translateY(0); }
.sr-stagger.visible > *:nth-child(1) { transition-delay: 0.05s; }
.sr-stagger.visible > *:nth-child(2) { transition-delay: 0.15s; }
.sr-stagger.visible > *:nth-child(3) { transition-delay: 0.25s; }
.sr-stagger.visible > *:nth-child(4) { transition-delay: 0.35s; }
.sr-stagger.visible > *:nth-child(5) { transition-delay: 0.45s; }
.sr-stagger.visible > *:nth-child(6) { transition-delay: 0.55s; }

/* ============================================================
   HERO SECTION — entrance animations
   ============================================================ */
@keyframes heroFadeUp {
  from { opacity: 0; transform: translateY(40px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes heroImageSlide {
  from { opacity: 0; transform: translateX(50px) scale(0.97); }
  to   { opacity: 1; transform: translateX(0) scale(1); }
}
@keyframes slideRight {
  from { opacity: 0; transform: translateX(-30px); }
  to   { opacity: 1; transform: translateX(0); }
}
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50%       { transform: translateY(-10px); }
}
@keyframes countUp {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes shimmer {
  0%   { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}
@keyframes borderGlow {
  0%, 100% { box-shadow: 0 0 0 0 rgba(201, 162, 77, 0); }
  50%       { box-shadow: 0 0 0 4px rgba(201, 162, 77, 0.25); }
}
@keyframes iconBounce {
  0%, 100% { transform: translateY(0); }
  40%       { transform: translateY(-5px); }
  60%       { transform: translateY(-2px); }
}

.hero-text .trusted-tag  { animation: slideRight var(--dur-base) var(--ease-sharp) 0.1s both; }
.hero-text h1            { animation: heroFadeUp var(--dur-slow) var(--ease-sharp) 0.25s both; }
.hero-text .description  { animation: heroFadeUp var(--dur-slow) var(--ease-sharp) 0.4s both; }
.hero-text .hero-btns    { animation: heroFadeUp var(--dur-slow) var(--ease-sharp) 0.55s both; }
.hero-image              { animation: heroImageSlide var(--dur-enter) var(--ease-bounce) 0.2s both; }
.hero-image img          { animation: float 5s ease-in-out 1.5s infinite; }

/* ============================================================
   STATS — counter entrance
   ============================================================ */
.stats .stat-item { animation: countUp var(--dur-base) var(--ease-smooth) both; opacity: 0; }
.stats.animate .stat-item:nth-child(1) { animation-delay: 0.0s; }
.stats.animate .stat-item:nth-child(2) { animation-delay: 0.15s; }
.stats.animate .stat-item:nth-child(3) { animation-delay: 0.3s; }
.stats.animate .stat-item:nth-child(4) { animation-delay: 0.45s; }

/* ============================================================
   CARD HOVER EFFECTS
   ============================================================ */
.card {
  transition: transform 0.35s var(--ease-bounce), box-shadow 0.35s var(--ease-smooth) !important;
  will-change: transform;
}
.card:hover { transform: translateY(-12px) scale(1.015) !important; box-shadow: 0 20px 50px rgba(31,42,68,0.14) !important; }
.card .card-image img { transition: transform 0.55s var(--ease-smooth); }
.card:hover .card-image img { transform: scale(1.07); }
.card .learn-more { position: relative; transition: color var(--dur-fast) var(--ease-smooth), letter-spacing var(--dur-fast) var(--ease-smooth); }
.card .learn-more::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background: #C9A24D; transition: width 0.3s var(--ease-smooth); }
.card:hover .learn-more::after { width: 100%; }
.card:hover .learn-more { letter-spacing: 0.03em; }

/* ============================================================
   BUTTON HOVER ANIMATIONS
   ============================================================ */
.btn-book, .btn-white, .btn-explore, .btn-depts, .btn-consult, .btn-search, .doc-btn.primary {
  position: relative;
  overflow: hidden;
  transition: transform var(--dur-fast) var(--ease-bounce), box-shadow var(--dur-fast) var(--ease-smooth), background 0.3s var(--ease-smooth) !important;
}
.btn-book::after, .btn-white::after, .btn-explore::after, .btn-depts::after, .btn-search::after, .doc-btn.primary::after {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(255,255,255,0.18);
  transform: translateX(-105%) skewX(-15deg);
  transition: transform 0.5s var(--ease-smooth);
  pointer-events: none;
}
.btn-book:hover::after, .btn-white:hover::after, .btn-explore:hover::after,
.btn-depts:hover::after, .btn-search:hover::after, .doc-btn.primary:hover::after {
  transform: translateX(105%) skewX(-15deg);
}
.btn-book:hover, .btn-explore:hover, .btn-depts:hover, .btn-search:hover, .doc-btn.primary:hover {
  transform: translateY(-2px) scale(1.02);
  box-shadow: 0 8px 24px rgba(201,162,77,0.38);
}
.btn-white:hover { transform: translateY(-2px) scale(1.02); box-shadow: 0 8px 24px rgba(31,42,68,0.2); }
.btn-video, .btn-outline, .doc-btn.outline { transition: transform var(--dur-fast) var(--ease-bounce), background 0.3s var(--ease-smooth), border-color 0.3s var(--ease-smooth); }
.btn-video:hover, .btn-outline:hover { transform: translateY(-2px); }
.btn-consult { transition: transform var(--dur-fast) var(--ease-bounce), background 0.3s var(--ease-smooth), color 0.3s var(--ease-smooth) !important; }
.btn-consult:hover { transform: translateY(-2px); }

/* ============================================================
   DOCTOR CARD HOVER
   ============================================================ */
.doctor-card { transition: transform 0.35s var(--ease-bounce), box-shadow 0.35s var(--ease-smooth), border-color 0.3s var(--ease-smooth) !important; }
.doctor-card:hover { transform: translateY(-6px) scale(1.01) !important; box-shadow: 0 16px 40px rgba(201,162,77,0.15) !important; }
.doctor-card .doc-img-wrap img { transition: transform 0.4s var(--ease-smooth); }
.doctor-card:hover .doc-img-wrap img { transform: scale(1.08); }

/* ============================================================
   DEPARTMENT CARD HOVER
   ============================================================ */
.dept-card { transition: transform 0.35s var(--ease-bounce), box-shadow 0.35s var(--ease-smooth) !important; }
.dept-card:hover { transform: translateY(-8px) !important; box-shadow: 0 16px 40px rgba(201,162,77,0.18) !important; }
.dept-card .dept-icon { transition: transform 0.35s var(--ease-bounce), background 0.3s var(--ease-smooth); }
.dept-card:hover .dept-icon { transform: scale(1.12) rotate(-5deg); background: #f5e8c8; }

/* ============================================================
   WHY-CHOOSE-US — features icon bounce
   ============================================================ */
.features-item { transition: transform 0.3s var(--ease-smooth); }
.features-item:hover { transform: translateX(6px); }
.features-item .features-icon i { transition: transform 0.4s var(--ease-bounce), background 0.3s var(--ease-smooth); }
.features-item:hover .features-icon i { animation: iconBounce 0.5s var(--ease-bounce); background: #C9A24D; color: #fff !important; }

/* ============================================================
   TESTIMONIAL CARD HOVER
   ============================================================ */
.testimonial-card { transition: transform 0.35s var(--ease-bounce), box-shadow 0.35s var(--ease-smooth), border-color 0.3s var(--ease-smooth); cursor: default; }
.testimonial-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(0,0,0,0.25); border-color: rgba(201,162,77,0.45); }

/* ============================================================
   ABOUT IMAGES HOVER
   ============================================================ */
.about-images .img-main img { transition: transform 0.55s var(--ease-smooth); }
.about-images .img-main:hover img { transform: scale(1.04); }

/* ============================================================
   WHY CHOOSE US IMAGE HOVER
   ============================================================ */
.why-image img { transition: transform 0.55s var(--ease-smooth), box-shadow 0.55s var(--ease-smooth); }
.why-image:hover img { transform: scale(1.03) translateY(-4px); box-shadow: 0 24px 60px rgba(31,42,68,0.15); }

/* ============================================================
   HIGHLIGHT BOX HOVER
   ============================================================ */
.highlight-box { transition: transform 0.3s var(--ease-smooth), box-shadow 0.3s var(--ease-smooth); }
.highlight-box:hover { transform: translateX(5px); box-shadow: 4px 8px 24px rgba(201,162,77,0.12); }

/* ============================================================
   METRIC BOX HOVER
   ============================================================ */
.metric-box { transition: transform 0.3s var(--ease-bounce), box-shadow 0.3s var(--ease-smooth); }
.metric-box:hover { transform: translateY(-4px) scale(1.03); box-shadow: 0 8px 24px rgba(201,162,77,0.15); }

/* ============================================================
   DEPT FEATURED HOVER
   ============================================================ */
.dept-featured { transition: box-shadow 0.4s var(--ease-smooth); }
.dept-featured:hover { box-shadow: 0 20px 60px rgba(31,42,68,0.12) !important; }
.dept-featured .dept-featured-img img { transition: transform 0.65s var(--ease-smooth); }
.dept-featured:hover .dept-featured-img img { transform: scale(1.04); }

/* ============================================================
   SEARCH INPUT FOCUS
   ============================================================ */
.search-field input:focus, .search-field select:focus {
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(201,162,77,0.15);
  transition: border 0.2s, transform 0.2s, box-shadow 0.2s;
}

/* ============================================================
   CTA BOX SHIMMER
   ============================================================ */
.cta-box { position: relative; overflow: hidden; }
.cta-box::before {
  content: '';
  position: absolute;
  top: -50%; left: -50%;
  width: 200%; height: 200%;
  background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,0.06) 50%, transparent 60%);
  background-size: 200% 100%;
  animation: shimmer 5s linear infinite;
  pointer-events: none;
}

/* ============================================================
   TRUSTED TAG GLOW
   ============================================================ */
.trusted-tag { animation: borderGlow 3s ease-in-out 1.5s infinite; }

/* ============================================================
   SECTION HEADING UNDERLINE REVEAL
   ============================================================ */
.section-heading-line { position: relative; display: inline-block; }
.section-heading-line::after {
  content: '';
  position: absolute;
  bottom: -4px; left: 0;
  width: 0; height: 3px;
  background: #C9A24D;
  border-radius: 2px;
  transition: width 0.7s var(--ease-smooth) 0.3s;
}
.section-heading-line.visible::after { width: 100%; }

/* ============================================================
   REDUCE MOTION — accessibility
   ============================================================ */
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}





























@media (max-width: 768px) {
    /* ===== إزالة كل المسافات الجانبية الزائدة ===== */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden !important;
    }
    
    .container,
    .hero-container,
    .why-container,
    .about-grid,
    .cards,
    .depts-grid,
    .doctors-grid,
    .search-box,
    .cta-box,
    .features-list,
    .testimonials-cards,
    main,
    .page-content,
    section {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    /* ===== جعل جميع الحاويات الرئيسية أضيق ومتمركزة ===== */
    .hero-start .hero-container,
    .stats,
    .about-section .about-grid,
    .services .cards,
    .why-choose-us .why-container,
    .find-doctor-section .doctors-grid,
    .find-doctor-section .search-box,
    .testimonials-section .testimonials-cards,
    .get-started .cta-box,
    .departments-section .dept-featured,
    .departments-section .depts-grid {
        width: 92% !important;
        max-width: 380px !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    /* ===== تنسيق الهيرو ===== */
    .hero-start .hero-container {
        flex-direction: column;
        text-align: center;
    }
    .hero-text {
        width: 100%;
    }
    .hero-image {
        width: 100%;
        text-align: center;
    }
    .hero-image img {
        width: 90%;
        max-width: 280px;
        margin: 0 auto;
    }
    .hero-btns {
        justify-content: center;
        flex-wrap: wrap;
    }

    /* ===== تنسيق الإحصائيات ===== */
    .stats {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }
    .stat-item {
        width: 45%;
        text-align: center;
    }

    /* ===== تنسيق قسم "من نحن" ===== */
    .about-images {
        width: 90%;
        max-width: 300px;
        margin: 0 auto;
    }
    .about-content {
        text-align: center;
    }
    .highlight-box {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .about-actions {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }
    .about-actions .btn-explore,
    .about-actions .btn-consult {
        text-align: center;
    }

    /* ===== تنسيق الكروت (خدمات، أقسام، أطباء) ===== */
    .cards,
    .depts-grid,
    .doctors-grid {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 24px;
    }
    .card,
    .dept-card,
    .doctor-card {
        width: 90%;
        max-width: 300px;
        margin: 0 auto;
    }
    .card-image {
        width: 100%;
        height: 180px;
        overflow: hidden;
    }
    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ===== تنسيق قسم "لماذا تختارنا" ===== */
    .why-choose-us .why-container {
        flex-direction: column;
        text-align: center;
    }
    .why-content {
        width: 100%;
    }
    .why-image img {
        width: 90%;
        max-width: 280px;
        margin: 0 auto;
    }
    .features-item {
        flex-direction: column;
        align-items: center;
    }

    /* ===== تنسيق قسم "ابحث عن طبيب" ===== */
    .search-box {
        display: flex;
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    .search-field {
        width: 100%;
    }
    .btn-search {
        width: 100%;
        justify-content: center;
    }

    /* ===== تنسيق شهادات المرضى ===== */
    .testimonials-cards {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    .testimonial-card {
        width: 90%;
        max-width: 320px;
        margin: 0 auto;
        padding: 20px;
    }

    /* ===== تنسيق قسم CTA ===== */
    .cta-box {
        padding: 30px 20px;
        text-align: center;
    }
    .cta-btns {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }
    .cta-btns .btn-white,
    .cta-btns .btn-outline {
        width: 80%;
        max-width: 220px;
        text-align: center;
    }

    /* ===== تصغير أحجام الخطوط (مع بقائها مريحة) ===== */
    .hero-text h1 {
        font-size: 32px !important;
    }
    h2, .services h2, .departments-section h2, .find-doctor-section h2,
    .testimonials-header h2, .about-section h2, .why-content h2, .cta-box h2 {
        font-size: 28px !important;
    }
    body {
        font-size: 16px;
    }
    .card-content h4, .dept-card h3, .doctor-card .doc-info h3 {
        font-size: 18px !important;
    }
    .card-content p, .dept-card p, .doctor-card .doc-specialty {
        font-size: 14px !important;
    }
    .stats h3 {
        font-size: 32px !important;
    }
    .btn-book, .btn-video, .btn-explore, .btn-consult, .btn-search,
    .btn-white, .btn-outline, .doc-btn, .learn-more, .dept-learn-link {
        font-size: 15px !important;
        padding: 10px 18px !important;
    }

    /* ===== تقليل الهوامش والمسافات الداخلية ===== */
    .card-content, .dept-card, .doctor-card {
        padding: 16px !important;
    }
    .cards, .depts-grid, .doctors-grid, .testimonials-cards {
        gap: 20px !important;
    }
    section {
        padding-top: 40px !important;
        padding-bottom: 40px !important;
    }
    .doc-img-wrap img {
        width: 55px !important;
        height: 55px !important;
    }

    /* ===== إلغاء أي مسافات داخلية للنصوص والعناصر (لضمان عدم وجود مسافات جانبية) ===== */
    .hero-text, .stats, .about-content, .services h2, .services > p, 
    .why-content, .find-doctor-section h2, .find-doctor-section .sub,
    .testimonials-header, .cta-box h2, .cta-box p, .cta-btns,
    .dept-featured-content, .about-checklist, .about-metrics, .about-actions,
    .features-item, .depts-cta div, .dept-card, .doctor-card {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
}








/* الأقسام ذات الخلفية تمتد بالكامل */

</style>
@endpush

@section('content')
    {{-- HERO SECTION --}}
    <section class="hero-start">
        <div class="container hero-container">
            <div class="hero-text">
                <p class="trusted-tag" id="trustedTag">Trusted by 10,000+ patients</p>
                <h1 id="heroTitle">Your Health is Our <br><span class="highlight">Top Priority</span></h1>
                <p class="description" id="heroDesc">Experience World-class healthcare with our team of expert doctors. Book appointments, access medical records, and manage your health journey seamlessly.</p>
                <div class="hero-btns">
                    <button class="btn-book" id="btnBook">Book Appointment →</button>
                    <button class="btn-video" id="btnVideo">Watch Video</button>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('mon/images/home.png') }}" alt="Doctor">
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="container stats">
        <div class="stat-item"><h3 id="stat1val">50+</h3><p id="stat1lab">Expert Doctors</p></div>
        <div class="stat-item"><h3 id="stat2val">10K+</h3><p id="stat2lab">Happy Patients</p></div>
        <div class="stat-item"><h3 id="stat3val">15+</h3><p id="stat3lab">Years Experience</p></div>
        <div class="stat-item"><h3 id="stat4val">24/7</h3><p id="stat4lab">Emergency Care</p></div>
    </section>

    {{-- ABOUT SECTION --}}
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-images">
                    <div class="img-main">
                        <img src="{{ asset('mon/images/why-choose-us.jpg') }}" alt="Hospital Facility">
                        <div class="img-badge"><i class="fa-solid fa-award"></i> <span id="badgeText">JCI Accredited</span></div>
                    </div>
                    <div class="img-small"><img src="{{ asset('mon/images/cardiology.jpg') }}" alt="Doctor consultation"></div>
                    <div class="img-small"><img src="{{ asset('mon/images/neurology.jpg') }}" alt="Medical procedure"></div>
                </div>
                <div class="about-content">
                    <span class="section-label" id="aboutLabel">Who We Are</span>
                    <h2 id="aboutTitle">Excellence in Healthcare Since 2008</h2>
                    <p class="lead-desc" id="aboutDesc">We are committed to providing world-class medical care through innovation, compassion, and unwavering dedication to our patients' wellbeing and recovery.</p>
                    <div class="highlight-box">
                        <div class="hi-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                        <div class="hi-text">
                            <h4 id="hbTitle">Patient-Centered Approach</h4>
                            <p id="hbDesc">Every treatment plan is carefully customized to meet individual patient needs and medical history.</p>
                        </div>
                    </div>
                    <ul class="about-checklist" id="aboutChecklist">
                        <li><i class="fa-solid fa-circle-check"></i> <span class="check-item">Advanced diagnostic technology and imaging</span></li>
                        <li><i class="fa-solid fa-circle-check"></i> <span class="check-item">Board-certified physicians and specialists</span></li>
                        <li><i class="fa-solid fa-circle-check"></i> <span class="check-item">Comprehensive rehabilitation programs</span></li>
                        <li><i class="fa-solid fa-circle-check"></i> <span class="check-item">24/7 emergency and critical care services</span></li>
                    </ul>
                    <div class="about-metrics">
                        <div class="metric-box"><span class="metric-num" id="metric1num">98%</span><div class="metric-label" id="metric1lab">Patient Satisfaction</div></div>
                        <div class="metric-box"><span class="metric-num" id="metric2num">35K+</span><div class="metric-label" id="metric2lab">Lives Improved</div></div>
                    </div>
                    <div class="about-actions">
                        <a href="{{ url('/services') }}" class="btn-explore" id="aboutBtn1">Explore Our Services</a>
                        <a href="{{ url('/contact') }}" class="btn-consult" id="aboutBtn2"><i class="fa-solid fa-phone"></i> Schedule Consultation</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICES SECTION --}}
    <section class="services">
        <div class="container">
            <h2 id="servicesTitle">Featured Services</h2>
            <p id="servicesSub">Providing excellence in every medical specialty</p>
            <div class="cards">
                <div class="card"><div class="card-image"><img src="{{ asset('mon/images/cardiology.jpg') }}" alt="Cardiology"></div><div class="card-content"><h4 id="card1Title">Cardiology Excellence</h4><p id="card1Desc">L luctus et ultrices posuere cubilia curae.</p><a href="#" class="learn-more" id="card1Link">Learn More →</a></div></div>
                <div class="card"><div class="card-image"><img src="{{ asset('mon/images/neurology.jpg') }}" alt="Neurology"></div><div class="card-content"><h4 id="card2Title">Neurology Care</h4><p id="card2Desc">nostrud exercitation ullamco laboris nisi.</p><a href="#" class="learn-more" id="card2Link">Learn More →</a></div></div>
                <div class="card"><div class="card-image"><img src="{{ asset('mon/images/orthopedic.jpg') }}" alt="Orthopedic"></div><div class="card-content"><h4 id="card3Title">Orthopedic Surgery</h4><p id="card3Desc">Excepteur sint occaecat cupidatat non proident.</p><a href="#" class="learn-more" id="card3Link">Learn More →</a></div></div>
                <div class="card"><div class="card-image"><img src="{{ asset('mon/images/pediatric.jpg') }}" alt="Pediatric"></div><div class="card-content"><h4 id="card4Title">Pediatric Care</h4><p id="card4Desc">natus error sit voluptatem accusantium.</p><a href="#" class="learn-more" id="card4Link">Learn More →</a></div></div>
                <div class="card"><div class="card-image"><img src="{{ asset('mon/images/oncology.jpg') }}" alt="Oncology"></div><div class="card-content"><h4 id="card5Title">Oncology Treatment</h4><p id="card5Desc">deleniti atque corrupti quos dolores et quas.</p><a href="#" class="learn-more" id="card5Link">Learn More →</a></div></div>
                <div class="card"><div class="card-image"><img src="{{ asset('mon/images/laboratory.jpg') }}" alt="Laboratory"></div><div class="card-content"><h4 id="card6Title">Laboratory Services</h4><p id="card6Desc">voluptates repudiandae sint et molestiae.</p><a href="#" class="learn-more" id="card6Link">Learn More →</a></div></div>
            </div>
        </div>
    </section>

    {{-- DEPARTMENTS SECTION --}}
    <section class="departments-section">
        <div class="container">
            <h2 id="deptTitle">Featured Departments</h2>
            <p class="sub" id="deptSub">Specialized care across every medical field</p>
            <div class="dept-featured">
                <div class="dept-featured-img"><img src="{{ asset('mon/images/cardiology.jpg') }}" alt="Emergency"></div>
                <div class="dept-featured-content">
                    <span class="dept-category" id="deptCat">Emergency Medicine</span>
                    <h2 id="deptFeatTitle">24/7 Emergency Care Services</h2>
                    <p id="deptFeatDesc">Our emergency department operates around the clock with expert medical staff ready to respond immediately.</p>
                    <ul class="dept-feat-list">
                        <li><i class="fa-solid fa-circle-check"></i> <span class="feat-item">24/7 Emergency Response</span></li>
                        <li><i class="fa-solid fa-circle-check"></i> <span class="feat-item">Advanced Life Support</span></li>
                        <li><i class="fa-solid fa-circle-check"></i> <span class="feat-item">Trauma Care Specialists</span></li>
                    </ul>
                    <a href="#" class="dept-learn-link" id="deptLearnLink">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="depts-grid">
                <div class="dept-card"><div class="dept-icon"><i class="fa-solid fa-heart-pulse"></i></div><h3 id="deptCard1Title">Cardiology</h3><p id="deptCard1Desc">Advanced heart care with state-of-the-art equipment.</p><div class="dept-card-stats"><div class="ds"><span class="ds-num" id="deptCard1Stat1">15+</span><span class="ds-label" id="deptCard1Lab1">Specialists</span></div><div class="ds"><span class="ds-num" id="deptCard1Stat2">500+</span><span class="ds-label" id="deptCard1Lab2">Procedures</span></div></div></div>
                <div class="dept-card"><div class="dept-icon"><i class="fa-solid fa-brain"></i></div><h3 id="deptCard2Title">Neurology</h3><p id="deptCard2Desc">Comprehensive neurological services for brain and spine.</p><div class="dept-card-stats"><div class="ds"><span class="ds-num" id="deptCard2Stat1">8+</span><span class="ds-label" id="deptCard2Lab1">Specialists</span></div><div class="ds"><span class="ds-num" id="deptCard2Stat2">200+</span><span class="ds-label" id="deptCard2Lab2">Treatments</span></div></div></div>
                <div class="dept-card"><div class="dept-icon"><i class="fa-solid fa-scissors"></i></div><h3 id="deptCard3Title">Surgery</h3><p id="deptCard3Desc">Precision surgical procedures with minimal invasive techniques.</p><div class="dept-card-stats"><div class="ds"><span class="ds-num" id="deptCard3Stat1">12+</span><span class="ds-label" id="deptCard3Lab1">Surgeons</span></div><div class="ds"><span class="ds-num" id="deptCard3Stat2">1000+</span><span class="ds-label" id="deptCard3Lab2">Operations</span></div></div></div>
                <div class="dept-card"><div class="dept-icon"><i class="fa-solid fa-baby"></i></div><h3 id="deptCard4Title">Pediatrics</h3><p id="deptCard4Desc">Dedicated child-friendly care for healthy growth.</p><div class="dept-card-stats"><div class="ds"><span class="ds-num" id="deptCard4Stat1">10+</span><span class="ds-label" id="deptCard4Lab1">Pediatricians</span></div><div class="ds"><span class="ds-num" id="deptCard4Stat2">2000+</span><span class="ds-label" id="deptCard4Lab2">Young Patients</span></div></div></div>
                <div class="dept-card"><div class="dept-icon"><i class="fa-solid fa-eye"></i></div><h3 id="deptCard5Title">Ophthalmology</h3><p id="deptCard5Desc">Full spectrum of eye care from exams to surgery.</p><div class="dept-card-stats"><div class="ds"><span class="ds-num" id="deptCard5Stat1">6+</span><span class="ds-label" id="deptCard5Lab1">Eye Doctors</span></div><div class="ds"><span class="ds-num" id="deptCard5Stat2">800+</span><span class="ds-label" id="deptCard5Lab2">Eye Exams</span></div></div></div>
                <div class="dept-card"><div class="dept-icon"><i class="fa-solid fa-bandage"></i></div><h3 id="deptCard6Title">Dermatology</h3><p id="deptCard6Desc">Expert skin care with modern therapies.</p><div class="dept-card-stats"><div class="ds"><span class="ds-num" id="deptCard6Stat1">7+</span><span class="ds-label" id="deptCard6Lab1">Dermatologists</span></div><div class="ds"><span class="ds-num" id="deptCard6Stat2">600+</span><span class="ds-label" id="deptCard6Lab2">Treatments</span></div></div></div>
            </div>
            <div class="depts-cta">
                <div><h3 id="deptsCtaTitle">Explore All Our Medical Departments</h3><p id="deptsCtaDesc">Discover the full range of specialized medical departments.</p></div>
                <a href="{{ url('/services') }}" class="btn-depts" id="deptsCtaBtn">View All Departments</a>
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section class="why-choose-us container">
        <div class="why-container">
            <div class="why-content">
                <span class="sup-why" id="whyLabel">WHY CHOOSE US</span>
                <h2 id="whyTitle">Delivering Excellence in Healthcare</h2>
                <div class="features-list">
                    <div class="features-item"><div class="features-icon"><i class="fa-solid fa-user-doctor"></i></div><div class="features-text"><h4 id="feat1Title">Expert Medical Team</h4><p id="feat1Desc">Board-certified specialists with years of experience</p></div></div>
                    <div class="features-item"><div class="features-icon"><i class="fa-solid fa-clock"></i></div><div class="features-text"><h4 id="feat2Title">24/7 Availability</h4><p id="feat2Desc">Round-the-clock emergency service and support</p></div></div>
                    <div class="features-item"><div class="features-icon"><i class="fa-solid fa-microchip"></i></div><div class="features-text"><h4 id="feat3Title">Advanced Technology</h4><p id="feat3Desc">State-of-the-art diagnostic equipment</p></div></div>
                </div>
            </div>
            <div class="why-image"><img src="{{ asset('mon/images/why-choose-us.jpg') }}" alt="Why Choose Us"></div>
        </div>
    </section>

    {{-- FIND A DOCTOR --}}
    <section class="find-doctor-section">
        <div class="container">
            <h2 id="fdTitle">Find A Doctor</h2>
            <p class="sub" id="fdSub">Connect with our certified healthcare professionals</p>
            <div class="search-box">
                <div class="search-field"><label id="fdLbl1">Practitioner Name</label><div class="input-wrap"><i class="fa-solid fa-magnifying-glass"></i><input type="text" id="fdInput1" placeholder="Search by name..."></div></div>
                <div class="search-field"><label id="fdLbl2">Medical Specialty</label><div class="input-wrap"><i class="fa-solid fa-stethoscope"></i><select id="fdSel1"><option value="">Select specialty</option><option>Cardiology</option><option>Neurology</option><option>Orthopedics</option><option>Pediatrics</option><option>Dermatology</option><option>Oncology</option></select></div></div>
                <div class="search-field"><label id="fdLbl3">Location</label><div class="input-wrap"><i class="fa-solid fa-location-dot"></i><select id="fdSel2"><option value="">All locations</option><option>Main Medical Center</option><option>North Clinic</option><option>West Hospital</option></select></div></div>
                <button class="btn-search" id="fdSearchBtn"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></button>
            </div>
            <div class="doctors-grid">
                <div class="doctor-card featured-doc"><div class="doctor-profile"><div class="doc-img-wrap"><img src="{{ asset('mon/images/person1.jpg') }}" alt="Dr. Jennifer Morgan"><span class="doc-status active"></span></div><div class="doc-info"><h3 id="doc1Name">Dr. Jennifer Morgan</h3><p class="doc-specialty" id="doc1Spec">Senior Cardiologist</p><div class="doc-badges"><span class="doc-badge" id="doc1Badge">MD, FACC</span><span class="doc-exp" id="doc1Exp">18 years</span></div></div></div><div class="doc-rating"><div class="doc-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><span class="doc-score" id="doc1Score">4.9</span><span class="doc-reviews" id="doc1Reviews">(142)</span></div><div class="doc-actions"><a href="#" class="doc-btn outline" id="doc1ProfileBtn">Profile</a><a href="#" class="doc-btn primary" id="doc1ConsultBtn">Consult</a></div></div>
                <div class="doctor-card"><div class="doctor-profile"><div class="doc-img-wrap"><img src="{{ asset('mon/images/person2.jpg') }}" alt="Dr. Robert Kim"><span class="doc-status busy"></span></div><div class="doc-info"><h3 id="doc2Name">Dr. Robert Kim</h3><p class="doc-specialty" id="doc2Spec">Neurosurgeon</p><div class="doc-badges"><span class="doc-badge" id="doc2Badge">MD, PhD</span><span class="doc-exp" id="doc2Exp">24 years</span></div></div></div><div class="doc-rating"><div class="doc-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></div><span class="doc-score" id="doc2Score">4.8</span><span class="doc-reviews" id="doc2Reviews">(98)</span></div><div class="doc-actions"><a href="#" class="doc-btn outline" id="doc2ProfileBtn">Profile</a><a href="#" class="doc-btn primary" id="doc2ConsultBtn">Schedule</a></div></div>
                <div class="doctor-card"><div class="doctor-profile"><div class="doc-img-wrap"><img src="{{ asset('mon/images/person3.jpg') }}" alt="Dr. Sarah Thompson"><span class="doc-status active"></span></div><div class="doc-info"><h3 id="doc3Name">Dr. Sarah Thompson</h3><p class="doc-specialty" id="doc3Spec">Pediatric Specialist</p><div class="doc-badges"><span class="doc-badge" id="doc3Badge">MD, FAAP</span><span class="doc-exp" id="doc3Exp">12 years</span></div></div></div><div class="doc-rating"><div class="doc-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><span class="doc-score" id="doc3Score">5.0</span><span class="doc-reviews" id="doc3Reviews">(156)</span></div><div class="doc-actions"><a href="#" class="doc-btn outline" id="doc3ProfileBtn">Profile</a><a href="#" class="doc-btn primary" id="doc3ConsultBtn">Book Now</a></div></div>
                <div class="doctor-card"><div class="doctor-profile"><div class="doc-img-wrap"><img src="{{ asset('mon/images/person1.jpg') }}" alt="Dr. Michael Rivera"><span class="doc-status offline"></span></div><div class="doc-info"><h3 id="doc4Name">Dr. Michael Rivera</h3><p class="doc-specialty" id="doc4Spec">Orthopedic Surgeon</p><div class="doc-badges"><span class="doc-badge" id="doc4Badge">MD, FAAOS</span><span class="doc-exp" id="doc4Exp">20 years</span></div></div></div><div class="doc-rating"><div class="doc-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></div><span class="doc-score" id="doc4Score">4.7</span><span class="doc-reviews" id="doc4Reviews">(134)</span></div><div class="doc-actions"><a href="#" class="doc-btn outline" id="doc4ProfileBtn">Profile</a><a href="#" class="doc-btn primary" id="doc4ConsultBtn">Request</a></div></div>
                <div class="doctor-card"><div class="doctor-profile"><div class="doc-img-wrap"><img src="{{ asset('mon/images/person2.jpg') }}" alt="Dr. Lisa Garcia"><span class="doc-status active"></span></div><div class="doc-info"><h3 id="doc5Name">Dr. Lisa Garcia</h3><p class="doc-specialty" id="doc5Spec">Dermatologist</p><div class="doc-badges"><span class="doc-badge" id="doc5Badge">MD, FAAD</span><span class="doc-exp" id="doc5Exp">15 years</span></div></div></div><div class="doc-rating"><div class="doc-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i></div><span class="doc-score" id="doc5Score">4.6</span><span class="doc-reviews" id="doc5Reviews">(89)</span></div><div class="doc-actions"><a href="#" class="doc-btn outline" id="doc5ProfileBtn">Profile</a><a href="#" class="doc-btn primary" id="doc5ConsultBtn">Consult</a></div></div>
                <div class="doctor-card"><div class="doctor-profile"><div class="doc-img-wrap"><img src="{{ asset('mon/images/person3.jpg') }}" alt="Dr. Daniel Wong"><span class="doc-status active"></span></div><div class="doc-info"><h3 id="doc6Name">Dr. Daniel Wong</h3><p class="doc-specialty" id="doc6Spec">Oncology Expert</p><div class="doc-badges"><span class="doc-badge" id="doc6Badge">MD, FASCO</span><span class="doc-exp" id="doc6Exp">21 years</span></div></div></div><div class="doc-rating"><div class="doc-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><span class="doc-score" id="doc6Score">4.9</span><span class="doc-reviews" id="doc6Reviews">(211)</span></div><div class="doc-actions"><a href="#" class="doc-btn outline" id="doc6ProfileBtn">Profile</a><a href="#" class="doc-btn primary" id="doc6ConsultBtn">Appointment</a></div></div>
            </div>
            <div class="find-doctor-cta">
                <a href="{{ url('/doctors') }}" class="btn-browse" id="fdBrowse">Browse Complete Directory <i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="testimonials-section">
        <div class="container">
            <div class="testimonials-header"><span class="badge" id="testBadge">Testimonials</span><h2 id="testTitle">What Our Patients Say</h2></div>
            <div class="testimonials-cards">
                <div class="testimonial-card"><div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p class="testimonial-text" id="testText1">"The care I received was exceptional. The doctors took time to explain everything."</p><div class="patient-info"><img src="{{ asset('mon/images/person1.jpg') }}" alt="Sarah"><div class="patient-details"><h4 id="testName1">Sarah Johnson</h4><span id="testRole1">Patient</span></div></div></div>
                <div class="testimonial-card"><div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p class="testimonial-text" id="testText2">"Booking appointments is so easy with their online system. Highly recommend."</p><div class="patient-info"><img src="{{ asset('mon/images/person2.jpg') }}" alt="Michael"><div class="patient-details"><h4 id="testName2">Michael Chen</h4><span id="testRole2">Patient</span></div></div></div>
                <div class="testimonial-card"><div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p class="testimonial-text" id="testText3">"The staff is incredibly friendly and professional. They really care."</p><div class="patient-info"><img src="{{ asset('mon/images/person3.jpg') }}" alt="Emily"><div class="patient-details"><h4 id="testName3">Emily Davis</h4><span id="testRole3">Patient</span></div></div></div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="get-started container">
        <div class="cta-box">
            <h2 id="ctaTitle">Ready to Get Started?</h2>
            <p id="ctaDesc">Book your appointment today and experience quality healthcare</p>
            <div class="cta-btns">
                <a href="{{ route('login') }}" class="btn-white" id="ctaBtn1">Book Appointment →</a>
                <a href="#" class="btn-outline" id="ctaBtn2">Watch Video</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
// ====================== ترجمة صفحة الهوم كاملة ======================
window.applyPageTranslation = function(lang) {
    const translations = {
        en: {
            trustedTag: "Trusted by 10,000+ patients",
            heroTitle: "Your Health is Our <br><span class='highlight'>Top Priority</span>",
            heroDesc: "Experience World-class healthcare with our team of expert doctors. Book appointments, access medical records, and manage your health journey seamlessly.",
            btnBook: "Book Appointment →",
            btnVideo: "Watch Video",
            stats: { vals: ["50+","10K+","15+","24/7"], labels: ["Expert Doctors","Happy Patients","Years Experience","Emergency Care"] },
            badgeText: "JCI Accredited",
            aboutLabel: "Who We Are",
            aboutTitle: "Excellence in Healthcare Since 2008",
            aboutDesc: "We are committed to providing world-class medical care through innovation, compassion, and unwavering dedication to our patients' wellbeing and recovery.",
            hbTitle: "Patient-Centered Approach",
            hbDesc: "Every treatment plan is carefully customized to meet individual patient needs and medical history.",
            checks: ["Advanced diagnostic technology and imaging","Board-certified physicians and specialists","Comprehensive rehabilitation programs","24/7 emergency and critical care services"],
            metric1num: "98%", metric1lab: "Patient Satisfaction",
            metric2num: "35K+", metric2lab: "Lives Improved",
            aboutBtn1: "Explore Our Services",
            aboutBtn2: "Schedule Consultation",
            servicesTitle: "Featured Services",
            servicesSub: "Providing excellence in every medical specialty",
            cards: [
                { title: "Cardiology Excellence", desc: "Advanced heart care with modern technology.", link: "Learn More →" },
                { title: "Neurology Care", desc: "Comprehensive neurological treatments.", link: "Learn More →" },
                { title: "Orthopedic Surgery", desc: "Expert surgical care for bones and joints.", link: "Learn More →" },
                { title: "Pediatric Care", desc: "Specialized care for children of all ages.", link: "Learn More →" },
                { title: "Oncology Treatment", desc: "Advanced cancer care and support.", link: "Learn More →" },
                { title: "Laboratory Services", desc: "Accurate and fast diagnostic testing.", link: "Learn More →" }
            ],
            deptTitle: "Featured Departments",
            deptSub: "Specialized care across every medical field",
            deptCat: "Emergency Medicine",
            deptFeatTitle: "24/7 Emergency Care Services",
            deptFeatDesc: "Our emergency department operates around the clock with expert medical staff ready to respond immediately.",
            deptFeatList: ["24/7 Emergency Response","Advanced Life Support","Trauma Care Specialists"],
            deptLearnLink: "Learn More",
            deptCards: [
                { title: "Cardiology", desc: "Advanced heart care.", stat1: "15+", lab1: "Specialists", stat2: "500+", lab2: "Procedures" },
                { title: "Neurology", desc: "Brain and spine care.", stat1: "8+", lab1: "Specialists", stat2: "200+", lab2: "Treatments" },
                { title: "Surgery", desc: "Precision surgical procedures.", stat1: "12+", lab1: "Surgeons", stat2: "1000+", lab2: "Operations" },
                { title: "Pediatrics", desc: "Child-friendly care.", stat1: "10+", lab1: "Pediatricians", stat2: "2000+", lab2: "Young Patients" },
                { title: "Ophthalmology", desc: "Full eye care.", stat1: "6+", lab1: "Eye Doctors", stat2: "800+", lab2: "Eye Exams" },
                { title: "Dermatology", desc: "Expert skin care.", stat1: "7+", lab1: "Dermatologists", stat2: "600+", lab2: "Treatments" }
            ],
            deptsCtaTitle: "Explore All Our Medical Departments",
            deptsCtaDesc: "Discover the full range of specialized medical departments.",
            deptsCtaBtn: "View All Departments",
            whyLabel: "WHY CHOOSE US",
            whyTitle: "Delivering Excellence in Healthcare",
            feat1: { title: "Expert Medical Team", desc: "Board-certified specialists with years of experience" },
            feat2: { title: "24/7 Availability", desc: "Round-the-clock emergency service and support" },
            feat3: { title: "Advanced Technology", desc: "State-of-the-art diagnostic equipment" },
            fdTitle: "Find A Doctor",
            fdSub: "Connect with our certified healthcare professionals",
            fdLbl1: "Practitioner Name", fdLbl2: "Medical Specialty", fdLbl3: "Location",
            fdPh: "Search by name...", fdSelOpt: "Select specialty", fdLocOpt: "All locations", fdSearch: "Search",
            doctors: [
                { name: "Dr. Jennifer Morgan", spec: "Senior Cardiologist", badge: "MD, FACC", exp: "18 years", score: "4.9", reviews: "(142)", profile: "Profile", consult: "Consult" },
                { name: "Dr. Robert Kim", spec: "Neurosurgeon", badge: "MD, PhD", exp: "24 years", score: "4.8", reviews: "(98)", profile: "Profile", consult: "Schedule" },
                { name: "Dr. Sarah Thompson", spec: "Pediatric Specialist", badge: "MD, FAAP", exp: "12 years", score: "5.0", reviews: "(156)", profile: "Profile", consult: "Book Now" },
                { name: "Dr. Michael Rivera", spec: "Orthopedic Surgeon", badge: "MD, FAAOS", exp: "20 years", score: "4.7", reviews: "(134)", profile: "Profile", consult: "Request" },
                { name: "Dr. Lisa Garcia", spec: "Dermatologist", badge: "MD, FAAD", exp: "15 years", score: "4.6", reviews: "(89)", profile: "Profile", consult: "Consult" },
                { name: "Dr. Daniel Wong", spec: "Oncology Expert", badge: "MD, FASCO", exp: "21 years", score: "4.9", reviews: "(211)", profile: "Profile", consult: "Appointment" }
            ],
            fdBrowse: "Browse Complete Directory",
            testBadge: "Testimonials", testTitle: "What Our Patients Say",
            tests: [
                { text: "\"The care I received was exceptional. The doctors took time to explain everything.\"", name: "Sarah Johnson", role: "Patient" },
                { text: "\"Booking appointments is so easy with their online system. Highly recommend.\"", name: "Michael Chen", role: "Patient" },
                { text: "\"The staff is incredibly friendly and professional. They really care.\"", name: "Emily Davis", role: "Patient" }
            ],
            ctaTitle: "Ready to Get Started?",
            ctaDesc: "Book your appointment today and experience quality healthcare",
            ctaBtn1: "Book Appointment →", ctaBtn2: "Watch Video"
        },
        ar: {
            trustedTag: "يثق بنا أكثر من ١٠,٠٠٠ مريض",
            heroTitle: "صحتك هي <br><span class='highlight'>أولويتنا القصوى</span>",
            heroDesc: "اختبر رعاية صحية عالمية المستوى مع فريقنا من الأطباء الخبراء. احجز موعدًا، واطلع على السجلات الطبية، وتابع رحلتك الصحية بسلاسة.",
            btnBook: "احجز موعدك ←", btnVideo: "شاهد الفيديو",
            stats: { vals: ["+٥٠","+١٠ آلاف","+١٥","٢٤/٧"], labels: ["طبيب خبير","مريض سعيد","سنة خبرة","رعاية طوارئ"] },
            badgeText: "معتمد من اللجنة الدولية المشتركة",
            aboutLabel: "من نحن",
            aboutTitle: "التميز في الرعاية الصحية منذ ٢٠٠٨",
            aboutDesc: "نحن ملتزمون بتقديم رعاية طبية عالمية المستوى من خلال الابتكار والرحمة والتفاني الثابت في رفاهية مرضانا.",
            hbTitle: "نهج يرتكز على المريض",
            hbDesc: "كل خطة علاجية مصممة بعناية لتلبية احتياجات المريض الفردية وتاريخه الطبي.",
            checks: ["تقنية تشخيصية متقدمة","أطباء وأخصائيون معتمدون","برامج إعادة تأهيل شاملة","خدمات طوارئ على مدار الساعة"],
            metric1num: "٩٨٪", metric1lab: "رضا المرضى",
            metric2num: "+٣٥ ألف", metric2lab: "حياة تحسّنت",
            aboutBtn1: "اكتشف خدماتنا", aboutBtn2: "احجز استشارة",
            servicesTitle: "الخدمات المميزة", servicesSub: "تقديم التميز في كل تخصص طبي",
            cards: [
                { title: "تميز في أمراض القلب", desc: "رعاية قلب متقدمة بأحدث التقنيات.", link: "اعرف المزيد ←" },
                { title: "رعاية الأعصاب", desc: "علاجات شاملة للأعصاب.", link: "اعرف المزيد ←" },
                { title: "جراحة العظام", desc: "رعاية جراحية متخصصة للعظام والمفاصل.", link: "اعرف المزيد ←" },
                { title: "رعاية الأطفال", desc: "رعاية متخصصة للأطفال من جميع الأعمار.", link: "اعرف المزيد ←" },
                { title: "علاج الأورام", desc: "رعاية متقدمة للسرطان ودعم.", link: "اعرف المزيد ←" },
                { title: "خدمات المختبر", desc: "اختبارات تشخيصية دقيقة وسريعة.", link: "اعرف المزيد ←" }
            ],
            deptTitle: "الأقسام المميزة", deptSub: "رعاية متخصصة في كل مجال طبي",
            deptCat: "طب الطوارئ", deptFeatTitle: "خدمات طوارئ على مدار الساعة",
            deptFeatDesc: "قسم الطوارئ لدينا يعمل على مدار الساعة مع فريق طبي خبير جاهز للاستجابة الفورية.",
            deptFeatList: ["استجابة طوارئ ٢٤/٧","دعم متقدم للحياة","أخصائيو رعاية الصدمات"],
            deptLearnLink: "اعرف المزيد",
            deptCards: [
                { title: "أمراض القلب", desc: "رعاية قلب متقدمة.", stat1: "+١٥", lab1: "أخصائي", stat2: "+٥٠٠", lab2: "إجراء" },
                { title: "طب الأعصاب", desc: "رعاية الدماغ والعمود الفقري.", stat1: "+٨", lab1: "أخصائي", stat2: "+٢٠٠", lab2: "علاج" },
                { title: "الجراحة", desc: "إجراءات جراحية دقيقة.", stat1: "+١٢", lab1: "جراح", stat2: "+١٠٠٠", lab2: "عملية" },
                { title: "طب الأطفال", desc: "رعاية صديقة للأطفال.", stat1: "+١٠", lab1: "طبيب أطفال", stat2: "+٢٠٠٠", lab2: "مريض صغير" },
                { title: "طب العيون", desc: "رعاية كاملة للعين.", stat1: "+٦", lab1: "طبيب عيون", stat2: "+٨٠٠", lab2: "فحص عين" },
                { title: "الأمراض الجلدية", desc: "رعاية جلدية متخصصة.", stat1: "+٧", lab1: "طبيب جلدية", stat2: "+٦٠٠", lab2: "علاج" }
            ],
            deptsCtaTitle: "استكشف جميع أقسامنا الطبية",
            deptsCtaDesc: "اكتشف المجموعة الكاملة من الأقسام الطبية المتخصصة.",
            deptsCtaBtn: "عرض جميع الأقسام",
            whyLabel: "لماذا تختارنا", whyTitle: "تقديم التميز في الرعاية الصحية",
            feat1: { title: "فريق طبي خبير", desc: "أخصائيون معتمدون من البورد مع سنوات من الخبرة" },
            feat2: { title: "توفر ٢٤/٧", desc: "خدمة طوارئ ودعم على مدار الساعة" },
            feat3: { title: "تقنية متقدمة", desc: "أحدث أجهزة التشخيص" },
            fdTitle: "ابحث عن طبيب", fdSub: "تواصل مع كوادرنا الطبية المعتمدة",
            fdLbl1: "اسم الطبيب", fdLbl2: "التخصص الطبي", fdLbl3: "الموقع",
            fdPh: "البحث بالاسم...", fdSelOpt: "اختر التخصص", fdLocOpt: "جميع المواقع", fdSearch: "بحث",
            doctors: [
                { name: "د. جينيفر مورجان", spec: "أخصائية قلب أول", badge: "دكتوراه في الطب, FACC", exp: "١٨ سنة", score: "٤.٩", reviews: "(١٤٢)", profile: "الملف", consult: "استشارة" },
                { name: "د. روبرت كيم", spec: "جراح أعصاب", badge: "دكتوراه في الطب, دكتوراه", exp: "٢٤ سنة", score: "٤.٨", reviews: "(٩٨)", profile: "الملف", consult: "حجز" },
                { name: "د. سارة تومسون", spec: "أخصائية أطفال", badge: "دكتوراه في الطب, FAAP", exp: "١٢ سنة", score: "٥.٠", reviews: "(١٥٦)", profile: "الملف", consult: "احجز الآن" },
                { name: "د. مايكل ريفيرا", spec: "جراح عظام", badge: "دكتوراه في الطب, FAAOS", exp: "٢٠ سنة", score: "٤.٧", reviews: "(١٣٤)", profile: "الملف", consult: "طلب" },
                { name: "د. ليزا جارسيا", spec: "أمراض جلدية", badge: "دكتوراه في الطب, FAAD", exp: "١٥ سنة", score: "٤.٦", reviews: "(٨٩)", profile: "الملف", consult: "استشارة" },
                { name: "د. دانيال وونغ", spec: "خبير أورام", badge: "دكتوراه في الطب, FASCO", exp: "٢١ سنة", score: "٤.٩", reviews: "(٢١١)", profile: "الملف", consult: "موعد" }
            ],
            fdBrowse: "تصفح الدليل الكامل",
            testBadge: "شهادات المرضى", testTitle: "ماذا يقول مرضانا",
            tests: [
                { text: "\"الرعاية التي تلقيتها كانت استثنائية. أخذ الأطباء وقتهم لشرح كل شيء.\"", name: "سارة جونسون", role: "مريض" },
                { text: "\"حجز المواعيد سهل للغاية من خلال نظامهم الإلكتروني. أوصي به بشدة.\"", name: "مايكل تشين", role: "مريض" },
                { text: "\"الموظفون ودودون ومحترفون بشكل لا يصدق. إنهم يهتمون حقًا.\"", name: "إيميلي ديفيس", role: "مريض" }
            ],
            ctaTitle: "هل أنت مستعد للبدء؟",
            ctaDesc: "احجز موعدك اليوم واستمتع برعاية صحية عالية الجودة",
            ctaBtn1: "احجز موعدك الآن ←", ctaBtn2: "شاهد الفيديو"
        }
    };

    const t = translations[lang];
    if (!t) return;

    const g = id => document.getElementById(id);
    const s = (id, v) => { const e = g(id); if (e) e.innerText = v; };
    const h = (id, v) => { const e = g(id); if (e) e.innerHTML = v; };

    s('trustedTag', t.trustedTag);
    h('heroTitle', t.heroTitle);
    s('heroDesc', t.heroDesc);
    s('btnBook', t.btnBook);
    s('btnVideo', t.btnVideo);

    for (let i = 1; i <= 4; i++) {
        s(`stat${i}val`, t.stats.vals[i-1]);
        s(`stat${i}lab`, t.stats.labels[i-1]);
    }

    s('badgeText', t.badgeText);
    s('aboutLabel', t.aboutLabel);
    s('aboutTitle', t.aboutTitle);
    s('aboutDesc', t.aboutDesc);
    s('hbTitle', t.hbTitle);
    s('hbDesc', t.hbDesc);
    const checkItems = document.querySelectorAll('#aboutChecklist .check-item');
    checkItems.forEach((item, idx) => { if (t.checks[idx]) item.innerText = t.checks[idx]; });
    s('metric1num', t.metric1num); s('metric1lab', t.metric1lab);
    s('metric2num', t.metric2num); s('metric2lab', t.metric2lab);
    s('aboutBtn1', t.aboutBtn1);
    const aboutBtn2 = g('aboutBtn2');
    if (aboutBtn2) aboutBtn2.innerHTML = `<i class="fa-solid fa-phone"></i> ${t.aboutBtn2}`;

    s('servicesTitle', t.servicesTitle);
    s('servicesSub', t.servicesSub);
    for (let i = 1; i <= 6; i++) {
        s(`card${i}Title`, t.cards[i-1].title);
        s(`card${i}Desc`, t.cards[i-1].desc);
        s(`card${i}Link`, t.cards[i-1].link);
    }

    s('deptTitle', t.deptTitle); s('deptSub', t.deptSub);
    s('deptCat', t.deptCat); s('deptFeatTitle', t.deptFeatTitle); s('deptFeatDesc', t.deptFeatDesc);
    const featItems = document.querySelectorAll('.dept-feat-list .feat-item');
    featItems.forEach((item, idx) => { if (t.deptFeatList[idx]) item.innerText = t.deptFeatList[idx]; });
    s('deptLearnLink', t.deptLearnLink);
    for (let i = 1; i <= 6; i++) {
        s(`deptCard${i}Title`, t.deptCards[i-1].title);
        s(`deptCard${i}Desc`, t.deptCards[i-1].desc);
        s(`deptCard${i}Stat1`, t.deptCards[i-1].stat1);
        s(`deptCard${i}Lab1`, t.deptCards[i-1].lab1);
        s(`deptCard${i}Stat2`, t.deptCards[i-1].stat2);
        s(`deptCard${i}Lab2`, t.deptCards[i-1].lab2);
    }
    s('deptsCtaTitle', t.deptsCtaTitle); s('deptsCtaDesc', t.deptsCtaDesc); s('deptsCtaBtn', t.deptsCtaBtn);

    s('whyLabel', t.whyLabel); s('whyTitle', t.whyTitle);
    s('feat1Title', t.feat1.title); s('feat1Desc', t.feat1.desc);
    s('feat2Title', t.feat2.title); s('feat2Desc', t.feat2.desc);
    s('feat3Title', t.feat3.title); s('feat3Desc', t.feat3.desc);

    s('fdTitle', t.fdTitle); s('fdSub', t.fdSub);
    s('fdLbl1', t.fdLbl1); s('fdLbl2', t.fdLbl2); s('fdLbl3', t.fdLbl3);
    const fdInput = g('fdInput1');
    if (fdInput) fdInput.placeholder = t.fdPh;
    const fdSel1 = g('fdSel1');
    if (fdSel1 && fdSel1.options[0]) fdSel1.options[0].text = t.fdSelOpt;
    const fdSel2 = g('fdSel2');
    if (fdSel2 && fdSel2.options[0]) fdSel2.options[0].text = t.fdLocOpt;
    const fdBtn = g('fdSearchBtn');
    if (fdBtn) fdBtn.innerHTML = `<i class="fa-solid fa-magnifying-glass"></i><span>${t.fdSearch}</span>`;
    for (let i = 1; i <= 6; i++) {
        s(`doc${i}Name`, t.doctors[i-1].name);
        s(`doc${i}Spec`, t.doctors[i-1].spec);
        s(`doc${i}Badge`, t.doctors[i-1].badge);
        s(`doc${i}Exp`, t.doctors[i-1].exp);
        s(`doc${i}Score`, t.doctors[i-1].score);
        s(`doc${i}Reviews`, t.doctors[i-1].reviews);
        s(`doc${i}ProfileBtn`, t.doctors[i-1].profile);
        s(`doc${i}ConsultBtn`, t.doctors[i-1].consult);
    }
    s('fdBrowse', t.fdBrowse);

    s('testBadge', t.testBadge); s('testTitle', t.testTitle);
    for (let i = 1; i <= 3; i++) {
        s(`testText${i}`, t.tests[i-1].text);
        s(`testName${i}`, t.tests[i-1].name);
        s(`testRole${i}`, t.tests[i-1].role);
    }

    s('ctaTitle', t.ctaTitle); s('ctaDesc', t.ctaDesc);
    s('ctaBtn1', t.ctaBtn1); s('ctaBtn2', t.ctaBtn2);
};

// ====================== FIX: استعادة اللغة فوراً من localStorage ======================
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
    } catch(e) {
        window.currentLanguage = 'en';
        if (typeof window.applyPageTranslation === 'function') {
            window.applyPageTranslation('en');
        }
    }
})();

document.addEventListener('DOMContentLoaded', function() {
    const savedLang = localStorage.getItem('siteLang');
    if (savedLang === 'ar' || savedLang === 'en') {
        if (window.currentLanguage !== savedLang) {
            window.currentLanguage = savedLang;
            window.applyPageTranslation(savedLang);
        }
    } else if (window.currentLanguage) {
        window.applyPageTranslation(window.currentLanguage);
    } else {
        window.applyPageTranslation('en');
    }
});
</script>

{{-- ═══════════════════════════════════════════
     ANIMATION SCRIPTS (unchanged)
     ═══════════════════════════════════════════ --}}
<script>
(function () {
  'use strict';

  const srObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        srObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

  function applyAnimations() {
    const statsSection = document.querySelector('.stats');
    if (statsSection) { statsSection.classList.add('sr-stagger'); srObserver.observe(statsSection); }

    const aboutImages = document.querySelector('.about-images');
    if (aboutImages) { aboutImages.classList.add('sr', 'sr-left'); srObserver.observe(aboutImages); }
    const aboutContent = document.querySelector('.about-content');
    if (aboutContent) { aboutContent.classList.add('sr', 'sr-right'); srObserver.observe(aboutContent); }

    const servicesSection = document.querySelector('.services');
    if (servicesSection) {
      const h = servicesSection.querySelector('h2');
      if (h) { h.classList.add('sr'); srObserver.observe(h); }
      const sub = servicesSection.querySelector('p');
      if (sub) { sub.classList.add('sr'); sub.style.transitionDelay = '0.1s'; srObserver.observe(sub); }
      const cards = servicesSection.querySelectorAll('.card');
      cards.forEach((card, i) => {
        card.classList.add('sr', 'sr-scale');
        card.style.transitionDelay = (0.08 * i) + 's';
        srObserver.observe(card);
      });
    }

    const deptSection = document.querySelector('.departments-section');
    if (deptSection) {
      const deptH = deptSection.querySelector('h2');
      if (deptH) { deptH.classList.add('sr'); srObserver.observe(deptH); }
      const featuredDept = deptSection.querySelector('.dept-featured');
      if (featuredDept) { featuredDept.classList.add('sr', 'sr-up'); srObserver.observe(featuredDept); }
      const deptCards = deptSection.querySelectorAll('.dept-card');
      deptCards.forEach((card, i) => {
        card.classList.add('sr', 'sr-scale');
        card.style.transitionDelay = (0.07 * i) + 's';
        srObserver.observe(card);
      });
      const deptsCta = deptSection.querySelector('.depts-cta');
      if (deptsCta) { deptsCta.classList.add('sr', 'sr-up'); srObserver.observe(deptsCta); }
    }

    const whySection = document.querySelector('.why-choose-us');
    if (whySection) {
      const whyContent = whySection.querySelector('.why-content');
      if (whyContent) { whyContent.classList.add('sr', 'sr-left'); srObserver.observe(whyContent); }
      const whyImg = whySection.querySelector('.why-image');
      if (whyImg) { whyImg.classList.add('sr', 'sr-right'); srObserver.observe(whyImg); }
    }

    const fdSection = document.querySelector('.find-doctor-section');
    if (fdSection) {
      const fdHeads = fdSection.querySelectorAll('h2, .sub');
      fdHeads.forEach((el, i) => {
        el.classList.add('sr');
        el.style.transitionDelay = (0.1 * i) + 's';
        srObserver.observe(el);
      });
      const searchBox = fdSection.querySelector('.search-box');
      if (searchBox) { searchBox.classList.add('sr', 'sr-up'); searchBox.style.transitionDelay = '0.15s'; srObserver.observe(searchBox); }
      const docCards = fdSection.querySelectorAll('.doctor-card');
      docCards.forEach((card, i) => {
        card.classList.add('sr', 'sr-scale');
        card.style.transitionDelay = (0.09 * i) + 's';
        srObserver.observe(card);
      });
    }

    const testSection = document.querySelector('.testimonials-section');
    if (testSection) {
      const testHeader = testSection.querySelector('.testimonials-header');
      if (testHeader) { testHeader.classList.add('sr'); srObserver.observe(testHeader); }
      const testCards = testSection.querySelectorAll('.testimonial-card');
      testCards.forEach((card, i) => {
        card.classList.add('sr', 'sr-scale');
        card.style.transitionDelay = (0.12 * i) + 's';
        srObserver.observe(card);
      });
    }

    const ctaSection = document.querySelector('.get-started');
    if (ctaSection) {
      const ctaBox = ctaSection.querySelector('.cta-box');
      if (ctaBox) { ctaBox.classList.add('sr', 'sr-up'); srObserver.observe(ctaBox); }
    }
  }

  const statsObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) { entry.target.classList.add('animate'); statsObs.unobserve(entry.target); }
    });
  }, { threshold: 0.25 });
  const statsEl = document.querySelector('.stats');
  if (statsEl) statsObs.observe(statsEl);

  function setupHeadingLines() {
    ['.services h2', '.departments-section h2', '.find-doctor-section h2', '.testimonials-section h2'].forEach(sel => {
      const el = document.querySelector(sel);
      if (el) {
        el.classList.add('section-heading-line');
        const lineObs = new IntersectionObserver((entries) => {
          entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); lineObs.unobserve(e.target); } });
        }, { threshold: 0.5 });
        lineObs.observe(el);
      }
    });
  }

  let ticking = false;
  function onScroll() {
    if (!ticking) {
      requestAnimationFrame(() => {
        const heroImg = document.querySelector('.hero-image img');
        if (heroImg) {
          const scrollY = window.scrollY;
          const heroSection = document.querySelector('.hero-start');
          if (heroSection && scrollY < heroSection.offsetHeight) {
            heroImg.style.transform = `translateY(${scrollY * 0.06}px)`;
          }
        }
        ticking = false;
      });
      ticking = true;
    }
  }

  function animateSearchPlaceholder() {
    const input = document.getElementById('fdInput1');
    if (!input) return;
    const phrases = ['Search by name...', 'Dr. Jennifer Morgan...', 'Cardiologist...', 'Search by specialty...'];
    let idx = 0;
    setInterval(() => {
      if (document.activeElement !== input) { idx = (idx + 1) % phrases.length; input.placeholder = phrases[idx]; }
    }, 2800);
  }

  function addRipple(btn) {
    btn.addEventListener('click', function (e) {
      const existing = this.querySelector('.ripple-wave');
      if (existing) existing.remove();
      const ripple = document.createElement('span');
      ripple.classList.add('ripple-wave');
      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height) * 1.5;
      ripple.style.cssText = `position:absolute;border-radius:50%;width:${size}px;height:${size}px;top:${e.clientY-rect.top-size/2}px;left:${e.clientX-rect.left-size/2}px;background:rgba(255,255,255,0.25);transform:scale(0);animation:rippleAnim 0.55s var(--ease-smooth) forwards;pointer-events:none;`;
      this.appendChild(ripple);
      setTimeout(() => ripple.remove(), 600);
    });
  }

  const rippleStyle = document.createElement('style');
  rippleStyle.textContent = '@keyframes rippleAnim { to { transform: scale(1); opacity: 0; } }';
  document.head.appendChild(rippleStyle);

  function setupRipples() {
    document.querySelectorAll('.btn-book, .btn-white, .btn-explore, .btn-depts, .btn-search, .doc-btn.primary').forEach(addRipple);
  }

  function animateCounter(el, target, suffix, duration) {
    const start = performance.now();
    function update(now) {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.floor(eased * target);
      el.textContent = (current >= 1000 ? (current/1000).toFixed(0)+'K' : current) + suffix;
      if (progress < 1) requestAnimationFrame(update);
      else el.textContent = el.dataset.final;
    }
    requestAnimationFrame(update);
  }

  function setupCounters() {
    const counterMap = {
      stat1val: { num: 50, suffix: '+', final: '50+' },
      stat2val: { num: 10, suffix: 'K+', final: '10K+' },
      stat3val: { num: 15, suffix: '+', final: '15+' },
      stat4val: { num: 0,  suffix: '',  final: '24/7' },
    };
    const statsSection = document.querySelector('.stats');
    if (!statsSection) return;
    const cObs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          Object.entries(counterMap).forEach(([id, cfg]) => {
            const el = document.getElementById(id);
            if (!el) return;
            el.dataset.final = cfg.final;
            if (cfg.num > 0) animateCounter(el, cfg.num, cfg.suffix, 1400);
          });
          cObs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });
    cObs.observe(statsSection);
  }

  function init() {
    applyAnimations();
    setupHeadingLines();
    setupRipples();
    setupCounters();
    animateSearchPlaceholder();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
</script>
@endpush
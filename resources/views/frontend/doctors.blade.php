{{-- resources/views/doctorss.blade.php --}}
@extends('layouts.app')

@section('title', 'Doctors · MediCare')

@push('styles')
<style>

    /* ===== المتغيرات والأساسيات ===== */
    :root {
      --primary: #C9A24D;
      --primary-dark: #1F2A44;
      --dark: #1F2A44;
      --light-bg: #f8fafb;
      --text: #333333;
      --text-muted: #6b7280;
      --border-color: #C9A24D;
      --white: #ffffff;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);

      /* Animation tokens */
      --ease-smooth: cubic-bezier(0.25, 0.46, 0.45, 0.94);
      --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
      --ease-sharp:  cubic-bezier(0.22, 1, 0.36, 1);
      --dur-fast:  0.3s;
      --dur-base:  0.55s;
      --dur-slow:  0.8s;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: var(--light-bg);
      color: var(--text);
      line-height: 1.6;
    }

    .container {
      max-width: 1140px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* ===== NAVBAR ===== */
    .navbar {
      padding: 15px 0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .nav-content { display: flex; justify-content: space-between; align-items: center; }
    .logo { display: flex; align-items: center; gap: 10px; font-size: 22px; font-weight: 700; color: #FFFFFF; }
    .logo-box { background: none; padding: 0; width: 50px; height: 50px; }
    .logo-box img { width: 100%; height: 100%; object-fit: contain; }
    .nav-links { display: flex; list-style: none; gap: 30px; }
    .nav-links a { text-decoration: none; color: #FFFFFF; font-weight: 500; font-size: 14px; transition: 0.3s; }
    .nav-links a:hover, .nav-links a.active { color: #C9A24D; border-bottom: 2px solid #C9A24D; padding-bottom: 5px; }
    .user-profile { display: flex; align-items: center; gap: 8px; padding: 8px 14px; border: 1px solid #ECECEC; border-radius: 6px; text-decoration: none; color: #FFFFFF; font-size: 14px; font-weight: 500; transition: all 0.3s ease; }
    .user-profile i { font-size: 14px; color: #FFFFFF; }
    .user-profile:hover { background-color: #C9A24D; color: #FFFFFF; border-color: #C9A24D; }
    .menu-toggle { display: none; flex-direction: column; gap: 5px; cursor: pointer; z-index: 1100; }
    .menu-toggle span { width: 25px; height: 3px; background: #FFFFFF; border-radius: 5px; transition: 0.3s ease; }
    .menu-toggle.is-active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
    .menu-toggle.is-active span:nth-child(2) { opacity: 0; }
    .menu-toggle.is-active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }
    .mobile-only { display: none; }

    @media (max-width: 768px) {
      .menu-toggle { display: flex; }
      .nav-links { position: fixed; top: 0; right: -50%; width: 50%; height: 100vh; background: #1F2A44; flex-direction: column; justify-content: center; align-items: center; transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: -5px 0 15px rgba(0,0,0,0.3); z-index: 1050; gap: 0; padding: 40px 0; }
      .nav-links.active { right: 0; }
      .nav-links li { margin: 20px 0; }
      .nav-links a { font-size: 18px; border: none !important; }
      .nav-links a:hover, .nav-links a.active { border-bottom: 2px solid #C9A24D; padding-bottom: 5px; }
      .user-profile { display: none; }
      .mobile-only { display: block; }
      .mobile-only a { color: #FFFFFF; }
    }
    @media (max-width: 480px) { .nav-links { width: 70%; right: -70%; } }

    /* ===== PAGE HEADER ===== */
    header { text-align: center; margin: 40px 0; }
    header h1 { font-size: clamp(24px, 5vw, 28px); color: #1F2A44; margin-bottom: 10px; font-size: xx-large; }
    header p { font-size: 13px; color: #C9A24D; max-width: 700px; margin: 0 auto; line-height: 1.6; font-size: medium; }

    /* ===== SEARCH BAR ===== */
    .search-bar { 
      background: #1F2A44; 
      padding: 20px; 
      border-radius: 12px; 
      display: flex; 
      flex-wrap: wrap; 
      gap: 15px; 
      box-shadow: 0 4px 15px #C9A24D; 
      margin-bottom: 30px; 
      align-items: flex-end;
      
      /* Added animations for search bar */
      animation: searchBarSlideIn 0.65s var(--ease-bounce) forwards;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    
    .search-bar:hover {
      box-shadow: 0 8px 25px rgba(201, 162, 77, 0.3);
      transform: translateY(-2px);
    }
    
    @keyframes searchBarSlideIn {
      0% {
        opacity: 0;
        transform: translateY(-40px) scale(0.96);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }
    
    .input-group { 
      flex: 1; 
      min-width: 200px;
      transition: all 0.3s ease;
    }
    
    .input-group label { 
      display: block; 
      font-size: 11px; 
      font-weight: bold; 
      margin-bottom: 8px; 
      color: #C9A24D; 
      transition: all 0.2s ease;
    }
    
    .input-group input, .input-group select { 
      width: 100%; 
      padding: 10px; 
      border: 1px solid #C9A24D; 
      border-radius: 6px; 
      font-size: 13px; 
      color: #C9A24D; 
      background: #1F2A44;
      transition: all 0.25s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }
    
    /* Enhanced focus animations for input fields */
    .input-group input:focus, .input-group select:focus {
      outline: none;
      border-color: #C9A24D;
      box-shadow: 0 0 0 3px rgba(201, 162, 77, 0.3), 0 2px 8px rgba(0,0,0,0.1);
      transform: scale(1.01);
      background: #1F2A44;
    }
    
    .input-group input:hover, .input-group select:hover {
      border-color: #e0b354;
      transform: translateY(-1px);
    }
    
    .btn-apply { 
      background: #C9A24D; 
      color: white; 
      border: none; 
      padding: 11px 25px; 
      border-radius: 6px; 
      cursor: pointer; 
      font-weight: 600; 
      min-width: 120px;
      transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
      position: relative;
      overflow: hidden;
    }
    
    .btn-apply:hover {
      background: #b8912e;
      transform: translateY(-2px) scale(1.02);
      box-shadow: 0 6px 18px rgba(201, 162, 77, 0.4);
    }
    
    .btn-apply:active {
      transform: translateY(1px) scale(0.98);
      transition: 0.05s;
    }
    
    /* Filter apply animation class (added via JS) */
    .btn-apply.filter-animation {
      animation: filterPop 0.5s var(--ease-bounce);
    }
    
    @keyframes filterPop {
      0% { transform: scale(1); }
      40% { transform: scale(1.1); box-shadow: 0 8px 25px rgba(201, 162, 77, 0.6); }
      70% { transform: scale(0.96); }
      100% { transform: scale(1); }
    }
    
    /* Staggered fade-in for filter groups */
    .input-group {
      opacity: 0;
      animation: groupFadeIn 0.5s var(--ease-smooth) forwards;
    }
    .input-group:nth-child(1) { animation-delay: 0.05s; }
    .input-group:nth-child(2) { animation-delay: 0.12s; }
    .input-group:nth-child(3) { animation-delay: 0.19s; }
    .btn-apply { 
      opacity: 0;
      animation: groupFadeIn 0.5s var(--ease-smooth) 0.26s forwards;
    }
    
    @keyframes groupFadeIn {
      from { opacity: 0; transform: translateX(-8px); }
      to { opacity: 1; transform: translateX(0); }
    }

    /* ===== TABS ===== */
    .tabs { display: flex; gap: 10px; margin-bottom: 30px; overflow-x: auto; padding-bottom: 10px; }
    .tab { padding: 6px 18px; border-radius: 20px; font-size: 12px; border: 1px solid #C9A24D; cursor: pointer; color: #1F2A44; white-space: nowrap; transition: background .22s, color .22s, border-color .22s; user-select: none; }
    .tab.active { background: #C9A24D !important; color: white !important; border-color: #C9A24D !important; }

    /* ===== DOCTORS GRID ===== */
    .doctors-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 50px; }
    .doc-card {
      background: #1F2A44;
      border-radius: 15px;
      padding: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.03);
      position: relative;
      display: flex;
      flex-direction: column;
      opacity: 0;
      transform: translateY(30px) scale(0.92);
      transition: opacity 0.5s ease, transform 0.5s ease;
    }
    .doc-card.card-visible {
      opacity: 1;
      transform: translateY(0) scale(1);
      animation: cardFadeUp 0.9s var(--ease-bounce) forwards;
    }
    @media (max-width: 768px) {
      .doc-card.card-visible {
        animation-duration: 1.2s;
      }
    }
    @keyframes cardFadeUp {
      0% {
        opacity: 0;
        transform: translateY(30px) scale(0.92);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }
    .doc-card.hidden { display: none; }
    .badge-senior { position: absolute; top: 10px; left: 10px; background: #C9A24D; color: white; font-size: 9px; padding: 3px 8px; border-radius: 4px; z-index: 1; }
    .doc-img { width: 100%; height: 220px; object-fit: cover; border-radius: 12px; margin-bottom: 15px; background: #f0f0f0; }
    .doc-name { font-size: 15px; font-weight: 700; color: white; }
    .doc-spec { font-size: 11px; color: #C9A24D; margin-bottom: 8px; }
    .doc-desc { font-size: 11px; color: #f0f0f0; line-height: 1.4; margin-bottom: 12px; }
    .tag { background: #C9A24D; color: #1F2A44; font-size: 10px; padding: 3px 10px; border-radius: 4px; display: inline-block; margin-bottom: 15px; width: fit-content; }
    .card-btns { display: flex; gap: 8px; margin-top: auto; }
    .btn-book { flex: 1; background: #C9A24D; color: white; border: none; font-size: 10px; padding: 8px; border-radius: 5px; cursor: pointer; }
    .btn-profile { flex: 1; background: white; border: 1px solid #C9A24D; color: #1F2A44; font-size: 10px; padding: 8px; border-radius: 5px; cursor: pointer; }

    .no-results { display: none; text-align: center; padding: 56px 20px; color: #6b7a8d; }
    .no-results i { font-size: 3rem; color: #c9a24d; display: block; margin-bottom: 14px; }
    .no-results p { font-size: 1rem; margin: 0; }

    /* ===== FEATURED PROFILE ===== */
    .featured-profile { margin-top: 48px; background: #fff; border: 1.5px solid #f0ece4; border-radius: 20px; overflow: hidden; display: grid; grid-template-columns: 320px 1fr; box-shadow: 0 4px 28px rgba(201,162,77,.08); }
    .fp-img { position: relative; }
    .fp-img img { width: 100%; height: 100%; min-height: 340px; object-fit: cover; object-position: top; display: block; }
    .fp-avail { position: absolute; bottom: 16px; left: 16px; background: #fff; color: #22c55e; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 30px; display: flex; align-items: center; gap: 6px; box-shadow: 0 2px 12px rgba(0,0,0,.1); }
    body[dir="rtl"] .fp-avail { left: auto; right: 16px; }
    .fp-body { padding: 36px 40px; display: flex; flex-direction: column; justify-content: center; }
    .fp-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
    .fp-badge { font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 20px; }
    .fp-badge.teal { background: #0d9488; color: #fff; }
    .fp-badge.blue { background: #e8f0f8; color: #1a5fa0; }
    .fp-body h2 { font-size: 1.6rem; font-weight: 800; color: #1a2e44; margin: 0 0 4px; }
    .fp-spec { color: #c9a24d; font-weight: 700; font-size: .95rem; margin: 0 0 14px; }
    .fp-desc { color: #6b7a8d; line-height: 1.75; margin: 0 0 20px; font-size: .93rem; }
    .fp-details { list-style: none; padding: 0; margin: 0 0 24px; display: flex; flex-direction: column; gap: 9px; }
    .fp-details li { display: flex; align-items: center; gap: 10px; color: #3a4a5c; font-size: .9rem; }
    .fp-details li i { color: #c9a24d; min-width: 16px; }
    .fp-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ===== MINI PROFILES ===== */
    .mini-profiles { margin-top: 48px; display: grid; grid-template-columns: repeat(4,1fr); gap: 18px; }
    .mini-item { background: #fff; border: 1.5px solid #f0ece4; border-radius: 16px; padding: 22px 16px; text-align: center; cursor: pointer; transition: transform .25s, box-shadow .25s, border-color .25s; }
    .mini-item:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(201,162,77,.13); border-color: #c9a24d; }
    .mini-item .mini-img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; object-position: top; border: 3px solid #f0ece4; display: block; margin: 0 auto 12px; transition: border-color .25s; }
    .mini-item:hover .mini-img { border-color: #c9a24d; }
    .mini-item .mini-name { font-size: .88rem; font-weight: 700; color: #1a2e44; margin-bottom: 4px; }
    .mini-item .mini-sub  { font-size: .78rem; color: #c9a24d; font-weight: 600; }

    /* ===== SECTION HELPERS ===== */
    .mc-section { padding: 72px 0 0; }
    .mc-section-title { font-size: 1.5rem; font-weight: 800; color: #1a2e44; margin: 0 0 6px; }
    .mc-section-sub   { color: #6b7a8d; font-size: .95rem; margin: 0 0 36px; }

    /* ===== BUTTONS ===== */
    .btn-gold { background: #c9a24d; color: #fff; padding: 11px 24px; border-radius: 30px; font-weight: 700; font-size: .88rem; border: none; cursor: pointer; text-decoration: none; transition: background .25s; display: inline-flex; align-items: center; gap: 7px; }
    .btn-gold:hover { background: #b8912e; color: #fff; }
    .btn-outline-gold { background: transparent; color: #c9a24d; padding: 11px 24px; border-radius: 30px; border: 2px solid #c9a24d; font-weight: 700; font-size: .88rem; cursor: pointer; text-decoration: none; transition: all .25s; display: inline-flex; align-items: center; gap: 7px; }
    .btn-outline-gold:hover { background: #c9a24d; color: #fff; }

    /* ===== BLINK DOT ===== */
    .dot { width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block; animation: blink 1.6s infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.35} }

    /* ===== SINGLE PROFILE ===== */
    .single-profile-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 48px; align-items: center; }
    .sp-media { position: relative; border-radius: 20px; overflow: hidden; }
    .sp-media img { width: 100%; height: 430px; object-fit: cover; object-position: top; display: block; }
    .sp-avail-tag { position: absolute; bottom: 18px; left: 18px; background: #fff; color: #22c55e; font-size: 12px; font-weight: 700; padding: 7px 16px; border-radius: 30px; display: flex; align-items: center; gap: 6px; box-shadow: 0 2px 12px rgba(0,0,0,.1); }
    body[dir="rtl"] .sp-avail-tag { left: auto; right: 18px; }
    .sp-body { padding: 8px 0 0; }
    .sp-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }
    .sp-badge { font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 20px; }
    .sp-badge.dark  { background: #1a2e44; color: #fff; }
    .sp-badge.blue  { background: #e8f0f8; color: #1a5fa0; }
    .sp-badge.green { background: #e8f6ee; color: #16803b; }
    .sp-body h2 { font-size: 1.75rem; font-weight: 800; color: #1a2e44; margin: 0 0 5px; }
    .sp-spec-txt { color: #c9a24d; font-weight: 700; font-size: 1rem; margin: 0 0 18px; display: block; }
    .sp-bio-txt  { color: #6b7a8d; line-height: 1.8; margin: 0 0 22px; font-size: .93rem; }
    .sp-highlights { list-style: none; padding: 0; margin: 0 0 28px; display: flex; flex-direction: column; gap: 12px; }
    .sp-highlights li { display: flex; align-items: center; gap: 12px; color: #3a4a5c; font-size: .93rem; }
    .sp-highlights li i { color: #c9a24d; min-width: 18px; }
    .sp-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ===== COMPACT GRID ===== */
    .compact-grid { display: grid; grid-template-columns: repeat(6,1fr); gap: 16px; }
    .mini-card-new { background: #fff; border: 1.5px solid #f0ece4; border-radius: 16px; padding: 20px 10px; text-align: center; cursor: pointer; transition: transform .25s, box-shadow .25s, border-color .25s; }
    .mini-card-new:hover { transform: translateY(-5px); box-shadow: 0 10px 28px rgba(201,162,77,.13); border-color: #c9a24d; }
    .mini-card-new img { width: 66px; height: 66px; border-radius: 50%; object-fit: cover; object-position: top; border: 3px solid #f0ece4; display: block; margin: 0 auto 10px; transition: border-color .25s; }
    .mini-card-new:hover img { border-color: #c9a24d; }
    .mini-card-new .mcn-name { font-size: .78rem; font-weight: 700; color: #1a2e44; margin-bottom: 3px; line-height: 1.3; }
    .mini-card-new .mcn-spec { font-size: .72rem; color: #c9a24d; font-weight: 600; }

    /* ===== BOTTOM PROFILE ===== */
    .bottom-profile { background: #fff; border: 1.5px solid #ede9e0; border-radius: 20px; overflow: hidden; display: grid; grid-template-columns: 300px 1fr; box-shadow: 0 2px 20px rgba(201,162,77,.07); }
    .bp-left { background: #f8f7f4; border-right: 1.5px solid #ede9e0; padding: 40px 28px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
    body[dir="rtl"] .bp-left { border-right: none; border-left: 1.5px solid #ede9e0; }
    .bp-img-wrap { width: 120px; height: 120px; border-radius: 50%; border: 3px solid #c9a24d; padding: 4px; margin-bottom: 18px; background: #fff; }
    .bp-img-wrap img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; object-position: top; display: block; }
    .bp-name { font-size: 1.05rem; font-weight: 800; color: #1a2e44; margin-bottom: 4px; }
    .bp-spec-txt { font-size: .82rem; color: #6b7a8d; margin-bottom: 20px; }
    .bp-tags { display: flex; flex-direction: column; gap: 8px; width: 100%; }
    .bp-tag { background: #fff; border: 1.5px solid #e8d9aa; color: #8a6d2e; font-size: 11px; font-weight: 700; padding: 7px 12px; border-radius: 20px; text-align: center; }
    .bp-right { padding: 32px 36px; background: #fff; }
    .bp-tabs { display: flex; border-bottom: 1.5px solid #ede9e0; margin-bottom: 24px; gap: 0; }
    .bp-tab { padding: 10px 24px 12px; font-size: .95rem; font-weight: 700; color: #6b7a8d; cursor: pointer; background: none; border: none; border-bottom: 2.5px solid transparent; margin-bottom: -1.5px; transition: color .2s, border-color .2s; }
    .bp-tab.active { color: #c9a24d; border-bottom-color: #c9a24d; }
    .bp-tab:hover  { color: #c9a24d; }
    .bp-pane { display: none; }
    .bp-pane.active { display: block; }
    .bp-pane > p { color: #6b7a8d; line-height: 1.85; font-size: .93rem; margin: 0 0 20px; }
    .bp-checklist { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
    .bp-checklist li { display: flex; align-items: center; gap: 12px; color: #3a4a5c; font-size: .92rem; }
    .bp-checklist li i { color: #c9a24d; font-size: 16px; min-width: 18px; }
    .bp-slots { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px; }
    .bp-slot { background: #f8f9fb; border: 1px solid #ede9e0; border-radius: 10px; padding: 12px 14px; display: flex; justify-content: space-between; align-items: center; }
    .bp-slot strong { font-size: .85rem; color: #1a2e44; font-weight: 700; }
    .bp-slot span   { font-size: .8rem;  color: #6b7a8d; }
    .bp-slot.closed span { color: #e55353; }
    .bp-stars { display: flex; gap: 3px; margin-bottom: 8px; }
    .bp-stars i { color: #c9a24d; font-size: 16px; }
    .bp-rev-meta { font-size: .82rem; color: #6b7a8d; margin-bottom: 12px; }
    .bp-rev-text { color: #3a4a5c; line-height: 1.75; font-size: .9rem; }

    /* ===== SEARCH ICON ===== */
    .search-icon-wrap { position: relative; }
    .search-icon-wrap .si { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #c9a24d; font-size: 14px; pointer-events: none; }
    body[dir="rtl"] .search-icon-wrap .si { left: auto; right: 14px; }
    .search-icon-wrap input { padding-left: 38px !important; }
    body[dir="rtl"] .search-icon-wrap input { padding-left: 14px !important; padding-right: 38px !important; }

    /* ===== LANG BTN ===== */
    .lang-btn { background: transparent; color: #c9a24d; border: 1px solid #c9a24d; padding: 6px 15px; border-radius: 30px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: bold; flex-shrink: 0; min-width: 100px; justify-content: center; transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1); }
    .lang-btn:hover { background: #c9a24d; color: #ffffff; transform: scale(1.05); box-shadow: 0 6px 14px rgba(201,162,77,0.35); border-color: #c9a24d; }
    .lang-btn:active { transform: scale(0.98); transition: 0.05s; }

    /* ===== FOOTER ===== */
    .footer { background-color: #1F2A44; color: #FFFFFF; padding: 60px 5% 20px; }
    .footer-container { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 40px; max-width: 1200px; margin: 0 auto; }
    .footer-col { flex: 1; min-width: 200px; }
    .footer-col h4 { font-size: 18px; margin-bottom: 20px; color: #C9A24D; }
    .footer-col ul { list-style: none; }
    .footer-col ul li { margin-bottom: 10px; }
    .footer-col ul li a { color: #ECECEC; text-decoration: none; transition: color 0.3s; }
    .footer-col ul li a:hover { color: #FFFFFF; }
    .footer-col p { color: #ECECEC; font-size: 14px; }
    .footer-bottom { text-align: center; padding: 20px; border-top: 1px solid #C9A24D; margin-top: 40px; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
      .doctors-grid { grid-template-columns: repeat(2, 1fr); }
      .featured-profile { grid-template-columns: 1fr; }
      .single-profile-grid { grid-template-columns: 1fr; }
      .sp-media img { height: 280px; }
      .mini-profiles { grid-template-columns: repeat(2,1fr); }
      .compact-grid { grid-template-columns: repeat(3,1fr); }
      .bottom-profile { grid-template-columns: 1fr; }
      .bp-left { border-right: none; border-bottom: 1.5px solid #ede9e0; padding: 28px 20px; }
      body[dir="rtl"] .bp-left { border-left: none; }
    }
    @media (max-width: 600px) {
      .doctors-grid { grid-template-columns: 1fr; }
      .search-bar { flex-direction: column; align-items: center; text-align: center; padding: 20px 15px; }
      .input-group { width: 100%; min-width: 100%; }
      .input-group label { text-align: center; font-size: 13px; }
      .btn-apply { width: 100%; margin-top: 10px; }
      .tabs { justify-content: center; }
      .mini-profiles { grid-template-columns: repeat(2,1fr); }
      .compact-grid      { grid-template-columns: repeat(2,1fr); }
      .bp-slots      { grid-template-columns: 1fr; }
      .fp-body       { padding: 24px 20px; }
      .bp-right      { padding: 24px 20px; }
    }
    @media (max-width: 768px) {
      body[dir="rtl"] .nav-links { display: flex !important; flex-direction: column !important; justify-content: center !important; align-items: center !important; gap: 30px !important; right: auto !important; left: -70% !important; width: 70% !important; transition: 0.4s ease-in-out !important; }
      body[dir="rtl"] .nav-links.active { left: 0 !important; right: auto !important; }
      body[dir="rtl"] .nav-links li { width: 100%; text-align: center; }
    }

    /* ================================================================
       OTHER ANIMATIONS (Ripple, etc.)
       ================================================================ */
    @keyframes rplAnim { to { transform: scale(1); opacity: 0; } }
    .btn-book, .btn-gold, .btn-apply { position: relative; overflow: hidden; }
    .btn-book .rpl, .btn-gold .rpl, .btn-apply .rpl { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.22); transform: scale(0); animation: rplAnim 0.5s ease forwards; pointer-events: none; }

    /* Scroll reveal for other sections */
    .sr {
      opacity: 0;
      transform: translateY(32px);
      transition: opacity var(--dur-slow) var(--ease-smooth),
                  transform var(--dur-slow) var(--ease-smooth);
    }
    .sr.visible { opacity: 1; transform: translateY(0); }
    .sr-stagger > * {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity var(--dur-base) var(--ease-smooth),
                  transform var(--dur-base) var(--ease-smooth);
    }
    .sr-stagger.visible > * { opacity: 1; transform: translateY(0); }
    .sr-stagger.visible > *:nth-child(1) { transition-delay: 0.05s; }
    .sr-stagger.visible > *:nth-child(2) { transition-delay: 0.13s; }
    .sr-stagger.visible > *:nth-child(3) { transition-delay: 0.21s; }
    .sr-stagger.visible > *:nth-child(4) { transition-delay: 0.29s; }

    /* Animations for other elements */
    .tab, .mini-item, .mini-card-new, .bp-slot, .bp-img-wrap { transition: all 0.25s ease; }
    .featured-profile, .bottom-profile { transition: box-shadow 0.4s ease; }
    .fp-img img, .sp-media img { transition: transform 0.6s ease; }
    .featured-profile:hover .fp-img img { transform: scale(1.04); }
    .doc-card .doc-img { transition: transform 0.55s ease; }
    .doc-card:hover .doc-img { transform: scale(1.05); }
    .doc-card:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 45px rgba(201,162,77,0.2); }
    .btn-book:hover, .btn-apply:hover { transform: translateY(-1px) scale(1.03); box-shadow: 0 6px 18px rgba(201,162,77,0.35); }
    .fp-avail, .sp-avail-tag { animation: pulse-gold 2.5s ease-in-out infinite; }
    @keyframes pulse-gold { 0%,100%{box-shadow:0 0 0 0 rgba(201,162,77,0);} 50%{box-shadow:0 0 0 5px rgba(201,162,77,0.2);} }
    @keyframes iconPop { 0%,100%{transform:scale(1);} 40%{transform:scale(1.25);} 70%{transform:scale(0.95);} }
    .anim-heading { position: relative; display: inline-block; }
    .anim-heading::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 3px; background: #c9a24d; border-radius: 2px; transition: width 0.7s var(--ease-smooth) 0.3s; }
    .anim-heading.visible::after { width: 100%; }

    @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }
</style>
@endpush

@section('content')
<div class="container">

  <!-- Header -->
  <header>
    <h1 id="doc-h1">Doctors</h1>
    <p id="doc-sub">Find the right specialist for your needs. Browse our team of board-certified professionals dedicated to your health and wellbeing.</p>
  </header>

  <!-- Search Bar -->
  <div class="search-bar">
    <div class="input-group">
      <label id="lbl-search">Search Doctors</label>
      <div class="search-icon-wrap">
        <i class="fas fa-magnifying-glass si"></i>
        <input type="text" id="search-input" placeholder="Type a name or keyword" />
      </div>
    </div>
    <div class="input-group">
      <label id="lbl-dept">Department</label>
      <select id="dept-select">
        <option value="all">All Departments</option>
        <option value="cardiology">Cardiology</option>
        <option value="pediatrics">Pediatrics</option>
        <option value="dermatology">Dermatology</option>
        <option value="orthopedics">Orthopedics</option>
      </select>
    </div>
    <div class="input-group">
      <label id="lbl-loc">Location</label>
      <select id="loc-select">
        <option value="all">All Locations</option>
        <option value="downtown">Downtown Clinic</option>
        <option value="westside">Westside Center</option>
        <option value="riverside">Riverside Campus</option>
      </select>
    </div>
    <button class="btn-apply" id="btn-apply" onclick="applyFilters()">Apply Filters</button>
  </div>

  <!-- Tabs -->
  <div class="tabs" id="tabs-bar">
    <div class="tab active" data-filter="all">All</div>
    <div class="tab" data-filter="cardiology">Cardiology</div>
    <div class="tab" data-filter="pediatrics">Pediatrics</div>
    <div class="tab" data-filter="dermatology">Dermatology</div>
    <div class="tab" data-filter="orthopedics">Orthopedics</div>
  </div>

  <!-- Doctors Grid -->
  <div class="doctors-grid" id="doctors-grid">
    <div class="doc-card" data-dept="cardiology" data-name="Dr. Amelia Brooks" data-loc="downtown">
      <span class="badge-senior" id="badge-senior">Senior Consultant</span>
      <img src="{{ asset('mon/images/dr1.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Amelia Brooks</div>
      <div class="doc-spec">Cardiologist · MD, FACC</div>
      <div class="doc-desc">Nostrud tempor magna minim excepteur id cillum laboris aute proident.</div>
      <div class="tag">Cardiology</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="pediatrics" data-name="Dr. Noah Turner" data-loc="westside">
      <img src="{{ asset('mon/images/dr4.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Noah Turner</div>
      <div class="doc-spec">Pediatrician · DO</div>
      <div class="doc-desc">Quis irure pariatur sed eiusmod, elit laboris consequat cupidatat.</div>
      <div class="tag">Pediatrics</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="dermatology" data-name="Dr. Sofia Bennett" data-loc="riverside">
      <span id="badge-new" style="position:absolute;top:14px;right:14px;background:#0d9488;color:#fff;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;">New</span>
      <img src="{{ asset('mon/images/dr2.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Sofia Bennett</div>
      <div class="doc-spec">Dermatologist · MBBS, MD</div>
      <div class="doc-desc">Dolor commodo laboris lorem ed, amet consequat mollit deserunt.</div>
      <div class="tag">Dermatology</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="orthopedics" data-name="Dr. Ethan Cole" data-loc="downtown">
      <img src="{{ asset('mon/images/dr3.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Ethan Cole</div>
      <div class="doc-spec">Orthopedic Surgeon · MS, FRCS</div>
      <div class="doc-desc">Velit laborum minim laboris, eiusmod elit irure in exercitation.</div>
      <div class="tag">Orthopedics</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="cardiology" data-name="Dr. Maya Patel" data-loc="westside">
      <img src="{{ asset('mon/images/dr1.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Maya Patel</div>
      <div class="doc-spec">Interventional Cardiologist · MD</div>
      <div class="doc-desc">Cupidatat fugiat sint enim laboris, sed do ut aliquip dolor.</div>
      <div class="tag">Cardiology</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="pediatrics" data-name="Dr. Oliver Hayes" data-loc="riverside">
      <img src="{{ asset('mon/images/dr4.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Oliver Hayes</div>
      <div class="doc-spec">Pediatric Specialist · MD</div>
      <div class="doc-desc">Exercitation id ea nisi fugiat, ullamco veniam cillum nostrud.</div>
      <div class="tag">Pediatrics</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="dermatology" data-name="Dr. Harper Lane" data-loc="downtown">
      <img src="{{ asset('mon/images/dr2.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Harper Lane</div>
      <div class="doc-spec">Cosmetic Dermatologist · MD</div>
      <div class="doc-desc">Aliquip laboris anim minim, irure commodo qui occaecat velit.</div>
      <div class="tag">Dermatology</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="orthopedics" data-name="Dr. Liam Carter" data-loc="westside">
      <img src="{{ asset('mon/images/dr3.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Liam Carter</div>
      <div class="doc-spec">Sports Medicine · MD</div>
      <div class="doc-desc">Deserunt pariatur eiusmod duis, officia aute laboris consectetur.</div>
      <div class="tag">Orthopedics</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
  </div>

  <div class="no-results" id="no-results">
    <i class="fas fa-user-doctor"></i>
    <p id="no-results-txt">No doctors found matching your search.</p>
  </div>

  <!-- FEATURED PROFILE -->
  <div class="featured-profile">
    <div class="fp-img">
      <img src="{{ asset('mon/images/dr1.jpg') }}" alt="Dr. Sofia Bennett" />
      <div class="fp-avail"><span class="dot"></span><span id="fp-avail-txt">Available this week</span></div>
    </div>
    <div class="fp-body">
      <div class="fp-badges">
        <span class="fp-badge teal" id="fp-b1">Chief Surgeon</span>
        <span class="fp-badge blue" id="fp-b2">12+ Years Experience</span>
        <span class="fp-badge blue" id="fp-b3">Board Certified</span>
      </div>
      <h2 id="fp-name">Dr. Sofia Bennett</h2>
      <p class="fp-spec" id="fp-spec">General Surgery · MD, FACS</p>
      <p class="fp-desc" id="fp-desc">Commodo incididunt aliqua minim eiusmod in laboris nulla. Amet do occaecat quis, excepteur in magna id dolore incididunt.</p>
      <ul class="fp-details">
        <li><i class="fas fa-hospital"></i><span id="fp-d1">Residency: St. Mary's Medical Center</span></li>
        <li><i class="fas fa-user-md"></i><span id="fp-d2">Fellowship: Advanced Laparoscopy</span></li>
        <li><i class="fas fa-file-alt"></i><span id="fp-d3">Publications: 14 peer-reviewed articles</span></li>
      </ul>
      <div class="fp-actions">
        <a href="#" class="btn-gold" id="fp-book"><i class="fas fa-calendar-check"></i>Book Appointment</a>
        <a href="#" class="btn-outline-gold" id="fp-cv"><i class="fas fa-file-lines"></i>View CV</a>
      </div>
    </div>
  </div>

  <!-- MINI PROFILES ROW -->
  <div class="mini-profiles">
    <div class="mini-item">
      <img src="{{ asset('mon/images/dr1.jpg') }}" class="mini-img" alt="" />
      <div class="mini-name" id="mn1">Dr. Oliver Hayes</div>
      <div class="mini-sub"  id="ms1">Pediatrics</div>
    </div>
    <div class="mini-item">
      <img src="{{ asset('mon/images/dr3.jpg') }}" class="mini-img" alt="" />
      <div class="mini-name" id="mn2">Dr. Noah Turner</div>
      <div class="mini-sub"  id="ms2">Pediatrics</div>
    </div>
    <div class="mini-item">
      <img src="{{ asset('mon/images/dr2.jpg') }}" class="mini-img" alt="" />
      <div class="mini-name" id="mn3">Dr. Amelia Brooks</div>
      <div class="mini-sub"  id="ms3">Cardiology</div>
    </div>
    <div class="mini-item">
      <img src="{{ asset('mon/images/dr4.jpg') }}" class="mini-img" alt="" />
      <div class="mini-name" id="mn4">Dr. Harper Lane</div>
      <div class="mini-sub"  id="ms4">Dermatology</div>
    </div>
  </div>

  <!-- SINGLE DOCTOR PROFILE -->
  <section class="mc-section">
    <div class="single-profile-grid">
      <div class="sp-media">
        <img src="{{ asset('mon/images/dr3.jpg') }}" alt="Dr. Natalia Rivera" />
        <div class="sp-avail-tag"><span class="dot"></span><span id="sp-avail">Available this week</span></div>
      </div>
      <div class="sp-body">
        <div class="sp-badges">
          <span class="sp-badge dark"  id="sp-b1">Chief Surgeon</span>
          <span class="sp-badge blue"  id="sp-b2">12+ Years Experience</span>
          <span class="sp-badge green" id="sp-b3">Board Certified</span>
        </div>
        <h2 id="sp-name">Dr. Natalia Rivera</h2>
        <span class="sp-spec-txt" id="sp-spec">General Surgery · MD, FACS</span>
        <p class="sp-bio-txt" id="sp-bio">Commodo incididunt aliqua minim, eiusmod in laboris nulla. Amet do occaecat quis, excepteur in magna id dolore incididunt. Tempor in aute ullamco, irure officia aliqua nostrud exercitation.</p>
        <ul class="sp-highlights">
          <li><i class="fas fa-graduation-cap"></i><span id="sp-d1">Residency: St. Mary's Medical Center</span></li>
          <li><i class="fas fa-hospital"></i><span id="sp-d2">Fellowship: Advanced Laparoscopy</span></li>
          <li><i class="fas fa-award"></i><span id="sp-d3">Publications: 14 peer-reviewed articles</span></li>
        </ul>
        <div class="sp-actions">
          <a href="#" class="btn-gold" id="sp-book"><i class="fas fa-calendar-check"></i>Book Appointment</a>
          <a href="#" class="btn-outline-gold" id="sp-cv"><i class="fas fa-file-lines"></i>View CV</a>
        </div>
      </div>
    </div>
  </section>

  <!-- COMPACT MINI CARDS -->
  <section class="mc-section">
    <h3 class="mc-section-title anim-heading" id="compact-title">Meet Our Team</h3>
    <p class="mc-section-sub" id="compact-sub">A dedicated group of specialists committed to your health</p>
    <div class="compact-grid">
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr1.jpg') }}" alt=""/><div class="mcn-name" id="cm1">Dr. Oliver Hayes</div><div class="mcn-spec" id="cs1">Pediatrics</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr4.jpg') }}" alt=""/><div class="mcn-name" id="cm2">Dr. Noah Turner</div><div class="mcn-spec" id="cs2">Pediatrics</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr3.jpg') }}" alt=""/><div class="mcn-name" id="cm3">Dr. Liam Carter</div><div class="mcn-spec" id="cs3">Orthopedics</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr1.jpg') }}" alt=""/><div class="mcn-name" id="cm4">Dr. Amelia Brooks</div><div class="mcn-spec" id="cs4">Cardiology</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr2.jpg') }}" alt=""/><div class="mcn-name" id="cm5">Dr. Harper Lane</div><div class="mcn-spec" id="cs5">Dermatology</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr4.jpg') }}" alt=""/><div class="mcn-name" id="cm6">Dr. Lucas Grant</div><div class="mcn-spec" id="cs6">Pulmonology</div></div>
    </div>
    <br><br>
  </section>

  <!-- BOTTOM PROFILE -->
  <div class="bottom-profile mc-section">
    <div class="bp-left">
      <div class="bp-img-wrap">
        <img src="{{ asset('mon/images/dr4.jpg') }}" alt="Dr. Henry James" />
      </div>
      <div class="bp-name"     id="bp-name">Dr. Henry James</div>
      <div class="bp-spec-txt" id="bp-spec">Oncology · MBBS, MD</div>
      <div class="bp-tags">
        <span class="bp-tag" id="bp-tag1">Board Certified</span>
        <span class="bp-tag" id="bp-tag2">8 Years Experience</span>
      </div>
    </div>
    <div class="bp-right">
      <div class="bp-tabs">
        <button class="bp-tab active" data-pane="bp-bio"      id="bpt1">Bio</button>
        <button class="bp-tab"        data-pane="bp-schedule" id="bpt2">Schedule</button>
        <button class="bp-tab"        data-pane="bp-reviews"  id="bpt3">Reviews</button>
      </div>
      <div class="bp-pane active" id="bp-bio">
        <p id="bp-desc">Fugiat proident aliqua laboris, excepteur sunt ad pariatur occaecat. Veniam minim eu laboris, magna irure velit anim excepteur exercitation.</p>
        <ul class="bp-checklist">
          <li><i class="fas fa-circle-check"></i><span id="bp-c1">Special interest in immunotherapy</span></li>
          <li><i class="fas fa-circle-check"></i><span id="bp-c2">Member of ASCO</span></li>
          <li><i class="fas fa-circle-check"></i><span id="bp-c3">Community outreach programs</span></li>
        </ul>
      </div>
      <div class="bp-pane" id="bp-schedule">
        <div class="bp-slots">
          <div class="bp-slot"><strong id="d-mon">Mon</strong><span>9:00 AM – 1:00 PM</span></div>
          <div class="bp-slot"><strong id="d-tue">Tue</strong><span>12:00 PM – 6:00 PM</span></div>
          <div class="bp-slot"><strong id="d-wed">Wed</strong><span>9:00 AM – 3:00 PM</span></div>
          <div class="bp-slot"><strong id="d-thu">Thu</strong><span>10:00 AM – 4:00 PM</span></div>
          <div class="bp-slot closed"><strong id="d-fri">Fri</strong><span id="d-closed">Closed</span></div>
        </div>
        <a href="#" class="btn-gold" id="bp-slot-btn"><i class="fas fa-calendar-days"></i>Reserve a Slot</a>
      </div>
      <div class="bp-pane" id="bp-reviews">
        <div class="bp-stars">
          <i class="fas fa-star"></i><i class="fas fa-star"></i>
          <i class="fas fa-star"></i><i class="fas fa-star"></i>
          <i class="fas fa-star-half-stroke"></i>
        </div>
        <p class="bp-rev-meta" id="bp-rev-meta">4.5 / 5 · 32 reviews</p>
        <p class="bp-rev-text" id="bp-rev-text">Id magna consequat minim in, lorem dolore fugiat. Officia irure ex anim, velit nulla cupidatat laboris enim commodo ut elit.</p>
      </div>
    </div>
  </div>

</div><!-- /container -->
@endsection

@push('scripts')
<script>
// ====================== PAGE TRANSLATIONS ======================
const pageTranslations = {
  en: {
    h1:'Doctors', sub:'Find the right specialist for your needs. Browse our team of board-certified professionals dedicated to your health and wellbeing.',
    lblS:'Search Doctors', lblD:'Department', lblL:'Location', ph:'Type a name or keyword',
    depts:['All Departments','Cardiology','Pediatrics','Dermatology','Orthopedics'],
    locs:['All Locations','Downtown Clinic','Westside Center','Riverside Campus'],
    apply:'Apply Filters', tabs:['All','Cardiology','Pediatrics','Dermatology','Orthopedics'],
    bSenior:'Senior Consultant', bNew:'New',
    cNames:['Dr. Amelia Brooks','Dr. Noah Turner','Dr. Sofia Bennett','Dr. Ethan Cole','Dr. Maya Patel','Dr. Oliver Hayes','Dr. Harper Lane','Dr. Liam Carter'],
    cSpecs:['Cardiologist · MD, FACC','Pediatrician · DO','Dermatologist · MBBS, MD','Orthopedic Surgeon · MS, FRCS','Interventional Cardiologist · MD','Pediatric Specialist · MD','Cosmetic Dermatologist · MD','Sports Medicine · MD'],
    cTags:['Cardiology','Pediatrics','Dermatology','Orthopedics','Cardiology','Pediatrics','Dermatology','Orthopedics'],
    cBook:'Book Appointment', cProf:'View Profile', noRes:'No doctors found matching your search.',
    fpAvail:'Available this week', fpB:['Chief Surgeon','12+ Years Experience','Board Certified'],
    fpName:'Dr. Sofia Bennett', fpSpec:'General Surgery · MD, FACS',
    fpDesc:'Commodo incididunt aliqua minim eiusmod in laboris nulla. Amet do occaecat quis, excepteur in magna id dolore incididunt.',
    fpD:["Residency: St. Mary's Medical Center","Fellowship: Advanced Laparoscopy","Publications: 14 peer-reviewed articles"],
    fpBook:'Book Appointment', fpCV:'View CV',
    miniN:['Dr. Oliver Hayes','Dr. Noah Turner','Dr. Amelia Brooks','Dr. Harper Lane'],
    miniS:['Pediatrics','Pediatrics','Cardiology','Dermatology'],
    spAvail:'Available this week', spB:['Chief Surgeon','12+ Years Experience','Board Certified'],
    spName:'Dr. Natalia Rivera', spSpec:'General Surgery · MD, FACS',
    spBio:'Commodo incididunt aliqua minim, eiusmod in laboris nulla. Amet do occaecat quis, excepteur in magna id dolore incididunt. Tempor in aute ullamco, irure officia aliqua nostrud exercitation.',
    spD:["Residency: St. Mary's Medical Center","Fellowship: Advanced Laparoscopy","Publications: 14 peer-reviewed articles"],
    spBook:'Book Appointment', spCV:'View CV',
    ctTitle:'Meet Our Team', ctSub:'A dedicated group of specialists committed to your health',
    ctN:['Dr. Oliver Hayes','Dr. Noah Turner','Dr. Liam Carter','Dr. Amelia Brooks','Dr. Harper Lane','Dr. Lucas Grant'],
    ctS:['Pediatrics','Pediatrics','Orthopedics','Cardiology','Dermatology','Pulmonology'],
    bpName:'Dr. Henry James', bpSpec:'Oncology · MBBS, MD', bpTags:['Board Certified','8 Years Experience'],
    bpTabs:['Bio','Schedule','Reviews'],
    bpDesc:'Fugiat proident aliqua laboris, excepteur sunt ad pariatur occaecat. Veniam minim eu laboris, magna irure velit anim excepteur exercitation.',
    bpC:['Special interest in immunotherapy','Member of ASCO','Community outreach programs'],
    days:['Mon','Tue','Wed','Thu','Fri'], closed:'Closed', slotBtn:'Reserve a Slot',
    revMeta:'4.5 / 5 · 32 reviews',
    revText:'Id magna consequat minim in, lorem dolore fugiat. Officia irure ex anim, velit nulla cupidatat laboris enim commodo ut elit.'
  },
  ar: {
    h1:'الأطباء', sub:'ابحث عن الطبيب المناسب لاحتياجاتك. تصفح فريقنا من الأطباء المعتمدين المتخصصين في صحتك.',
    lblS:'البحث عن طبيب', lblD:'القسم', lblL:'الموقع', ph:'اكتب اسماً أو كلمة مفتاحية',
    depts:['كل الأقسام','القلب','الأطفال','الجلدية','العظام'],
    locs:['كل المواقع','العيادة المركزية','مركز الغرب','حرم النهر'],
    apply:'تطبيق الفلتر', tabs:['الكل','القلب','الأطفال','الجلدية','العظام'],
    bSenior:'استشاري أول', bNew:'جديد',
    cNames:['د. أميليا بروكس','د. نوح تيرنر','د. صوفيا بينيت','د. إيثان كول','د. مايا باتيل','د. أوليفر هايز','د. هاربر لين','د. ليام كارتر'],
    cSpecs:['إخصائية قلب · MD, FACC','إخصائي أطفال · DO','إخصائية جلدية · MBBS, MD','جراح عظام · MS, FRCS','أخصائي قلب تدخلي · MD','أخصائي أطفال · MD','أخصائية جلدية تجميلية · MD','طب الرياضة · MD'],
    cTags:['القلب','الأطفال','الجلدية','العظام','القلب','الأطفال','الجلدية','العظام'],
    cBook:'حجز موعد', cProf:'عرض الملف', noRes:'لا يوجد أطباء مطابقون لبحثك.',
    fpAvail:'متاح هذا الأسبوع', fpB:['رئيس جراحين','خبرة +12 سنة','بورد معتمد'],
    fpName:'د. صوفيا بينيت', fpSpec:'جراحة عامة · MD, FACS',
    fpDesc:'خبيرة في العمليات الجراحية المعقدة باستخدام أحدث التقنيات العالمية والمناظير الجراحية.',
    fpD:['الإقامة: مركز سانت ماري الطبي','الزمالة: مناظير متقدمة','المنشورات: 14 مقالاً علمياً محكماً'],
    fpBook:'حجز موعد', fpCV:'عرض السيرة',
    miniN:['د. أوليفر هايز','د. نوح تيرنر','د. أميليا بروكس','د. هاربر لين'],
    miniS:['طب الأطفال','طب الأطفال','طب القلب','طب الجلدية'],
    spAvail:'متاح هذا الأسبوع', spB:['رئيس جراحين','خبرة +12 سنة','بورد معتمد'],
    spName:'د. ناتاليا ريفيرا', spSpec:'جراحة عامة · MD, FACS',
    spBio:'خبيرة في الجراحة العامة والمناظير بأحدث التقنيات الطبية العالمية. تجمع بين الكفاءة المهنية والرحمة الكاملة في تعاملها مع مرضاها.',
    spD:['الإقامة: مركز سانت ماري الطبي','الزمالة: مناظير متقدمة','المنشورات: 14 مقالاً علمياً محكماً'],
    spBook:'حجز موعد', spCV:'عرض السيرة',
    ctTitle:'تعرف على فريقنا', ctSub:'مجموعة متخصصة من الأطباء ملتزمة بصحتك',
    ctN:['د. أوليفر هايز','د. نوح تيرنر','د. ليام كارتر','د. أميليا بروكس','د. هاربر لين','د. لوكاس جرانت'],
    ctS:['طب الأطفال','طب الأطفال','العظام','طب القلب','طب الجلدية','أمراض الرئة'],
    bpName:'د. هنري جيمس', bpSpec:'أورام · MBBS, MD', bpTags:['بورد معتمد','8 سنوات خبرة'],
    bpTabs:['السيرة','المواعيد','التقييمات'],
    bpDesc:'متخصص في علاج الأورام بأحدث البروتوكولات العلاجية العالمية مع اهتمام خاص بالعلاج المناعي.',
    bpC:['اهتمام خاص بالعلاج المناعي','عضو في جمعية ASCO','برامج التوعية المجتمعية'],
    days:['الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'], closed:'مغلق', slotBtn:'حجز وقت',
    revMeta:'4.5 / 5 · 32 تقييم',
    revText:'الدكتور على مستوى عالٍ من الكفاءة والأمانة في التشخيص. أنصح به بشدة لجميع المرضى.'
  }
};

window.applyPageTranslation = function(currentLang) {
  const t = pageTranslations[currentLang];
  if (!t) return;
  document.getElementById('doc-h1').innerText = t.h1;
  document.getElementById('doc-sub').innerText = t.sub;
  document.getElementById('lbl-search').innerText = t.lblS;
  document.getElementById('lbl-dept').innerText = t.lblD;
  document.getElementById('lbl-loc').innerText = t.lblL;
  document.getElementById('search-input').placeholder = t.ph;
  document.getElementById('btn-apply').innerText = t.apply;
  document.getElementById('no-results-txt').innerText = t.noRes;
  const deptSelect = document.getElementById('dept-select');
  for (let i = 0; i < deptSelect.options.length; i++) { if (t.depts[i]) deptSelect.options[i].innerText = t.depts[i]; }
  const locSelect = document.getElementById('loc-select');
  for (let i = 0; i < locSelect.options.length; i++) { if (t.locs[i]) locSelect.options[i].innerText = t.locs[i]; }
  const tabs = document.querySelectorAll('#tabs-bar .tab');
  tabs.forEach((tab, idx) => { if (t.tabs[idx]) tab.innerText = t.tabs[idx]; });
  const seniorBadge = document.getElementById('badge-senior');
  if (seniorBadge) seniorBadge.innerText = t.bSenior;
  const newBadge = document.getElementById('badge-new');
  if (newBadge) newBadge.innerText = t.bNew;
  const cards = document.querySelectorAll('#doctors-grid .doc-card');
  cards.forEach((card, i) => {
    const nameDiv = card.querySelector('.doc-name');
    if (nameDiv && t.cNames[i]) nameDiv.innerText = t.cNames[i];
    const specDiv = card.querySelector('.doc-spec');
    if (specDiv && t.cSpecs[i]) specDiv.innerText = t.cSpecs[i];
    const tagDiv = card.querySelector('.tag');
    if (tagDiv && t.cTags[i]) tagDiv.innerText = t.cTags[i];
    const bookBtn = card.querySelector('.btn-book');
    if (bookBtn) bookBtn.innerText = t.cBook;
    const profileBtn = card.querySelector('.btn-profile');
    if (profileBtn) profileBtn.innerText = t.cProf;
  });
  document.getElementById('fp-avail-txt').innerText = t.fpAvail;
  document.getElementById('fp-b1').innerText = t.fpB[0];
  document.getElementById('fp-b2').innerText = t.fpB[1];
  document.getElementById('fp-b3').innerText = t.fpB[2];
  document.getElementById('fp-name').innerText = t.fpName;
  document.getElementById('fp-spec').innerText = t.fpSpec;
  document.getElementById('fp-desc').innerText = t.fpDesc;
  document.getElementById('fp-d1').innerText = t.fpD[0];
  document.getElementById('fp-d2').innerText = t.fpD[1];
  document.getElementById('fp-d3').innerText = t.fpD[2];
  document.getElementById('fp-book').innerHTML = `<i class="fas fa-calendar-check"></i>${t.fpBook}`;
  document.getElementById('fp-cv').innerHTML = `<i class="fas fa-file-lines"></i>${t.fpCV}`;
  for (let i = 1; i <= 4; i++) {
    const nameEl = document.getElementById(`mn${i}`); if (nameEl) nameEl.innerText = t.miniN[i-1];
    const subEl  = document.getElementById(`ms${i}`);  if (subEl)  subEl.innerText  = t.miniS[i-1];
  }
  document.getElementById('sp-avail').innerText = t.spAvail;
  document.getElementById('sp-b1').innerText = t.spB[0];
  document.getElementById('sp-b2').innerText = t.spB[1];
  document.getElementById('sp-b3').innerText = t.spB[2];
  document.getElementById('sp-name').innerText = t.spName;
  document.getElementById('sp-spec').innerText = t.spSpec;
  document.getElementById('sp-bio').innerText = t.spBio;
  document.getElementById('sp-d1').innerText = t.spD[0];
  document.getElementById('sp-d2').innerText = t.spD[1];
  document.getElementById('sp-d3').innerText = t.spD[2];
  document.getElementById('sp-book').innerHTML = `<i class="fas fa-calendar-check"></i>${t.spBook}`;
  document.getElementById('sp-cv').innerHTML = `<i class="fas fa-file-lines"></i>${t.spCV}`;
  document.getElementById('compact-title').innerText = t.ctTitle;
  document.getElementById('compact-sub').innerText = t.ctSub;
  for (let i = 1; i <= 6; i++) {
    const nameEl = document.getElementById(`cm${i}`); if (nameEl) nameEl.innerText = t.ctN[i-1];
    const specEl = document.getElementById(`cs${i}`); if (specEl) specEl.innerText = t.ctS[i-1];
  }
  document.getElementById('bp-name').innerText = t.bpName;
  document.getElementById('bp-spec').innerText = t.bpSpec;
  document.getElementById('bp-tag1').innerText = t.bpTags[0];
  document.getElementById('bp-tag2').innerText = t.bpTags[1];
  document.getElementById('bpt1').innerText = t.bpTabs[0];
  document.getElementById('bpt2').innerText = t.bpTabs[1];
  document.getElementById('bpt3').innerText = t.bpTabs[2];
  document.getElementById('bp-desc').innerText = t.bpDesc;
  document.getElementById('bp-c1').innerText = t.bpC[0];
  document.getElementById('bp-c2').innerText = t.bpC[1];
  document.getElementById('bp-c3').innerText = t.bpC[2];
  document.getElementById('d-mon').innerText = t.days[0];
  document.getElementById('d-tue').innerText = t.days[1];
  document.getElementById('d-wed').innerText = t.days[2];
  document.getElementById('d-thu').innerText = t.days[3];
  document.getElementById('d-fri').innerText = t.days[4];
  document.getElementById('d-closed').innerText = t.closed;
  document.getElementById('bp-slot-btn').innerHTML = `<i class="fas fa-calendar-days"></i>${t.slotBtn}`;
  document.getElementById('bp-rev-meta').innerText = t.revMeta;
  document.getElementById('bp-rev-text').innerText = t.revText;
};

// ====================== SCROLL REVEAL FOR DOCTOR CARDS ======================
let cardObserver = null;

function initCardScrollReveal() {
  if (cardObserver) cardObserver.disconnect();
  const cards = document.querySelectorAll('#doctors-grid .doc-card:not(.hidden)');
  const isMobile = window.innerWidth <= 768;
  cardObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const card = entry.target;
        if (card.classList.contains('card-visible')) return;
        const allVisibleCards = Array.from(document.querySelectorAll('#doctors-grid .doc-card:not(.hidden):not(.card-visible)'));
        const currentIndex = allVisibleCards.indexOf(card);
        let delay = 0;
        if (isMobile) {
          // على الموبايل: تأخير أكبر بين الكروت (كل 0.3 ثانية)
          delay = currentIndex * 0.3;
        } else {
          delay = currentIndex * 0.07;
        }
        card.style.animationDelay = `${delay}s`;
        card.classList.add('card-visible');
        cardObserver.unobserve(card);
      }
    });
  }, { threshold: 0.2, rootMargin: '0px 0px -20px 0px' });
  cards.forEach(card => cardObserver.observe(card));
}

// ====================== FILTERS ======================
let activeFilter = 'all';
function applyFilters() {
  const q = document.getElementById('search-input').value.trim().toLowerCase();
  const dept = document.getElementById('dept-select').value;
  const loc = document.getElementById('loc-select').value;
  let visible = 0;
  
  // Add animation class to apply button for visual feedback
  const applyBtn = document.getElementById('btn-apply');
  if (applyBtn) {
    applyBtn.classList.add('filter-animation');
    setTimeout(() => {
      applyBtn.classList.remove('filter-animation');
    }, 500);
  }
  
  document.querySelectorAll('#doctors-grid .doc-card').forEach(card => {
    const ok = (!q || (card.dataset.name || '').toLowerCase().includes(q)) &&
               (dept === 'all' || card.dataset.dept === dept) &&
               (loc === 'all' || card.dataset.loc === loc) &&
               (activeFilter === 'all' || card.dataset.dept === activeFilter);
    card.classList.toggle('hidden', !ok);
    if (ok) visible++;
  });
  document.getElementById('no-results').style.display = visible === 0 ? 'block' : 'none';
  // إعادة تهيئة مراقب التقاطع للكروت المرئية الجديدة
  initCardScrollReveal();
}

document.getElementById('tabs-bar').addEventListener('click', (e) => {
  const tab = e.target.closest('.tab');
  if (!tab) return;
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  tab.classList.add('active');
  activeFilter = tab.dataset.filter;
  document.getElementById('dept-select').value = activeFilter;
  applyFilters();
});
document.getElementById('search-input').addEventListener('input', applyFilters);
document.getElementById('dept-select').addEventListener('change', function() {
  activeFilter = this.value;
  document.querySelectorAll('.tab').forEach(t => t.classList.toggle('active', t.dataset.filter === activeFilter));
  applyFilters();
});
document.getElementById('loc-select').addEventListener('change', applyFilters);
document.getElementById('btn-apply').addEventListener('click', applyFilters);

document.querySelectorAll('.bp-tab').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.bp-tab').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.bp-pane').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(btn.dataset.pane).classList.add('active');
  });
});

// ====================== OTHER ANIMATIONS (SCROLL REVEAL FOR SECTIONS, RIPPLE) ======================
(function () {
  'use strict';
  const srObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        srObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

  function initOtherAnimations() {
    const fp = document.querySelector('.featured-profile');
    if (fp) { fp.classList.add('sr'); srObs.observe(fp); }
    const mini = document.querySelector('.mini-profiles');
    if (mini) { mini.classList.add('sr-stagger'); srObs.observe(mini); }
    const spMedia = document.querySelector('.sp-media');
    if (spMedia) { spMedia.classList.add('sr', 'sr-left'); srObs.observe(spMedia); }
    const spBody = document.querySelector('.sp-body');
    if (spBody) { spBody.classList.add('sr', 'sr-right'); srObs.observe(spBody); }
    const compact = document.querySelector('.compact-grid');
    if (compact) { compact.classList.add('sr-stagger'); srObs.observe(compact); }
    document.querySelectorAll('.mc-section-title, .mc-section-sub').forEach((el, i) => {
      el.classList.add('sr');
      el.style.transitionDelay = (i * 0.12) + 's';
      srObs.observe(el);
    });
    const bp = document.querySelector('.bottom-profile');
    if (bp) { bp.classList.add('sr'); srObs.observe(bp); }
    document.querySelectorAll('.anim-heading').forEach(el => {
      const hObs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); hObs.unobserve(e.target); }});
      }, { threshold: 0.5 });
      hObs.observe(el);
    });
  }

  function addRipple(btn) {
    btn.addEventListener('click', function(e) {
      const ex = this.querySelector('.rpl');
      if (ex) ex.remove();
      const rpl = document.createElement('span');
      rpl.className = 'rpl';
      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height) * 1.5;
      rpl.style.cssText = `position:absolute;border-radius:50%;width:${size}px;height:${size}px;top:${e.clientY-rect.top-size/2}px;left:${e.clientX-rect.left-size/2}px;background:rgba(255,255,255,0.22);transform:scale(0);animation:rplAnim 0.5s ease forwards;pointer-events:none;`;
      this.appendChild(rpl);
      setTimeout(() => rpl.remove(), 550);
    });
  }
  function initRipples() {
    document.querySelectorAll('.btn-book, .btn-apply, .btn-gold').forEach(addRipple);
  }
  function initSearchAnim() {
    const input = document.getElementById('search-input');
    if (!input) return;
    const phrases = ['Type a name or keyword', 'Dr. Amelia Brooks...', 'Cardiology...', 'Pediatric Specialist...'];
    let idx = 0;
    setInterval(() => {
      if (document.activeElement !== input) {
        idx = (idx + 1) % phrases.length;
        input.placeholder = phrases[idx];
      }
    }, 2800);
  }
  document.querySelectorAll('.bp-tab').forEach(btn => {
    btn.addEventListener('click', () => {
      if (btn.dataset.pane === 'bp-reviews') {
        const stars = document.querySelectorAll('.bp-stars i');
        stars.forEach((star, i) => {
          star.style.animation = 'none';
          setTimeout(() => {
            star.style.animation = `iconPop 0.4s var(--ease-bounce) ${i * 0.08}s both`;
          }, 10);
        });
      }
    });
  });

  function init() {
    initOtherAnimations();
    initRipples();
    initSearchAnim();
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

// ====================== INITIAL LOAD ======================
document.addEventListener('DOMContentLoaded', () => {
  const currentLang = localStorage.getItem('siteLang') || 'en';
  if (window.applyPageTranslation) window.applyPageTranslation(currentLang);
  applyFilters(); // this will also call initCardScrollReveal()
});
</script>
@endpush{{-- resources/views/doctorss.blade.php --}}
@extends('layouts.app')

@section('title', 'Doctors · MediCare')

@push('styles')
<style>

    /* ===== المتغيرات والأساسيات ===== */
    :root {
      --primary: #C9A24D;
      --primary-dark: #1F2A44;
      --dark: #1F2A44;
      --light-bg: #f8fafb;
      --text: #333333;
      --text-muted: #6b7280;
      --border-color: #C9A24D;
      --white: #ffffff;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);

      /* Animation tokens */
      --ease-smooth: cubic-bezier(0.25, 0.46, 0.45, 0.94);
      --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
      --ease-sharp:  cubic-bezier(0.22, 1, 0.36, 1);
      --dur-fast:  0.3s;
      --dur-base:  0.55s;
      --dur-slow:  0.8s;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: var(--light-bg);
      color: var(--text);
      line-height: 1.6;
    }

    .container {
      max-width: 1140px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* ===== NAVBAR ===== */
    .navbar {
      padding: 15px 0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .nav-content { display: flex; justify-content: space-between; align-items: center; }
    .logo { display: flex; align-items: center; gap: 10px; font-size: 22px; font-weight: 700; color: #FFFFFF; }
    .logo-box { background: none; padding: 0; width: 50px; height: 50px; }
    .logo-box img { width: 100%; height: 100%; object-fit: contain; }
    .nav-links { display: flex; list-style: none; gap: 30px; }
    .nav-links a { text-decoration: none; color: #FFFFFF; font-weight: 500; font-size: 14px; transition: 0.3s; }
    .nav-links a:hover, .nav-links a.active { color: #C9A24D; border-bottom: 2px solid #C9A24D; padding-bottom: 5px; }
    .user-profile { display: flex; align-items: center; gap: 8px; padding: 8px 14px; border: 1px solid #ECECEC; border-radius: 6px; text-decoration: none; color: #FFFFFF; font-size: 14px; font-weight: 500; transition: all 0.3s ease; }
    .user-profile i { font-size: 14px; color: #FFFFFF; }
    .user-profile:hover { background-color: #C9A24D; color: #FFFFFF; border-color: #C9A24D; }
    .menu-toggle { display: none; flex-direction: column; gap: 5px; cursor: pointer; z-index: 1100; }
    .menu-toggle span { width: 25px; height: 3px; background: #FFFFFF; border-radius: 5px; transition: 0.3s ease; }
    .menu-toggle.is-active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
    .menu-toggle.is-active span:nth-child(2) { opacity: 0; }
    .menu-toggle.is-active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }
    .mobile-only { display: none; }

    @media (max-width: 768px) {
      .menu-toggle { display: flex; }
      .nav-links { position: fixed; top: 0; right: -50%; width: 50%; height: 100vh; background: #1F2A44; flex-direction: column; justify-content: center; align-items: center; transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: -5px 0 15px rgba(0,0,0,0.3); z-index: 1050; gap: 0; padding: 40px 0; }
      .nav-links.active { right: 0; }
      .nav-links li { margin: 20px 0; }
      .nav-links a { font-size: 18px; border: none !important; }
      .nav-links a:hover, .nav-links a.active { border-bottom: 2px solid #C9A24D; padding-bottom: 5px; }
      .user-profile { display: none; }
      .mobile-only { display: block; }
      .mobile-only a { color: #FFFFFF; }
    }
    @media (max-width: 480px) { .nav-links { width: 70%; right: -70%; } }

    /* ===== PAGE HEADER ===== */
    header { text-align: center; margin: 40px 0; }
    header h1 { font-size: clamp(24px, 5vw, 28px); color: #1F2A44; margin-bottom: 10px; font-size: xx-large; }
    header p { font-size: 13px; color: #C9A24D; max-width: 700px; margin: 0 auto; line-height: 1.6; font-size: medium; }

    /* ===== SEARCH BAR ===== */
    .search-bar { 
      background: #1F2A44; 
      padding: 20px; 
      border-radius: 12px; 
      display: flex; 
      flex-wrap: wrap; 
      gap: 15px; 
      box-shadow: 0 4px 15px #C9A24D; 
      margin-bottom: 30px; 
      align-items: flex-end;
      
      /* Added animations for search bar */
      animation: searchBarSlideIn 0.65s var(--ease-bounce) forwards;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    
    .search-bar:hover {
      box-shadow: 0 8px 25px rgba(201, 162, 77, 0.3);
      transform: translateY(-2px);
    }
    
    @keyframes searchBarSlideIn {
      0% {
        opacity: 0;
        transform: translateY(-40px) scale(0.96);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }
    
    .input-group { 
      flex: 1; 
      min-width: 200px;
      transition: all 0.3s ease;
    }
    
    .input-group label { 
      display: block; 
      font-size: 11px; 
      font-weight: bold; 
      margin-bottom: 8px; 
      color: #C9A24D; 
      transition: all 0.2s ease;
    }
    
    .input-group input, .input-group select { 
      width: 100%; 
      padding: 10px; 
      border: 1px solid #C9A24D; 
      border-radius: 6px; 
      font-size: 13px; 
      color: #C9A24D; 
      background: #1F2A44;
      transition: all 0.25s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }
    
    /* Enhanced focus animations for input fields */
    .input-group input:focus, .input-group select:focus {
      outline: none;
      border-color: #C9A24D;
      box-shadow: 0 0 0 3px rgba(201, 162, 77, 0.3), 0 2px 8px rgba(0,0,0,0.1);
      transform: scale(1.01);
      background: #1F2A44;
    }
    
    .input-group input:hover, .input-group select:hover {
      border-color: #e0b354;
      transform: translateY(-1px);
    }
    
    .btn-apply { 
      background: #C9A24D; 
      color: white; 
      border: none; 
      padding: 11px 25px; 
      border-radius: 6px; 
      cursor: pointer; 
      font-weight: 600; 
      min-width: 120px;
      transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
      position: relative;
      overflow: hidden;
    }
    
    .btn-apply:hover {
      background: #b8912e;
      transform: translateY(-2px) scale(1.02);
      box-shadow: 0 6px 18px rgba(201, 162, 77, 0.4);
    }
    
    .btn-apply:active {
      transform: translateY(1px) scale(0.98);
      transition: 0.05s;
    }
    
    /* Filter apply animation class (added via JS) */
    .btn-apply.filter-animation {
      animation: filterPop 0.5s var(--ease-bounce);
    }
    
    @keyframes filterPop {
      0% { transform: scale(1); }
      40% { transform: scale(1.1); box-shadow: 0 8px 25px rgba(201, 162, 77, 0.6); }
      70% { transform: scale(0.96); }
      100% { transform: scale(1); }
    }
    
    /* Staggered fade-in for filter groups */
    .input-group {
      opacity: 0;
      animation: groupFadeIn 0.5s var(--ease-smooth) forwards;
    }
    .input-group:nth-child(1) { animation-delay: 0.05s; }
    .input-group:nth-child(2) { animation-delay: 0.12s; }
    .input-group:nth-child(3) { animation-delay: 0.19s; }
    .btn-apply { 
      opacity: 0;
      animation: groupFadeIn 0.5s var(--ease-smooth) 0.26s forwards;
    }
    
    @keyframes groupFadeIn {
      from { opacity: 0; transform: translateX(-8px); }
      to { opacity: 1; transform: translateX(0); }
    }

    /* ===== TABS ===== */
    .tabs { display: flex; gap: 10px; margin-bottom: 30px; overflow-x: auto; padding-bottom: 10px; }
    .tab { padding: 6px 18px; border-radius: 20px; font-size: 12px; border: 1px solid #C9A24D; cursor: pointer; color: #1F2A44; white-space: nowrap; transition: background .22s, color .22s, border-color .22s; user-select: none; }
    .tab.active { background: #C9A24D !important; color: white !important; border-color: #C9A24D !important; }

    /* ===== DOCTORS GRID ===== */
    .doctors-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 50px; }
    .doc-card {
      background: #1F2A44;
      border-radius: 15px;
      padding: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.03);
      position: relative;
      display: flex;
      flex-direction: column;
      opacity: 0;
      transform: translateY(30px) scale(0.92);
      transition: opacity 0.5s ease, transform 0.5s ease;
    }
    .doc-card.card-visible {
      opacity: 1;
      transform: translateY(0) scale(1);
      animation: cardFadeUp 0.9s var(--ease-bounce) forwards;
    }
    @media (max-width: 768px) {
      .doc-card.card-visible {
        animation-duration: 1.2s;
      }
    }
    @keyframes cardFadeUp {
      0% {
        opacity: 0;
        transform: translateY(30px) scale(0.92);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }
    .doc-card.hidden { display: none; }
    .badge-senior { position: absolute; top: 10px; left: 10px; background: #C9A24D; color: white; font-size: 9px; padding: 3px 8px; border-radius: 4px; z-index: 1; }
    .doc-img { width: 100%; height: 220px; object-fit: cover; border-radius: 12px; margin-bottom: 15px; background: #f0f0f0; }
    .doc-name { font-size: 15px; font-weight: 700; color: white; }
    .doc-spec { font-size: 11px; color: #C9A24D; margin-bottom: 8px; }
    .doc-desc { font-size: 11px; color: #f0f0f0; line-height: 1.4; margin-bottom: 12px; }
    .tag { background: #C9A24D; color: #1F2A44; font-size: 10px; padding: 3px 10px; border-radius: 4px; display: inline-block; margin-bottom: 15px; width: fit-content; }
    .card-btns { display: flex; gap: 8px; margin-top: auto; }
    .btn-book { flex: 1; background: #C9A24D; color: white; border: none; font-size: 10px; padding: 8px; border-radius: 5px; cursor: pointer; }
    .btn-profile { flex: 1; background: white; border: 1px solid #C9A24D; color: #1F2A44; font-size: 10px; padding: 8px; border-radius: 5px; cursor: pointer; }

    .no-results { display: none; text-align: center; padding: 56px 20px; color: #6b7a8d; }
    .no-results i { font-size: 3rem; color: #c9a24d; display: block; margin-bottom: 14px; }
    .no-results p { font-size: 1rem; margin: 0; }

    /* ===== FEATURED PROFILE ===== */
    .featured-profile { margin-top: 48px; background: #fff; border: 1.5px solid #f0ece4; border-radius: 20px; overflow: hidden; display: grid; grid-template-columns: 320px 1fr; box-shadow: 0 4px 28px rgba(201,162,77,.08); }
    .fp-img { position: relative; }
    .fp-img img { width: 100%; height: 100%; min-height: 340px; object-fit: cover; object-position: top; display: block; }
    .fp-avail { position: absolute; bottom: 16px; left: 16px; background: #fff; color: #22c55e; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 30px; display: flex; align-items: center; gap: 6px; box-shadow: 0 2px 12px rgba(0,0,0,.1); }
    body[dir="rtl"] .fp-avail { left: auto; right: 16px; }
    .fp-body { padding: 36px 40px; display: flex; flex-direction: column; justify-content: center; }
    .fp-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
    .fp-badge { font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 20px; }
    .fp-badge.teal { background: #0d9488; color: #fff; }
    .fp-badge.blue { background: #e8f0f8; color: #1a5fa0; }
    .fp-body h2 { font-size: 1.6rem; font-weight: 800; color: #1a2e44; margin: 0 0 4px; }
    .fp-spec { color: #c9a24d; font-weight: 700; font-size: .95rem; margin: 0 0 14px; }
    .fp-desc { color: #6b7a8d; line-height: 1.75; margin: 0 0 20px; font-size: .93rem; }
    .fp-details { list-style: none; padding: 0; margin: 0 0 24px; display: flex; flex-direction: column; gap: 9px; }
    .fp-details li { display: flex; align-items: center; gap: 10px; color: #3a4a5c; font-size: .9rem; }
    .fp-details li i { color: #c9a24d; min-width: 16px; }
    .fp-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ===== MINI PROFILES ===== */
    .mini-profiles { margin-top: 48px; display: grid; grid-template-columns: repeat(4,1fr); gap: 18px; }
    .mini-item { background: #fff; border: 1.5px solid #f0ece4; border-radius: 16px; padding: 22px 16px; text-align: center; cursor: pointer; transition: transform .25s, box-shadow .25s, border-color .25s; }
    .mini-item:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(201,162,77,.13); border-color: #c9a24d; }
    .mini-item .mini-img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; object-position: top; border: 3px solid #f0ece4; display: block; margin: 0 auto 12px; transition: border-color .25s; }
    .mini-item:hover .mini-img { border-color: #c9a24d; }
    .mini-item .mini-name { font-size: .88rem; font-weight: 700; color: #1a2e44; margin-bottom: 4px; }
    .mini-item .mini-sub  { font-size: .78rem; color: #c9a24d; font-weight: 600; }

    /* ===== SECTION HELPERS ===== */
    .mc-section { padding: 72px 0 0; }
    .mc-section-title { font-size: 1.5rem; font-weight: 800; color: #1a2e44; margin: 0 0 6px; }
    .mc-section-sub   { color: #6b7a8d; font-size: .95rem; margin: 0 0 36px; }

    /* ===== BUTTONS ===== */
    .btn-gold { background: #c9a24d; color: #fff; padding: 11px 24px; border-radius: 30px; font-weight: 700; font-size: .88rem; border: none; cursor: pointer; text-decoration: none; transition: background .25s; display: inline-flex; align-items: center; gap: 7px; }
    .btn-gold:hover { background: #b8912e; color: #fff; }
    .btn-outline-gold { background: transparent; color: #c9a24d; padding: 11px 24px; border-radius: 30px; border: 2px solid #c9a24d; font-weight: 700; font-size: .88rem; cursor: pointer; text-decoration: none; transition: all .25s; display: inline-flex; align-items: center; gap: 7px; }
    .btn-outline-gold:hover { background: #c9a24d; color: #fff; }

    /* ===== BLINK DOT ===== */
    .dot { width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block; animation: blink 1.6s infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.35} }

    /* ===== SINGLE PROFILE ===== */
    .single-profile-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 48px; align-items: center; }
    .sp-media { position: relative; border-radius: 20px; overflow: hidden; }
    .sp-media img { width: 100%; height: 430px; object-fit: cover; object-position: top; display: block; }
    .sp-avail-tag { position: absolute; bottom: 18px; left: 18px; background: #fff; color: #22c55e; font-size: 12px; font-weight: 700; padding: 7px 16px; border-radius: 30px; display: flex; align-items: center; gap: 6px; box-shadow: 0 2px 12px rgba(0,0,0,.1); }
    body[dir="rtl"] .sp-avail-tag { left: auto; right: 18px; }
    .sp-body { padding: 8px 0 0; }
    .sp-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }
    .sp-badge { font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 20px; }
    .sp-badge.dark  { background: #1a2e44; color: #fff; }
    .sp-badge.blue  { background: #e8f0f8; color: #1a5fa0; }
    .sp-badge.green { background: #e8f6ee; color: #16803b; }
    .sp-body h2 { font-size: 1.75rem; font-weight: 800; color: #1a2e44; margin: 0 0 5px; }
    .sp-spec-txt { color: #c9a24d; font-weight: 700; font-size: 1rem; margin: 0 0 18px; display: block; }
    .sp-bio-txt  { color: #6b7a8d; line-height: 1.8; margin: 0 0 22px; font-size: .93rem; }
    .sp-highlights { list-style: none; padding: 0; margin: 0 0 28px; display: flex; flex-direction: column; gap: 12px; }
    .sp-highlights li { display: flex; align-items: center; gap: 12px; color: #3a4a5c; font-size: .93rem; }
    .sp-highlights li i { color: #c9a24d; min-width: 18px; }
    .sp-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ===== COMPACT GRID ===== */
    .compact-grid { display: grid; grid-template-columns: repeat(6,1fr); gap: 16px; }
    .mini-card-new { background: #fff; border: 1.5px solid #f0ece4; border-radius: 16px; padding: 20px 10px; text-align: center; cursor: pointer; transition: transform .25s, box-shadow .25s, border-color .25s; }
    .mini-card-new:hover { transform: translateY(-5px); box-shadow: 0 10px 28px rgba(201,162,77,.13); border-color: #c9a24d; }
    .mini-card-new img { width: 66px; height: 66px; border-radius: 50%; object-fit: cover; object-position: top; border: 3px solid #f0ece4; display: block; margin: 0 auto 10px; transition: border-color .25s; }
    .mini-card-new:hover img { border-color: #c9a24d; }
    .mini-card-new .mcn-name { font-size: .78rem; font-weight: 700; color: #1a2e44; margin-bottom: 3px; line-height: 1.3; }
    .mini-card-new .mcn-spec { font-size: .72rem; color: #c9a24d; font-weight: 600; }

    /* ===== BOTTOM PROFILE ===== */
    .bottom-profile { background: #fff; border: 1.5px solid #ede9e0; border-radius: 20px; overflow: hidden; display: grid; grid-template-columns: 300px 1fr; box-shadow: 0 2px 20px rgba(201,162,77,.07); }
    .bp-left { background: #f8f7f4; border-right: 1.5px solid #ede9e0; padding: 40px 28px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
    body[dir="rtl"] .bp-left { border-right: none; border-left: 1.5px solid #ede9e0; }
    .bp-img-wrap { width: 120px; height: 120px; border-radius: 50%; border: 3px solid #c9a24d; padding: 4px; margin-bottom: 18px; background: #fff; }
    .bp-img-wrap img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; object-position: top; display: block; }
    .bp-name { font-size: 1.05rem; font-weight: 800; color: #1a2e44; margin-bottom: 4px; }
    .bp-spec-txt { font-size: .82rem; color: #6b7a8d; margin-bottom: 20px; }
    .bp-tags { display: flex; flex-direction: column; gap: 8px; width: 100%; }
    .bp-tag { background: #fff; border: 1.5px solid #e8d9aa; color: #8a6d2e; font-size: 11px; font-weight: 700; padding: 7px 12px; border-radius: 20px; text-align: center; }
    .bp-right { padding: 32px 36px; background: #fff; }
    .bp-tabs { display: flex; border-bottom: 1.5px solid #ede9e0; margin-bottom: 24px; gap: 0; }
    .bp-tab { padding: 10px 24px 12px; font-size: .95rem; font-weight: 700; color: #6b7a8d; cursor: pointer; background: none; border: none; border-bottom: 2.5px solid transparent; margin-bottom: -1.5px; transition: color .2s, border-color .2s; }
    .bp-tab.active { color: #c9a24d; border-bottom-color: #c9a24d; }
    .bp-tab:hover  { color: #c9a24d; }
    .bp-pane { display: none; }
    .bp-pane.active { display: block; }
    .bp-pane > p { color: #6b7a8d; line-height: 1.85; font-size: .93rem; margin: 0 0 20px; }
    .bp-checklist { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
    .bp-checklist li { display: flex; align-items: center; gap: 12px; color: #3a4a5c; font-size: .92rem; }
    .bp-checklist li i { color: #c9a24d; font-size: 16px; min-width: 18px; }
    .bp-slots { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px; }
    .bp-slot { background: #f8f9fb; border: 1px solid #ede9e0; border-radius: 10px; padding: 12px 14px; display: flex; justify-content: space-between; align-items: center; }
    .bp-slot strong { font-size: .85rem; color: #1a2e44; font-weight: 700; }
    .bp-slot span   { font-size: .8rem;  color: #6b7a8d; }
    .bp-slot.closed span { color: #e55353; }
    .bp-stars { display: flex; gap: 3px; margin-bottom: 8px; }
    .bp-stars i { color: #c9a24d; font-size: 16px; }
    .bp-rev-meta { font-size: .82rem; color: #6b7a8d; margin-bottom: 12px; }
    .bp-rev-text { color: #3a4a5c; line-height: 1.75; font-size: .9rem; }

    /* ===== SEARCH ICON ===== */
    .search-icon-wrap { position: relative; }
    .search-icon-wrap .si { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #c9a24d; font-size: 14px; pointer-events: none; }
    body[dir="rtl"] .search-icon-wrap .si { left: auto; right: 14px; }
    .search-icon-wrap input { padding-left: 38px !important; }
    body[dir="rtl"] .search-icon-wrap input { padding-left: 14px !important; padding-right: 38px !important; }

    /* ===== LANG BTN ===== */
    .lang-btn { background: transparent; color: #c9a24d; border: 1px solid #c9a24d; padding: 6px 15px; border-radius: 30px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: bold; flex-shrink: 0; min-width: 100px; justify-content: center; transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1); }
    .lang-btn:hover { background: #c9a24d; color: #ffffff; transform: scale(1.05); box-shadow: 0 6px 14px rgba(201,162,77,0.35); border-color: #c9a24d; }
    .lang-btn:active { transform: scale(0.98); transition: 0.05s; }

    /* ===== FOOTER ===== */
    .footer { background-color: #1F2A44; color: #FFFFFF; padding: 60px 5% 20px; }
    .footer-container { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 40px; max-width: 1200px; margin: 0 auto; }
    .footer-col { flex: 1; min-width: 200px; }
    .footer-col h4 { font-size: 18px; margin-bottom: 20px; color: #C9A24D; }
    .footer-col ul { list-style: none; }
    .footer-col ul li { margin-bottom: 10px; }
    .footer-col ul li a { color: #ECECEC; text-decoration: none; transition: color 0.3s; }
    .footer-col ul li a:hover { color: #FFFFFF; }
    .footer-col p { color: #ECECEC; font-size: 14px; }
    .footer-bottom { text-align: center; padding: 20px; border-top: 1px solid #C9A24D; margin-top: 40px; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
      .doctors-grid { grid-template-columns: repeat(2, 1fr); }
      .featured-profile { grid-template-columns: 1fr; }
      .single-profile-grid { grid-template-columns: 1fr; }
      .sp-media img { height: 280px; }
      .mini-profiles { grid-template-columns: repeat(2,1fr); }
      .compact-grid { grid-template-columns: repeat(3,1fr); }
      .bottom-profile { grid-template-columns: 1fr; }
      .bp-left { border-right: none; border-bottom: 1.5px solid #ede9e0; padding: 28px 20px; }
      body[dir="rtl"] .bp-left { border-left: none; }
    }
    @media (max-width: 600px) {
      .doctors-grid { grid-template-columns: 1fr; }
      .search-bar { flex-direction: column; align-items: center; text-align: center; padding: 20px 15px; }
      .input-group { width: 100%; min-width: 100%; }
      .input-group label { text-align: center; font-size: 13px; }
      .btn-apply { width: 100%; margin-top: 10px; }
      .tabs { justify-content: center; }
      .mini-profiles { grid-template-columns: repeat(2,1fr); }
      .compact-grid      { grid-template-columns: repeat(2,1fr); }
      .bp-slots      { grid-template-columns: 1fr; }
      .fp-body       { padding: 24px 20px; }
      .bp-right      { padding: 24px 20px; }
    }
    @media (max-width: 768px) {
      body[dir="rtl"] .nav-links { display: flex !important; flex-direction: column !important; justify-content: center !important; align-items: center !important; gap: 30px !important; right: auto !important; left: -70% !important; width: 70% !important; transition: 0.4s ease-in-out !important; }
      body[dir="rtl"] .nav-links.active { left: 0 !important; right: auto !important; }
      body[dir="rtl"] .nav-links li { width: 100%; text-align: center; }
    }

    /* ================================================================
       OTHER ANIMATIONS (Ripple, etc.)
       ================================================================ */
    @keyframes rplAnim { to { transform: scale(1); opacity: 0; } }
    .btn-book, .btn-gold, .btn-apply { position: relative; overflow: hidden; }
    .btn-book .rpl, .btn-gold .rpl, .btn-apply .rpl { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.22); transform: scale(0); animation: rplAnim 0.5s ease forwards; pointer-events: none; }

    /* Scroll reveal for other sections */
    .sr {
      opacity: 0;
      transform: translateY(32px);
      transition: opacity var(--dur-slow) var(--ease-smooth),
                  transform var(--dur-slow) var(--ease-smooth);
    }
    .sr.visible { opacity: 1; transform: translateY(0); }
    .sr-stagger > * {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity var(--dur-base) var(--ease-smooth),
                  transform var(--dur-base) var(--ease-smooth);
    }
    .sr-stagger.visible > * { opacity: 1; transform: translateY(0); }
    .sr-stagger.visible > *:nth-child(1) { transition-delay: 0.05s; }
    .sr-stagger.visible > *:nth-child(2) { transition-delay: 0.13s; }
    .sr-stagger.visible > *:nth-child(3) { transition-delay: 0.21s; }
    .sr-stagger.visible > *:nth-child(4) { transition-delay: 0.29s; }

    /* Animations for other elements */
    .tab, .mini-item, .mini-card-new, .bp-slot, .bp-img-wrap { transition: all 0.25s ease; }
    .featured-profile, .bottom-profile { transition: box-shadow 0.4s ease; }
    .fp-img img, .sp-media img { transition: transform 0.6s ease; }
    .featured-profile:hover .fp-img img { transform: scale(1.04); }
    .doc-card .doc-img { transition: transform 0.55s ease; }
    .doc-card:hover .doc-img { transform: scale(1.05); }
    .doc-card:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 45px rgba(201,162,77,0.2); }
    .btn-book:hover, .btn-apply:hover { transform: translateY(-1px) scale(1.03); box-shadow: 0 6px 18px rgba(201,162,77,0.35); }
    .fp-avail, .sp-avail-tag { animation: pulse-gold 2.5s ease-in-out infinite; }
    @keyframes pulse-gold { 0%,100%{box-shadow:0 0 0 0 rgba(201,162,77,0);} 50%{box-shadow:0 0 0 5px rgba(201,162,77,0.2);} }
    @keyframes iconPop { 0%,100%{transform:scale(1);} 40%{transform:scale(1.25);} 70%{transform:scale(0.95);} }
    .anim-heading { position: relative; display: inline-block; }
    .anim-heading::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 3px; background: #c9a24d; border-radius: 2px; transition: width 0.7s var(--ease-smooth) 0.3s; }
    .anim-heading.visible::after { width: 100%; }

    @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }
</style>
@endpush

@section('content')
<div class="container">

  <!-- Header -->
  <header>
    <h1 id="doc-h1">Doctors</h1>
    <p id="doc-sub">Find the right specialist for your needs. Browse our team of board-certified professionals dedicated to your health and wellbeing.</p>
  </header>

  <!-- Search Bar -->
  <div class="search-bar">
    <div class="input-group">
      <label id="lbl-search">Search Doctors</label>
      <div class="search-icon-wrap">
        <i class="fas fa-magnifying-glass si"></i>
        <input type="text" id="search-input" placeholder="Type a name or keyword" />
      </div>
    </div>
    <div class="input-group">
      <label id="lbl-dept">Department</label>
      <select id="dept-select">
        <option value="all">All Departments</option>
        <option value="cardiology">Cardiology</option>
        <option value="pediatrics">Pediatrics</option>
        <option value="dermatology">Dermatology</option>
        <option value="orthopedics">Orthopedics</option>
      </select>
    </div>
    <div class="input-group">
      <label id="lbl-loc">Location</label>
      <select id="loc-select">
        <option value="all">All Locations</option>
        <option value="downtown">Downtown Clinic</option>
        <option value="westside">Westside Center</option>
        <option value="riverside">Riverside Campus</option>
      </select>
    </div>
    <button class="btn-apply" id="btn-apply" onclick="applyFilters()">Apply Filters</button>
  </div>

  <!-- Tabs -->
  <div class="tabs" id="tabs-bar">
    <div class="tab active" data-filter="all">All</div>
    <div class="tab" data-filter="cardiology">Cardiology</div>
    <div class="tab" data-filter="pediatrics">Pediatrics</div>
    <div class="tab" data-filter="dermatology">Dermatology</div>
    <div class="tab" data-filter="orthopedics">Orthopedics</div>
  </div>

  <!-- Doctors Grid -->
  <div class="doctors-grid" id="doctors-grid">
    <div class="doc-card" data-dept="cardiology" data-name="Dr. Amelia Brooks" data-loc="downtown">
      <span class="badge-senior" id="badge-senior">Senior Consultant</span>
      <img src="{{ asset('mon/images/dr1.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Amelia Brooks</div>
      <div class="doc-spec">Cardiologist · MD, FACC</div>
      <div class="doc-desc">Nostrud tempor magna minim excepteur id cillum laboris aute proident.</div>
      <div class="tag">Cardiology</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="pediatrics" data-name="Dr. Noah Turner" data-loc="westside">
      <img src="{{ asset('mon/images/dr4.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Noah Turner</div>
      <div class="doc-spec">Pediatrician · DO</div>
      <div class="doc-desc">Quis irure pariatur sed eiusmod, elit laboris consequat cupidatat.</div>
      <div class="tag">Pediatrics</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="dermatology" data-name="Dr. Sofia Bennett" data-loc="riverside">
      <span id="badge-new" style="position:absolute;top:14px;right:14px;background:#0d9488;color:#fff;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;">New</span>
      <img src="{{ asset('mon/images/dr2.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Sofia Bennett</div>
      <div class="doc-spec">Dermatologist · MBBS, MD</div>
      <div class="doc-desc">Dolor commodo laboris lorem ed, amet consequat mollit deserunt.</div>
      <div class="tag">Dermatology</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="orthopedics" data-name="Dr. Ethan Cole" data-loc="downtown">
      <img src="{{ asset('mon/images/dr3.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Ethan Cole</div>
      <div class="doc-spec">Orthopedic Surgeon · MS, FRCS</div>
      <div class="doc-desc">Velit laborum minim laboris, eiusmod elit irure in exercitation.</div>
      <div class="tag">Orthopedics</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="cardiology" data-name="Dr. Maya Patel" data-loc="westside">
      <img src="{{ asset('mon/images/dr1.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Maya Patel</div>
      <div class="doc-spec">Interventional Cardiologist · MD</div>
      <div class="doc-desc">Cupidatat fugiat sint enim laboris, sed do ut aliquip dolor.</div>
      <div class="tag">Cardiology</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="pediatrics" data-name="Dr. Oliver Hayes" data-loc="riverside">
      <img src="{{ asset('mon/images/dr4.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Oliver Hayes</div>
      <div class="doc-spec">Pediatric Specialist · MD</div>
      <div class="doc-desc">Exercitation id ea nisi fugiat, ullamco veniam cillum nostrud.</div>
      <div class="tag">Pediatrics</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="dermatology" data-name="Dr. Harper Lane" data-loc="downtown">
      <img src="{{ asset('mon/images/dr2.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Harper Lane</div>
      <div class="doc-spec">Cosmetic Dermatologist · MD</div>
      <div class="doc-desc">Aliquip laboris anim minim, irure commodo qui occaecat velit.</div>
      <div class="tag">Dermatology</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
    <div class="doc-card" data-dept="orthopedics" data-name="Dr. Liam Carter" data-loc="westside">
      <img src="{{ asset('mon/images/dr3.jpg') }}" alt="Doctor" class="doc-img" />
      <div class="doc-name">Dr. Liam Carter</div>
      <div class="doc-spec">Sports Medicine · MD</div>
      <div class="doc-desc">Deserunt pariatur eiusmod duis, officia aute laboris consectetur.</div>
      <div class="tag">Orthopedics</div>
      <div class="card-btns">
        <button class="btn-book">Book Appointment</button>
        <button class="btn-profile">View Profile</button>
      </div>
    </div>
  </div>

  <div class="no-results" id="no-results">
    <i class="fas fa-user-doctor"></i>
    <p id="no-results-txt">No doctors found matching your search.</p>
  </div>

  <!-- FEATURED PROFILE -->
  <div class="featured-profile">
    <div class="fp-img">
      <img src="{{ asset('mon/images/dr1.jpg') }}" alt="Dr. Sofia Bennett" />
      <div class="fp-avail"><span class="dot"></span><span id="fp-avail-txt">Available this week</span></div>
    </div>
    <div class="fp-body">
      <div class="fp-badges">
        <span class="fp-badge teal" id="fp-b1">Chief Surgeon</span>
        <span class="fp-badge blue" id="fp-b2">12+ Years Experience</span>
        <span class="fp-badge blue" id="fp-b3">Board Certified</span>
      </div>
      <h2 id="fp-name">Dr. Sofia Bennett</h2>
      <p class="fp-spec" id="fp-spec">General Surgery · MD, FACS</p>
      <p class="fp-desc" id="fp-desc">Commodo incididunt aliqua minim eiusmod in laboris nulla. Amet do occaecat quis, excepteur in magna id dolore incididunt.</p>
      <ul class="fp-details">
        <li><i class="fas fa-hospital"></i><span id="fp-d1">Residency: St. Mary's Medical Center</span></li>
        <li><i class="fas fa-user-md"></i><span id="fp-d2">Fellowship: Advanced Laparoscopy</span></li>
        <li><i class="fas fa-file-alt"></i><span id="fp-d3">Publications: 14 peer-reviewed articles</span></li>
      </ul>
      <div class="fp-actions">
        <a href="#" class="btn-gold" id="fp-book"><i class="fas fa-calendar-check"></i>Book Appointment</a>
        <a href="#" class="btn-outline-gold" id="fp-cv"><i class="fas fa-file-lines"></i>View CV</a>
      </div>
    </div>
  </div>

  <!-- MINI PROFILES ROW -->
  <div class="mini-profiles">
    <div class="mini-item">
      <img src="{{ asset('mon/images/dr1.jpg') }}" class="mini-img" alt="" />
      <div class="mini-name" id="mn1">Dr. Oliver Hayes</div>
      <div class="mini-sub"  id="ms1">Pediatrics</div>
    </div>
    <div class="mini-item">
      <img src="{{ asset('mon/images/dr3.jpg') }}" class="mini-img" alt="" />
      <div class="mini-name" id="mn2">Dr. Noah Turner</div>
      <div class="mini-sub"  id="ms2">Pediatrics</div>
    </div>
    <div class="mini-item">
      <img src="{{ asset('mon/images/dr2.jpg') }}" class="mini-img" alt="" />
      <div class="mini-name" id="mn3">Dr. Amelia Brooks</div>
      <div class="mini-sub"  id="ms3">Cardiology</div>
    </div>
    <div class="mini-item">
      <img src="{{ asset('mon/images/dr4.jpg') }}" class="mini-img" alt="" />
      <div class="mini-name" id="mn4">Dr. Harper Lane</div>
      <div class="mini-sub"  id="ms4">Dermatology</div>
    </div>
  </div>

  <!-- SINGLE DOCTOR PROFILE -->
  <section class="mc-section">
    <div class="single-profile-grid">
      <div class="sp-media">
        <img src="{{ asset('mon/images/dr3.jpg') }}" alt="Dr. Natalia Rivera" />
        <div class="sp-avail-tag"><span class="dot"></span><span id="sp-avail">Available this week</span></div>
      </div>
      <div class="sp-body">
        <div class="sp-badges">
          <span class="sp-badge dark"  id="sp-b1">Chief Surgeon</span>
          <span class="sp-badge blue"  id="sp-b2">12+ Years Experience</span>
          <span class="sp-badge green" id="sp-b3">Board Certified</span>
        </div>
        <h2 id="sp-name">Dr. Natalia Rivera</h2>
        <span class="sp-spec-txt" id="sp-spec">General Surgery · MD, FACS</span>
        <p class="sp-bio-txt" id="sp-bio">Commodo incididunt aliqua minim, eiusmod in laboris nulla. Amet do occaecat quis, excepteur in magna id dolore incididunt. Tempor in aute ullamco, irure officia aliqua nostrud exercitation.</p>
        <ul class="sp-highlights">
          <li><i class="fas fa-graduation-cap"></i><span id="sp-d1">Residency: St. Mary's Medical Center</span></li>
          <li><i class="fas fa-hospital"></i><span id="sp-d2">Fellowship: Advanced Laparoscopy</span></li>
          <li><i class="fas fa-award"></i><span id="sp-d3">Publications: 14 peer-reviewed articles</span></li>
        </ul>
        <div class="sp-actions">
          <a href="#" class="btn-gold" id="sp-book"><i class="fas fa-calendar-check"></i>Book Appointment</a>
          <a href="#" class="btn-outline-gold" id="sp-cv"><i class="fas fa-file-lines"></i>View CV</a>
        </div>
      </div>
    </div>
  </section>

  <!-- COMPACT MINI CARDS -->
  <section class="mc-section">
    <h3 class="mc-section-title anim-heading" id="compact-title">Meet Our Team</h3>
    <p class="mc-section-sub" id="compact-sub">A dedicated group of specialists committed to your health</p>
    <div class="compact-grid">
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr1.jpg') }}" alt=""/><div class="mcn-name" id="cm1">Dr. Oliver Hayes</div><div class="mcn-spec" id="cs1">Pediatrics</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr4.jpg') }}" alt=""/><div class="mcn-name" id="cm2">Dr. Noah Turner</div><div class="mcn-spec" id="cs2">Pediatrics</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr3.jpg') }}" alt=""/><div class="mcn-name" id="cm3">Dr. Liam Carter</div><div class="mcn-spec" id="cs3">Orthopedics</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr1.jpg') }}" alt=""/><div class="mcn-name" id="cm4">Dr. Amelia Brooks</div><div class="mcn-spec" id="cs4">Cardiology</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr2.jpg') }}" alt=""/><div class="mcn-name" id="cm5">Dr. Harper Lane</div><div class="mcn-spec" id="cs5">Dermatology</div></div>
      <div class="mini-card-new"><img src="{{ asset('mon/images/dr4.jpg') }}" alt=""/><div class="mcn-name" id="cm6">Dr. Lucas Grant</div><div class="mcn-spec" id="cs6">Pulmonology</div></div>
    </div>
    <br><br>
  </section>

  <!-- BOTTOM PROFILE -->
  <div class="bottom-profile mc-section">
    <div class="bp-left">
      <div class="bp-img-wrap">
        <img src="{{ asset('mon/images/dr4.jpg') }}" alt="Dr. Henry James" />
      </div>
      <div class="bp-name"     id="bp-name">Dr. Henry James</div>
      <div class="bp-spec-txt" id="bp-spec">Oncology · MBBS, MD</div>
      <div class="bp-tags">
        <span class="bp-tag" id="bp-tag1">Board Certified</span>
        <span class="bp-tag" id="bp-tag2">8 Years Experience</span>
      </div>
    </div>
    <div class="bp-right">
      <div class="bp-tabs">
        <button class="bp-tab active" data-pane="bp-bio"      id="bpt1">Bio</button>
        <button class="bp-tab"        data-pane="bp-schedule" id="bpt2">Schedule</button>
        <button class="bp-tab"        data-pane="bp-reviews"  id="bpt3">Reviews</button>
      </div>
      <div class="bp-pane active" id="bp-bio">
        <p id="bp-desc">Fugiat proident aliqua laboris, excepteur sunt ad pariatur occaecat. Veniam minim eu laboris, magna irure velit anim excepteur exercitation.</p>
        <ul class="bp-checklist">
          <li><i class="fas fa-circle-check"></i><span id="bp-c1">Special interest in immunotherapy</span></li>
          <li><i class="fas fa-circle-check"></i><span id="bp-c2">Member of ASCO</span></li>
          <li><i class="fas fa-circle-check"></i><span id="bp-c3">Community outreach programs</span></li>
        </ul>
      </div>
      <div class="bp-pane" id="bp-schedule">
        <div class="bp-slots">
          <div class="bp-slot"><strong id="d-mon">Mon</strong><span>9:00 AM – 1:00 PM</span></div>
          <div class="bp-slot"><strong id="d-tue">Tue</strong><span>12:00 PM – 6:00 PM</span></div>
          <div class="bp-slot"><strong id="d-wed">Wed</strong><span>9:00 AM – 3:00 PM</span></div>
          <div class="bp-slot"><strong id="d-thu">Thu</strong><span>10:00 AM – 4:00 PM</span></div>
          <div class="bp-slot closed"><strong id="d-fri">Fri</strong><span id="d-closed">Closed</span></div>
        </div>
        <a href="#" class="btn-gold" id="bp-slot-btn"><i class="fas fa-calendar-days"></i>Reserve a Slot</a>
      </div>
      <div class="bp-pane" id="bp-reviews">
        <div class="bp-stars">
          <i class="fas fa-star"></i><i class="fas fa-star"></i>
          <i class="fas fa-star"></i><i class="fas fa-star"></i>
          <i class="fas fa-star-half-stroke"></i>
        </div>
        <p class="bp-rev-meta" id="bp-rev-meta">4.5 / 5 · 32 reviews</p>
        <p class="bp-rev-text" id="bp-rev-text">Id magna consequat minim in, lorem dolore fugiat. Officia irure ex anim, velit nulla cupidatat laboris enim commodo ut elit.</p>
      </div>
    </div>
  </div>

</div><!-- /container -->
@endsection

@push('scripts')
<script>
// ====================== PAGE TRANSLATIONS ======================
const pageTranslations = {
  en: {
    h1:'Doctors', sub:'Find the right specialist for your needs. Browse our team of board-certified professionals dedicated to your health and wellbeing.',
    lblS:'Search Doctors', lblD:'Department', lblL:'Location', ph:'Type a name or keyword',
    depts:['All Departments','Cardiology','Pediatrics','Dermatology','Orthopedics'],
    locs:['All Locations','Downtown Clinic','Westside Center','Riverside Campus'],
    apply:'Apply Filters', tabs:['All','Cardiology','Pediatrics','Dermatology','Orthopedics'],
    bSenior:'Senior Consultant', bNew:'New',
    cNames:['Dr. Amelia Brooks','Dr. Noah Turner','Dr. Sofia Bennett','Dr. Ethan Cole','Dr. Maya Patel','Dr. Oliver Hayes','Dr. Harper Lane','Dr. Liam Carter'],
    cSpecs:['Cardiologist · MD, FACC','Pediatrician · DO','Dermatologist · MBBS, MD','Orthopedic Surgeon · MS, FRCS','Interventional Cardiologist · MD','Pediatric Specialist · MD','Cosmetic Dermatologist · MD','Sports Medicine · MD'],
    cTags:['Cardiology','Pediatrics','Dermatology','Orthopedics','Cardiology','Pediatrics','Dermatology','Orthopedics'],
    cBook:'Book Appointment', cProf:'View Profile', noRes:'No doctors found matching your search.',
    fpAvail:'Available this week', fpB:['Chief Surgeon','12+ Years Experience','Board Certified'],
    fpName:'Dr. Sofia Bennett', fpSpec:'General Surgery · MD, FACS',
    fpDesc:'Commodo incididunt aliqua minim eiusmod in laboris nulla. Amet do occaecat quis, excepteur in magna id dolore incididunt.',
    fpD:["Residency: St. Mary's Medical Center","Fellowship: Advanced Laparoscopy","Publications: 14 peer-reviewed articles"],
    fpBook:'Book Appointment', fpCV:'View CV',
    miniN:['Dr. Oliver Hayes','Dr. Noah Turner','Dr. Amelia Brooks','Dr. Harper Lane'],
    miniS:['Pediatrics','Pediatrics','Cardiology','Dermatology'],
    spAvail:'Available this week', spB:['Chief Surgeon','12+ Years Experience','Board Certified'],
    spName:'Dr. Natalia Rivera', spSpec:'General Surgery · MD, FACS',
    spBio:'Commodo incididunt aliqua minim, eiusmod in laboris nulla. Amet do occaecat quis, excepteur in magna id dolore incididunt. Tempor in aute ullamco, irure officia aliqua nostrud exercitation.',
    spD:["Residency: St. Mary's Medical Center","Fellowship: Advanced Laparoscopy","Publications: 14 peer-reviewed articles"],
    spBook:'Book Appointment', spCV:'View CV',
    ctTitle:'Meet Our Team', ctSub:'A dedicated group of specialists committed to your health',
    ctN:['Dr. Oliver Hayes','Dr. Noah Turner','Dr. Liam Carter','Dr. Amelia Brooks','Dr. Harper Lane','Dr. Lucas Grant'],
    ctS:['Pediatrics','Pediatrics','Orthopedics','Cardiology','Dermatology','Pulmonology'],
    bpName:'Dr. Henry James', bpSpec:'Oncology · MBBS, MD', bpTags:['Board Certified','8 Years Experience'],
    bpTabs:['Bio','Schedule','Reviews'],
    bpDesc:'Fugiat proident aliqua laboris, excepteur sunt ad pariatur occaecat. Veniam minim eu laboris, magna irure velit anim excepteur exercitation.',
    bpC:['Special interest in immunotherapy','Member of ASCO','Community outreach programs'],
    days:['Mon','Tue','Wed','Thu','Fri'], closed:'Closed', slotBtn:'Reserve a Slot',
    revMeta:'4.5 / 5 · 32 reviews',
    revText:'Id magna consequat minim in, lorem dolore fugiat. Officia irure ex anim, velit nulla cupidatat laboris enim commodo ut elit.'
  },
  ar: {
    h1:'الأطباء', sub:'ابحث عن الطبيب المناسب لاحتياجاتك. تصفح فريقنا من الأطباء المعتمدين المتخصصين في صحتك.',
    lblS:'البحث عن طبيب', lblD:'القسم', lblL:'الموقع', ph:'اكتب اسماً أو كلمة مفتاحية',
    depts:['كل الأقسام','القلب','الأطفال','الجلدية','العظام'],
    locs:['كل المواقع','العيادة المركزية','مركز الغرب','حرم النهر'],
    apply:'تطبيق الفلتر', tabs:['الكل','القلب','الأطفال','الجلدية','العظام'],
    bSenior:'استشاري أول', bNew:'جديد',
    cNames:['د. أميليا بروكس','د. نوح تيرنر','د. صوفيا بينيت','د. إيثان كول','د. مايا باتيل','د. أوليفر هايز','د. هاربر لين','د. ليام كارتر'],
    cSpecs:['إخصائية قلب · MD, FACC','إخصائي أطفال · DO','إخصائية جلدية · MBBS, MD','جراح عظام · MS, FRCS','أخصائي قلب تدخلي · MD','أخصائي أطفال · MD','أخصائية جلدية تجميلية · MD','طب الرياضة · MD'],
    cTags:['القلب','الأطفال','الجلدية','العظام','القلب','الأطفال','الجلدية','العظام'],
    cBook:'حجز موعد', cProf:'عرض الملف', noRes:'لا يوجد أطباء مطابقون لبحثك.',
    fpAvail:'متاح هذا الأسبوع', fpB:['رئيس جراحين','خبرة +12 سنة','بورد معتمد'],
    fpName:'د. صوفيا بينيت', fpSpec:'جراحة عامة · MD, FACS',
    fpDesc:'خبيرة في العمليات الجراحية المعقدة باستخدام أحدث التقنيات العالمية والمناظير الجراحية.',
    fpD:['الإقامة: مركز سانت ماري الطبي','الزمالة: مناظير متقدمة','المنشورات: 14 مقالاً علمياً محكماً'],
    fpBook:'حجز موعد', fpCV:'عرض السيرة',
    miniN:['د. أوليفر هايز','د. نوح تيرنر','د. أميليا بروكس','د. هاربر لين'],
    miniS:['طب الأطفال','طب الأطفال','طب القلب','طب الجلدية'],
    spAvail:'متاح هذا الأسبوع', spB:['رئيس جراحين','خبرة +12 سنة','بورد معتمد'],
    spName:'د. ناتاليا ريفيرا', spSpec:'جراحة عامة · MD, FACS',
    spBio:'خبيرة في الجراحة العامة والمناظير بأحدث التقنيات الطبية العالمية. تجمع بين الكفاءة المهنية والرحمة الكاملة في تعاملها مع مرضاها.',
    spD:['الإقامة: مركز سانت ماري الطبي','الزمالة: مناظير متقدمة','المنشورات: 14 مقالاً علمياً محكماً'],
    spBook:'حجز موعد', spCV:'عرض السيرة',
    ctTitle:'تعرف على فريقنا', ctSub:'مجموعة متخصصة من الأطباء ملتزمة بصحتك',
    ctN:['د. أوليفر هايز','د. نوح تيرنر','د. ليام كارتر','د. أميليا بروكس','د. هاربر لين','د. لوكاس جرانت'],
    ctS:['طب الأطفال','طب الأطفال','العظام','طب القلب','طب الجلدية','أمراض الرئة'],
    bpName:'د. هنري جيمس', bpSpec:'أورام · MBBS, MD', bpTags:['بورد معتمد','8 سنوات خبرة'],
    bpTabs:['السيرة','المواعيد','التقييمات'],
    bpDesc:'متخصص في علاج الأورام بأحدث البروتوكولات العلاجية العالمية مع اهتمام خاص بالعلاج المناعي.',
    bpC:['اهتمام خاص بالعلاج المناعي','عضو في جمعية ASCO','برامج التوعية المجتمعية'],
    days:['الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'], closed:'مغلق', slotBtn:'حجز وقت',
    revMeta:'4.5 / 5 · 32 تقييم',
    revText:'الدكتور على مستوى عالٍ من الكفاءة والأمانة في التشخيص. أنصح به بشدة لجميع المرضى.'
  }
};

window.applyPageTranslation = function(currentLang) {
  const t = pageTranslations[currentLang];
  if (!t) return;
  document.getElementById('doc-h1').innerText = t.h1;
  document.getElementById('doc-sub').innerText = t.sub;
  document.getElementById('lbl-search').innerText = t.lblS;
  document.getElementById('lbl-dept').innerText = t.lblD;
  document.getElementById('lbl-loc').innerText = t.lblL;
  document.getElementById('search-input').placeholder = t.ph;
  document.getElementById('btn-apply').innerText = t.apply;
  document.getElementById('no-results-txt').innerText = t.noRes;
  const deptSelect = document.getElementById('dept-select');
  for (let i = 0; i < deptSelect.options.length; i++) { if (t.depts[i]) deptSelect.options[i].innerText = t.depts[i]; }
  const locSelect = document.getElementById('loc-select');
  for (let i = 0; i < locSelect.options.length; i++) { if (t.locs[i]) locSelect.options[i].innerText = t.locs[i]; }
  const tabs = document.querySelectorAll('#tabs-bar .tab');
  tabs.forEach((tab, idx) => { if (t.tabs[idx]) tab.innerText = t.tabs[idx]; });
  const seniorBadge = document.getElementById('badge-senior');
  if (seniorBadge) seniorBadge.innerText = t.bSenior;
  const newBadge = document.getElementById('badge-new');
  if (newBadge) newBadge.innerText = t.bNew;
  const cards = document.querySelectorAll('#doctors-grid .doc-card');
  cards.forEach((card, i) => {
    const nameDiv = card.querySelector('.doc-name');
    if (nameDiv && t.cNames[i]) nameDiv.innerText = t.cNames[i];
    const specDiv = card.querySelector('.doc-spec');
    if (specDiv && t.cSpecs[i]) specDiv.innerText = t.cSpecs[i];
    const tagDiv = card.querySelector('.tag');
    if (tagDiv && t.cTags[i]) tagDiv.innerText = t.cTags[i];
    const bookBtn = card.querySelector('.btn-book');
    if (bookBtn) bookBtn.innerText = t.cBook;
    const profileBtn = card.querySelector('.btn-profile');
    if (profileBtn) profileBtn.innerText = t.cProf;
  });
  document.getElementById('fp-avail-txt').innerText = t.fpAvail;
  document.getElementById('fp-b1').innerText = t.fpB[0];
  document.getElementById('fp-b2').innerText = t.fpB[1];
  document.getElementById('fp-b3').innerText = t.fpB[2];
  document.getElementById('fp-name').innerText = t.fpName;
  document.getElementById('fp-spec').innerText = t.fpSpec;
  document.getElementById('fp-desc').innerText = t.fpDesc;
  document.getElementById('fp-d1').innerText = t.fpD[0];
  document.getElementById('fp-d2').innerText = t.fpD[1];
  document.getElementById('fp-d3').innerText = t.fpD[2];
  document.getElementById('fp-book').innerHTML = `<i class="fas fa-calendar-check"></i>${t.fpBook}`;
  document.getElementById('fp-cv').innerHTML = `<i class="fas fa-file-lines"></i>${t.fpCV}`;
  for (let i = 1; i <= 4; i++) {
    const nameEl = document.getElementById(`mn${i}`); if (nameEl) nameEl.innerText = t.miniN[i-1];
    const subEl  = document.getElementById(`ms${i}`);  if (subEl)  subEl.innerText  = t.miniS[i-1];
  }
  document.getElementById('sp-avail').innerText = t.spAvail;
  document.getElementById('sp-b1').innerText = t.spB[0];
  document.getElementById('sp-b2').innerText = t.spB[1];
  document.getElementById('sp-b3').innerText = t.spB[2];
  document.getElementById('sp-name').innerText = t.spName;
  document.getElementById('sp-spec').innerText = t.spSpec;
  document.getElementById('sp-bio').innerText = t.spBio;
  document.getElementById('sp-d1').innerText = t.spD[0];
  document.getElementById('sp-d2').innerText = t.spD[1];
  document.getElementById('sp-d3').innerText = t.spD[2];
  document.getElementById('sp-book').innerHTML = `<i class="fas fa-calendar-check"></i>${t.spBook}`;
  document.getElementById('sp-cv').innerHTML = `<i class="fas fa-file-lines"></i>${t.spCV}`;
  document.getElementById('compact-title').innerText = t.ctTitle;
  document.getElementById('compact-sub').innerText = t.ctSub;
  for (let i = 1; i <= 6; i++) {
    const nameEl = document.getElementById(`cm${i}`); if (nameEl) nameEl.innerText = t.ctN[i-1];
    const specEl = document.getElementById(`cs${i}`); if (specEl) specEl.innerText = t.ctS[i-1];
  }
  document.getElementById('bp-name').innerText = t.bpName;
  document.getElementById('bp-spec').innerText = t.bpSpec;
  document.getElementById('bp-tag1').innerText = t.bpTags[0];
  document.getElementById('bp-tag2').innerText = t.bpTags[1];
  document.getElementById('bpt1').innerText = t.bpTabs[0];
  document.getElementById('bpt2').innerText = t.bpTabs[1];
  document.getElementById('bpt3').innerText = t.bpTabs[2];
  document.getElementById('bp-desc').innerText = t.bpDesc;
  document.getElementById('bp-c1').innerText = t.bpC[0];
  document.getElementById('bp-c2').innerText = t.bpC[1];
  document.getElementById('bp-c3').innerText = t.bpC[2];
  document.getElementById('d-mon').innerText = t.days[0];
  document.getElementById('d-tue').innerText = t.days[1];
  document.getElementById('d-wed').innerText = t.days[2];
  document.getElementById('d-thu').innerText = t.days[3];
  document.getElementById('d-fri').innerText = t.days[4];
  document.getElementById('d-closed').innerText = t.closed;
  document.getElementById('bp-slot-btn').innerHTML = `<i class="fas fa-calendar-days"></i>${t.slotBtn}`;
  document.getElementById('bp-rev-meta').innerText = t.revMeta;
  document.getElementById('bp-rev-text').innerText = t.revText;
};

// ====================== SCROLL REVEAL FOR DOCTOR CARDS ======================
let cardObserver = null;

function initCardScrollReveal() {
  if (cardObserver) cardObserver.disconnect();
  const cards = document.querySelectorAll('#doctors-grid .doc-card:not(.hidden)');
  const isMobile = window.innerWidth <= 768;
  cardObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const card = entry.target;
        if (card.classList.contains('card-visible')) return;
        const allVisibleCards = Array.from(document.querySelectorAll('#doctors-grid .doc-card:not(.hidden):not(.card-visible)'));
        const currentIndex = allVisibleCards.indexOf(card);
        let delay = 0;
        if (isMobile) {
          // على الموبايل: تأخير أكبر بين الكروت (كل 0.3 ثانية)
          delay = currentIndex * 0.3;
        } else {
          delay = currentIndex * 0.07;
        }
        card.style.animationDelay = `${delay}s`;
        card.classList.add('card-visible');
        cardObserver.unobserve(card);
      }
    });
  }, { threshold: 0.2, rootMargin: '0px 0px -20px 0px' });
  cards.forEach(card => cardObserver.observe(card));
}

// ====================== FILTERS ======================
let activeFilter = 'all';
function applyFilters() {
  const q = document.getElementById('search-input').value.trim().toLowerCase();
  const dept = document.getElementById('dept-select').value;
  const loc = document.getElementById('loc-select').value;
  let visible = 0;
  
  // Add animation class to apply button for visual feedback
  const applyBtn = document.getElementById('btn-apply');
  if (applyBtn) {
    applyBtn.classList.add('filter-animation');
    setTimeout(() => {
      applyBtn.classList.remove('filter-animation');
    }, 500);
  }
  
  document.querySelectorAll('#doctors-grid .doc-card').forEach(card => {
    const ok = (!q || (card.dataset.name || '').toLowerCase().includes(q)) &&
               (dept === 'all' || card.dataset.dept === dept) &&
               (loc === 'all' || card.dataset.loc === loc) &&
               (activeFilter === 'all' || card.dataset.dept === activeFilter);
    card.classList.toggle('hidden', !ok);
    if (ok) visible++;
  });
  document.getElementById('no-results').style.display = visible === 0 ? 'block' : 'none';
  // إعادة تهيئة مراقب التقاطع للكروت المرئية الجديدة
  initCardScrollReveal();
}

document.getElementById('tabs-bar').addEventListener('click', (e) => {
  const tab = e.target.closest('.tab');
  if (!tab) return;
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  tab.classList.add('active');
  activeFilter = tab.dataset.filter;
  document.getElementById('dept-select').value = activeFilter;
  applyFilters();
});
document.getElementById('search-input').addEventListener('input', applyFilters);
document.getElementById('dept-select').addEventListener('change', function() {
  activeFilter = this.value;
  document.querySelectorAll('.tab').forEach(t => t.classList.toggle('active', t.dataset.filter === activeFilter));
  applyFilters();
});
document.getElementById('loc-select').addEventListener('change', applyFilters);
document.getElementById('btn-apply').addEventListener('click', applyFilters);

document.querySelectorAll('.bp-tab').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.bp-tab').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.bp-pane').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(btn.dataset.pane).classList.add('active');
  });
});

// ====================== OTHER ANIMATIONS (SCROLL REVEAL FOR SECTIONS, RIPPLE) ======================
(function () {
  'use strict';
  const srObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        srObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

  function initOtherAnimations() {
    const fp = document.querySelector('.featured-profile');
    if (fp) { fp.classList.add('sr'); srObs.observe(fp); }
    const mini = document.querySelector('.mini-profiles');
    if (mini) { mini.classList.add('sr-stagger'); srObs.observe(mini); }
    const spMedia = document.querySelector('.sp-media');
    if (spMedia) { spMedia.classList.add('sr', 'sr-left'); srObs.observe(spMedia); }
    const spBody = document.querySelector('.sp-body');
    if (spBody) { spBody.classList.add('sr', 'sr-right'); srObs.observe(spBody); }
    const compact = document.querySelector('.compact-grid');
    if (compact) { compact.classList.add('sr-stagger'); srObs.observe(compact); }
    document.querySelectorAll('.mc-section-title, .mc-section-sub').forEach((el, i) => {
      el.classList.add('sr');
      el.style.transitionDelay = (i * 0.12) + 's';
      srObs.observe(el);
    });
    const bp = document.querySelector('.bottom-profile');
    if (bp) { bp.classList.add('sr'); srObs.observe(bp); }
    document.querySelectorAll('.anim-heading').forEach(el => {
      const hObs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); hObs.unobserve(e.target); }});
      }, { threshold: 0.5 });
      hObs.observe(el);
    });
  }

  function addRipple(btn) {
    btn.addEventListener('click', function(e) {
      const ex = this.querySelector('.rpl');
      if (ex) ex.remove();
      const rpl = document.createElement('span');
      rpl.className = 'rpl';
      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height) * 1.5;
      rpl.style.cssText = `position:absolute;border-radius:50%;width:${size}px;height:${size}px;top:${e.clientY-rect.top-size/2}px;left:${e.clientX-rect.left-size/2}px;background:rgba(255,255,255,0.22);transform:scale(0);animation:rplAnim 0.5s ease forwards;pointer-events:none;`;
      this.appendChild(rpl);
      setTimeout(() => rpl.remove(), 550);
    });
  }
  function initRipples() {
    document.querySelectorAll('.btn-book, .btn-apply, .btn-gold').forEach(addRipple);
  }
  function initSearchAnim() {
    const input = document.getElementById('search-input');
    if (!input) return;
    const phrases = ['Type a name or keyword', 'Dr. Amelia Brooks...', 'Cardiology...', 'Pediatric Specialist...'];
    let idx = 0;
    setInterval(() => {
      if (document.activeElement !== input) {
        idx = (idx + 1) % phrases.length;
        input.placeholder = phrases[idx];
      }
    }, 2800);
  }
  document.querySelectorAll('.bp-tab').forEach(btn => {
    btn.addEventListener('click', () => {
      if (btn.dataset.pane === 'bp-reviews') {
        const stars = document.querySelectorAll('.bp-stars i');
        stars.forEach((star, i) => {
          star.style.animation = 'none';
          setTimeout(() => {
            star.style.animation = `iconPop 0.4s var(--ease-bounce) ${i * 0.08}s both`;
          }, 10);
        });
      }
    });
  });

  function init() {
    initOtherAnimations();
    initRipples();
    initSearchAnim();
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

// ====================== INITIAL LOAD ======================
document.addEventListener('DOMContentLoaded', () => {
  const currentLang = localStorage.getItem('siteLang') || 'en';
  if (window.applyPageTranslation) window.applyPageTranslation(currentLang);
  applyFilters(); // this will also call initCardScrollReveal()
});
</script>
@endpush   
@extends('layouts.patient')

@section('title', __('messages.dashboard') . ' - MediCare')

@push('styles')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════════
   VARIABLES 
══════════════════════════════════════════════ */
:root {
  --blue:  #1a6bff;
  --teal:  #00c9a7;
  --amber: #ffb520;
  --rose:  #ff4f6d;
  --navy:  #0b1d35;
  --sky:   #c8e0ff;
  --surf:  #f0f5ff;
  --card:  #ffffff;
  --bdr:   rgba(26,107,255,0.09);
  --muted: #7a8bad;
  --r-xl:  18px;
  --r-lg:  12px;
  --r-md:  8px;
  --sh-sm: 0 2px 10px rgba(11,29,53,0.06);
  --sh-md: 0 6px 28px rgba(11,29,53,0.10);
  --sh-lg: 0 16px 50px rgba(11,29,53,0.13);
}

/* ══════════════════════════════════════════════
   BASE RESET
══════════════════════════════════════════════ */
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0 }
html { -webkit-text-size-adjust:100%; overflow-x:hidden }
body { background:var(--surf); color:var(--navy); overflow-x:hidden; width:100% }

img { max-width:100%; display:block }
a { text-decoration:none; -webkit-tap-highlight-color:transparent; color:inherit }
button { -webkit-tap-highlight-color:transparent; cursor:pointer; font-family:inherit; border:none; background:none }

/* ══════════════════════════════════════════════
   ANIMATIONS 
══════════════════════════════════════════════ */
@keyframes fu { from { opacity:0; transform:translateY(12px) } to { opacity:1; transform:none } }
.a  { animation:fu .38s ease both }
.a1 { animation-delay:.04s } .a2 { animation-delay:.08s } .a3 { animation-delay:.12s }
.a4 { animation-delay:.16s } .a5 { animation-delay:.20s } .a6 { animation-delay:.24s }
.a7 { animation-delay:.28s } .a8 { animation-delay:.32s }

/* ══════════════════════════════════════════════
   PAGE WRAPPER — Responsive padding & full width
══════════════════════════════════════════════ */
.dw {
  width: 100%;
  padding: 20px;
  display: grid;
  gap: 16px;
  overflow-x: hidden;
}

/* ══════════════════════════════════════════════
   BANNER 
══════════════════════════════════════════════ */
.banner {
  background: linear-gradient(130deg,#0b1d35 0%,#1040a0 55%,#1a6bff 100%);
  border-radius: var(--r-xl);
  padding: 28px 28px;
  color: #fff;
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  box-shadow: var(--sh-lg);
}
.banner::before { content:''; position:absolute; inset:0; background:radial-gradient(ellipse at 75% -10%,rgba(255,255,255,0.09) 0%,transparent 60%); pointer-events:none }
.bd1 { position:absolute; right:-50px; top:-50px; width:240px; height:240px; background:radial-gradient(circle,rgba(255,255,255,0.05) 0%,transparent 70%); border-radius:50% }
.bd2 { position:absolute; right:100px; bottom:-50px; width:130px; height:130px; background:radial-gradient(circle,rgba(0,201,167,0.13) 0%,transparent 70%); border-radius:50% }

.b-left { position:relative; z-index:1; flex:1; min-width:0 }
.b-tag { display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.11); border:1px solid rgba(255,255,255,0.18); border-radius:50px; padding:4px 12px; font-size:10.5px; font-weight:600; letter-spacing:.04em; text-transform:uppercase; margin-bottom:12px; backdrop-filter:blur(6px) }
.b-dot { width:5px; height:5px; border-radius:50%; background:var(--teal); flex-shrink:0 }
.banner h2 { font-size:clamp(17px,2.8vw,32px); font-weight:800; line-height:1.2; margin-bottom:8px; word-break:break-word }
.banner p  { font-size:14px; opacity:.72; line-height:1.6; margin-bottom:20px; max-width:400px }
.b-actions { display:flex; gap:10px; flex-wrap:wrap }

.btn-w { background:#fff; color:var(--blue); border:none; border-radius:var(--r-md); padding:10px 18px;  font-weight:600; font-size:13px; display:inline-flex; align-items:center; gap:6px; white-space:nowrap; transition:transform .2s,box-shadow .2s; min-height:42px }
.btn-w:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,0.16) }
.btn-o { background:transparent; color:#fff; border:1.5px solid rgba(255,255,255,0.32); border-radius:var(--r-md); padding:10px 18px; font-weight:600; font-size:13px; display:inline-flex; align-items:center; gap:6px; white-space:nowrap; transition:background .2s,transform .2s; min-height:42px }
.btn-o:hover { background:rgba(255,255,255,0.11); transform:translateY(-2px) }

.b-right { position:relative; z-index:1; flex-shrink:0 }
.ring-wrap { width:148px; height:148px; position:relative; display:flex; align-items:center; justify-content:center }
.ring-wrap svg { position:absolute; inset:0; width:100%; height:100% }
.ring-c { text-align:center; position:relative; z-index:1 }
.ring-c .rs { font-size:30px; font-weight:800; color:#fff; line-height:1 }
.ring-c .rl { font-size:9px; opacity:.6; letter-spacing:.06em; text-transform:uppercase }

/* ══════════════════════════════════════════════
   STATS — إصلاح شامل لظهور الكلمات كاملة بدون اقتطاع للاب توب والديسك توب
══════════════════════════════════════════════ */
.stats { display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:14px }
.sc { background:var(--card); border-radius:var(--r-lg); padding:18px 16px; display:flex; align-items:center; gap:14px; box-shadow:var(--sh-sm); border:1px solid var(--bdr); transition:transform .25s,box-shadow .25s; position:relative; overflow:hidden }
.sc::after { content:''; position:absolute; top:-24px; right:-24px; width:72px; height:72px; border-radius:50%; opacity:.07 }
.sc.bl::after { background:var(--blue) } .sc.gr::after { background:var(--teal) } .sc.am::after { background:var(--amber) } .sc.rs::after { background:var(--rose) }
.sc:hover { transform:translateY(-3px); box-shadow:var(--sh-md) }
.si { border-radius:11px; display:flex; align-items:center; justify-content:center; flex-shrink:0; width:44px; height:44px; font-size:19px }
.si.bl { background:#e8f1ff; color:var(--blue) } .si.gr { background:#e0faf5; color:var(--teal) } .si.am { background:#fff4dc; color:var(--amber) } .si.rs { background:#ffe5ea; color:var(--rose) }

/* إصلاح العناوين والترجمات الطويلة هنا لتقبل الالتفاف الكامل الرأسي */
.sn { font-size:18px; font-weight:800; line-height:1.2; white-space: normal; word-break: break-word; }
.sl { font-size:11.5px; color:var(--muted); font-weight:500; margin-top:4px; white-space: normal; word-break: break-word; line-height: 1.3; }
.st { margin-top:6px; display:inline-flex; align-items:center; gap:3px; font-size:10.5px; font-weight:600; padding:3px 10px; border-radius:50px; white-space: normal; word-break: break-word; line-height: 1.2; text-align: left; }
.st.up { background:#e0faf5; color:#00a98d } .st.dn { background:#ffe5ea; color:#d4465e }

/* ══════════════════════════════════════════════
   QUICK ACTIONS
══════════════════════════════════════════════ */
.qa-title { font-size:15px; font-weight:700; margin-bottom:12px }
.qa-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:12px }
.qb { background:var(--card); border:1px solid var(--bdr); border-radius:var(--r-lg); padding:16px 10px; display:flex; flex-direction:column; align-items:center; gap:8px; transition:transform .2s,box-shadow .2s,border-color .2s; min-height:110px; justify-content: center; }
.qb:hover { transform:translateY(-3px); box-shadow:var(--sh-md); border-color:var(--sky) }
.qi { border-radius:10px; display:flex; align-items:center; justify-content:center; width:40px; height:40px; font-size:17px; flex-shrink:0 }
.ql { font-size:11.5px; font-weight:600; color:var(--navy); line-height:1.4; text-align:center; white-space: normal; word-break: break-word; }
.nd { display:inline-block; width:6px; height:6px; border-radius:50%; background:var(--rose); vertical-align:middle; margin-left:2px }

/* ══════════════════════════════════════════════
   ACTIVITY SPARKLINES
══════════════════════════════════════════════ */
.act-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px }
.act-card { background:var(--card); border-radius:var(--r-lg); padding:18px 16px; box-shadow:var(--sh-sm); border:1px solid var(--bdr) }
.act-top { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:10px; gap:8px }
.act-label { font-size:11px; color:var(--muted); font-weight:500 }
.act-val { font-size:22px; font-weight:800; line-height:1 }
.act-chg { font-size:10.5px; font-weight:600; padding:2px 8px; border-radius:50px; white-space:nowrap }
.act-chg.up { background:#e0faf5; color:#00a98d } .act-chg.dn { background:#ffe5ea; color:#d4465e }
.sparkline { width:100%; height:40px; display:block }

/* ══════════════════════════════════════════════
   CONTENT GRID — Left (wider) + Right (sidebar)
══════════════════════════════════════════════ */
.cg { display:grid; grid-template-columns:1fr 300px; gap:16px; align-items:start }
.col-l { display:grid; gap:16px }
.col-r { display:grid; gap:16px; align-content:start }

/* ══════════════════════════════════════════════
   PANEL — shared card style
══════════════════════════════════════════════ */
.pn { background:var(--card); border-radius:var(--r-xl); padding:20px 18px; box-shadow:var(--sh-sm); border:1px solid var(--bdr) }
.ph { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:8px }
.pt { font-size:14.5px; font-weight:700 }
.pl { font-size:12px; font-weight:600; color:var(--blue); opacity:.85; white-space:nowrap }
.pl:hover { opacity:1; text-decoration:underline }

/* ══════════════════════════════════════════════
   APPOINTMENTS
══════════════════════════════════════════════ */
.ai { display:flex; align-items:center; justify-content:space-between; padding:12px 14px; border-radius:var(--r-lg); margin-bottom:10px; border:1px solid var(--bdr); transition:background .2s,border-color .2s; position:relative; gap:10px }
.ai::before { content:''; position:absolute; left:0; top:50%; transform:translateY(-50%); width:4px; height:54%; border-radius:0 3px 3px 0; background:var(--blue) }
.ai.urg::before { background:var(--rose) } .ai.don::before { background:var(--teal) }
.ai:hover { background:var(--surf); border-color:var(--sky) }
.ai-l { display:flex; align-items:center; gap:11px; min-width:0; flex:1 }
.av  { width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid var(--sky); flex-shrink:0 }
.avp { width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; color:#fff; font-size:14px; flex-shrink:0 }
.ai-inf { min-width:0 }
.ad { font-weight:600; font-size:13px; margin-bottom:2px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis }
.as { font-size:11.5px; color:var(--muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis }
.ai-r { text-align:right; flex-shrink:0 }
.at { font-weight:600; font-size:12.5px }
.adate { font-size:11px; color:var(--muted); margin-bottom:4px }
.bp  { display:inline-block; padding:3px 10px; border-radius:50px; font-size:10.5px; font-weight:600; white-space:nowrap }
.b-ok { background:#e0faf5; color:#00a98d } .b-pd { background:#fff4dc; color:#c4870a } .b-dn { background:#e8f1ff; color:var(--blue) }

/* ══════════════════════════════════════════════
   VITALS
══════════════════════════════════════════════ */
.vr { display:flex; align-items:center; gap:10px; margin-bottom:13px }
.vi { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0 }
.vl { font-size:11px; color:var(--muted); margin-bottom:2px }
.vv { font-weight:700; font-size:13px }
.vbb { flex:1; height:5px; border-radius:5px; background:var(--surf); overflow:hidden; min-width:30px }
.vbf { height:100%; border-radius:5px }

/* ══════════════════════════════════════════════
   HEALTH SCORE RING (sidebar)
══════════════════════════════════════════════ */
.sr-wrap { display:flex; align-items:center; justify-content:center; padding:6px 0 16px }
.sr-in { text-align:center }
.sr-n { font-size:44px; font-weight:800; color:var(--blue); line-height:1 }
.sr-s { font-size:11.5px; color:var(--muted); margin-top:4px }

/* ══════════════════════════════════════════════
   MEDICATIONS
══════════════════════════════════════════════ */
.mi { display:flex; align-items:center; gap:11px; padding:11px 0; border-bottom:1px solid var(--bdr); flex-wrap:wrap }
.mi:last-child { border-bottom:none }
.mdot { width:8px; height:8px; border-radius:50%; flex-shrink:0 }
.mn   { font-weight:600; font-size:13px }
.mdose { font-size:11px; color:var(--muted) }
.mt2  { margin-left:auto; font-size:11px; font-weight:600; padding:3px 9px; border-radius:50px; background:var(--surf); white-space:nowrap; flex-shrink:0 }

/* ══════════════════════════════════════════════
   REPORTS TABLE
══════════════════════════════════════════════ */
.rt { width:100%; border-collapse:collapse }
.rt th { font-size:10.5px; text-transform:uppercase; letter-spacing:.06em; color:var(--muted); font-weight:600; padding:0 0 11px; text-align:left; border-bottom:1px solid var(--bdr) }
.rt td { padding:10px 0; font-size:12.5px; border-bottom:1px solid var(--bdr); vertical-align:middle }
.rt tr:last-child td { border-bottom:none }
.rn { font-weight:600 }
.rtype { font-size:11px; color:var(--muted) }
.rdl { display:inline-flex; align-items:center; gap:4px; color:var(--blue); font-size:11.5px; font-weight:600; padding:4px 10px; border-radius:50px; background:var(--surf); transition:background .2s; white-space:nowrap }
.rdl:hover { background:#d4e5ff }

/* ══════════════════════════════════════════════
   DOCTORS
══════════════════════════════════════════════ */
.dc { display:flex; align-items:center; gap:10px; padding:12px 0; border-bottom:1px solid var(--bdr); flex-wrap:wrap }
.dc:last-child { border-bottom:none }
.dav  { width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid var(--sky); flex-shrink:0 }
.davp { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; color:#fff; font-size:13px; flex-shrink:0 }
.dname { font-weight:600; font-size:12.5px; margin-bottom:2px; word-break:break-word }
.dspec { font-size:11px; color:var(--muted) }
.dstar { font-size:10.5px; color:var(--amber) }
.doc-btn { background:var(--surf); border:1px solid var(--bdr); border-radius:var(--r-md); padding:5px 10px; font-size:11px; font-weight:600; color:var(--blue); white-space:nowrap; transition:background .2s; flex-shrink:0; margin-left:auto; min-height:32px }
.doc-btn:hover { background:#e8f1ff }

/* ══════════════════════════════════════════════
   MINI CALENDAR
══════════════════════════════════════════════ */
.cal { width:100% }
.cal-hd { display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; font-weight:700; font-size:13.5px; flex-wrap:wrap; gap:6px }
.cal-nav { border:1px solid var(--bdr); border-radius:7px; cursor:pointer; background:var(--surf); display:flex; align-items:center; justify-content:center; font-size:15px; transition:background .2s; width:34px; height:34px }
.cal-nav:hover { background:var(--sky) }
.cal-g { display:grid; grid-template-columns:repeat(7,1fr); gap:2px; text-align:center }
.cdn { font-size:10px; color:var(--muted); font-weight:600; padding-bottom:5px }
.cd { padding:5px 0; border-radius:6px; cursor:pointer; font-size:11.5px; transition:background .15s,color .15s; min-height:28px; display:flex; align-items:center; justify-content:center; flex-direction:column }
.cd:hover { background:var(--surf) }
.cd.today { background:var(--blue); color:#fff; font-weight:700 }
.cd.ha { font-weight:600 }
.cd.ha::after { content:''; display:block; width:4px; height:4px; border-radius:50%; background:var(--teal); margin:1px auto 0 }
.cd.oth { color:#c5ccd8 }

/* ══════════════════════════════════════════════
   TASKS & REMINDERS
══════════════════════════════════════════════ */
.task-item { display:flex; align-items:center; gap:11px; padding:11px 0; border-bottom:1px solid var(--bdr); flex-wrap:wrap }
.task-item:last-child { border-bottom:none }
.task-check { width:20px; height:20px; border-radius:6px; border:2px solid var(--bdr); display:flex; align-items:center; justify-content:center; flex-shrink:0; cursor:pointer; transition:background .2s,border-color .2s }
.task-check.done { background:var(--teal); border-color:var(--teal); color:#fff; font-size:11px }
.task-text { flex:1; min-width:0 }
.task-name { font-weight:600; font-size:13px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis }
.task-name.done { text-decoration:line-through; opacity:.5 }
.task-due { font-size:11px; color:var(--muted) }
.task-tag { flex-shrink:0; font-size:10.5px; font-weight:600; padding:3px 9px; border-radius:50px; white-space:nowrap }
.tag-med  { background:#e8f1ff; color:var(--blue) }
.tag-appt { background:#e0faf5; color:#00a98d }
.tag-lab  { background:#fff4dc; color:#c4870a }
.tag-ref  { background:#ffe5ea; color:#c4365a }

/* ══════════════════════════════════════════════
   INSURANCE CARD
══════════════════════════════════════════════ */
.ins-card { background:linear-gradient(135deg,#1040a0 0%,#1a6bff 100%); border-radius:var(--r-xl); padding:20px; color:#fff; position:relative; overflow:hidden; box-shadow:var(--sh-md) }
.ins-card::before { content:''; position:absolute; right:-30px; top:-30px; width:130px; height:130px; background:rgba(255,255,255,0.06); border-radius:50% }
.ins-chip { width:34px; height:25px; background:linear-gradient(135deg,var(--amber),#f7c948); border-radius:4px; margin-bottom:12px; position:relative; z-index:1 }
.ins-num {font-size:14px; font-weight:700; letter-spacing:.1em; opacity:.9; margin-bottom:12px; position:relative; z-index:1; word-break:break-all }
.ins-row { display:flex; justify-content:space-between; gap:10px; position:relative; z-index:1; flex-wrap:wrap }
.ins-field label { font-size:9px; opacity:.55; text-transform:uppercase; letter-spacing:.06em; display:block; margin-bottom:2px }
.ins-field span { font-weight:600; font-size:12px }
.ins-badge { margin-top:12px; display:inline-flex; align-items:center; gap:5px; background:rgba(255,255,255,0.14); border:1px solid rgba(255,255,255,0.22); border-radius:50px; padding:4px 12px; font-size:11px; font-weight:600; backdrop-filter:blur(6px); position:relative; z-index:1 }

/* ══════════════════════════════════════════════
   NOTIFICATIONS  
══════════════════════════════════════════════ */
.notif-item { display:flex; align-items:flex-start; gap:10px; padding:11px 0; border-bottom:1px solid var(--bdr); flex-wrap:wrap }
.notif-item:last-child { border-bottom:none }
.notif-icon { width:34px; height:34px; border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0 }
.notif-body { flex:1; min-width:0 }
.notif-title { font-weight:600; font-size:12.5px; margin-bottom:2px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis }
.notif-sub   { font-size:11px; color:var(--muted) }
.notif-time  { font-size:10px; color:var(--muted); white-space:nowrap; flex-shrink:0; margin-top:2px }
.n-unread::before { content:''; display:inline-block; width:6px; height:6px; border-radius:50%; background:var(--blue); margin-right:5px; vertical-align:middle; flex-shrink:0 }

/* ══════════════════════════════════════════════
   HEALTH GOALS
══════════════════════════════════════════════ */
.goal-item { margin-bottom:14px }
.goal-item:last-child { margin-bottom:0 }
.goal-top { display:flex; justify-content:space-between; align-items:center; margin-bottom:6px; gap:8px }
.goal-name { font-weight:600; font-size:12.5px }
.goal-pct  { font-size:11px; font-weight:700; color:var(--muted) }
.goal-bar  { width:100%; height:7px; border-radius:6px; background:var(--surf); overflow:hidden }
.goal-fill { height:100%; border-radius:6px; transition:width .6s ease }
.goal-sub  { font-size:10.5px; color:var(--muted); margin-top:4px }

/* ══════════════════════════════════════════════
   TIMELINE (Upcoming Labs)
══════════════════════════════════════════════ */
.timeline { position:relative; padding-left:20px }
.timeline::before { content:''; position:absolute; left:6px; top:0; bottom:0; width:2px; background:var(--bdr); border-radius:2px }
.tl-item { position:relative; margin-bottom:16px }
.tl-item:last-child { margin-bottom:0 }
.tl-dot { position:absolute; left:-17px; top:4px; width:11px; height:11px; border-radius:50%; border:2.5px solid var(--card) }
.tl-dot.bl { background:var(--blue); box-shadow:0 0 0 2px var(--blue) }
.tl-dot.gr { background:var(--teal); box-shadow:0 0 0 2px var(--teal) }
.tl-dot.am { background:var(--amber); box-shadow:0 0 0 2px var(--amber) }
.tl-dot.rs { background:var(--rose); box-shadow:0 0 0 2px var(--rose) }
.tl-title { font-weight:600; font-size:12.5px; margin-bottom:2px; word-break:break-word }
.tl-meta  { font-size:11px; color:var(--muted) }

/* ══════════════════════════════════════════════
   RESPONSIVE BREAKPOINTS (Adaptive CSS Fix)
══════════════════════════════════════════════ */

/* Large Desktop ≥1200px */
@media (min-width:1200px) {
  .dw  { padding:24px 28px; gap:18px }
  .cg  { grid-template-columns:1fr 310px }
  .banner h2 { font-size:30px }
  .ring-wrap { width:158px; height:158px }
}

/* Medium Desktop 992–1199px */
@media (max-width:1199px) {
  .cg { grid-template-columns:1fr 290px }
  .stats { grid-template-columns: repeat(2, 1fr); }
}

/* Tablet Landscape 768–991px */
@media (max-width:991px) {
  .dw { padding:16px }
  .cg { grid-template-columns:1fr }
  .col-r { display:grid; grid-template-columns:repeat(2,1fr); gap:14px }
  .col-r .ins-card,
  .col-r .pn:nth-child(1) { grid-column:1 / -1 }
  .stats { grid-template-columns:repeat(2,1fr) }
  .act-grid { grid-template-columns:repeat(3,1fr) }
  .qa-grid { grid-template-columns:repeat(2,1fr) }
}

/* Tablet Portrait 600–767px */
@media (max-width:767px) {
  .dw { padding:14px; gap:14px }
  .banner { padding:22px 20px }
  .banner p { display:none }
  .b-right { display:none }
  .stats { grid-template-columns:repeat(2,1fr); gap:12px }
  .sc { padding:14px 12px; gap:10px }
  .si { width:38px; height:38px; font-size:17px }
  .qa-grid { grid-template-columns:repeat(2,1fr); gap:10px }
  .qb { padding:14px 8px; gap:7px }
  .qi { width:36px; height:36px; font-size:15px }
  .ql { font-size:10.5px }
  .act-grid { grid-template-columns:repeat(3,1fr); gap:10px }
  .act-val { font-size:19px }
  .col-r { display:grid; grid-template-columns:1fr; gap:14px }
}

/* Mobile 0–599px */
@media (max-width:599px) {
  .dw { padding:12px; gap:12px }

  .banner { padding:18px 16px; border-radius:14px; flex-direction:column; align-items:flex-start }
  .b-right { display:none }
  .banner p { display:none }
  .banner h2 { font-size:20px }
  .b-tag { font-size:9.5px; padding:4px 10px }
  .b-actions { width:100% }
  .btn-w,.btn-o { flex:1; justify-content:center; font-size:12.5px; padding:10px 12px; white-space:normal; text-align:center }

  .stats { grid-template-columns: 1fr; gap: 10px }
  .sc { padding: 16px 14px; gap: 12px; border-radius: 12px }
  .si { width: 40px; height: 40px; font-size: 18px; border-radius: 10px }
  .sn { font-size: 22px }
  .sl { font-size: 12px; margin-top: 2px }
  .st { font-size: 10px; padding: 3px 8px; white-space: normal; text-align: center; display: inline-block }

  .qa-grid { grid-template-columns: repeat(2, 1fr); gap: 10px }
  .qb { padding: 16px 10px; gap: 10px; border-radius: 11px; min-height: 100px; justify-content: center }
  .qi { width: 42px; height: 42px; font-size: 18px; border-radius: 10px }
  .ql { font-size: 11.5px; white-space: normal; word-break: break-word }

  .act-grid { grid-template-columns:1fr; gap:10px }

  .cg { grid-template-columns:1fr }
  .col-r { grid-template-columns:1fr }

  .pn { padding:16px 14px; border-radius:14px }
  .ph { margin-bottom:14px }
  .pt { font-size:14px }
  .pl { font-size:11.5px }

  .ai { flex-wrap:wrap; padding:12px 12px }
  .ai-r { width:100%; display:flex; align-items:center; justify-content:space-between; margin-top:8px; padding-left:51px }
  .adate { margin-bottom:0 }
  .at { font-size:12px }
  .bp { font-size:10px; padding:2px 9px }

  .r-m { display:none }

  .dc { gap:9px }
  .dav,.davp { width:36px; height:36px; font-size:12px }
  .dname { font-size:12px }
  .dspec,.dstar { font-size:10.5px }

  .ins-num { font-size:13px; letter-spacing:.08em }
  .ins-field span { font-size:11.5px }

  .notif-title { font-size:12px }
  .notif-sub   { font-size:10.5px }

  .task-name { font-size:12.5px }
  .task-due  { font-size:10.5px }

  .goal-name { font-size:12px }

  .tl-title { font-size:12px }
  .tl-meta  { font-size:10.5px }

  .cal-hd { font-size:13px }
  .cd { font-size:11px; min-height:26px }
  .cdn { font-size:9.5px }
  .cal-nav { width:32px; height:32px; font-size:14px }

  .vr { gap:9px; margin-bottom:11px }
  .vi { width:30px; height:30px; font-size:13px; border-radius:7px }
  .vv { font-size:13px }
  .vl { font-size:10.5px }

  .sr-n { font-size:38px }
}

/* Extra small devices (≤380px) */
@media (max-width:380px) {
  .dw { padding:10px; gap:10px }
  .banner { padding:16px 14px }
  .banner h2 { font-size:18px }
  
  .stats { grid-template-columns: 1fr; gap:8px }
  .sc { padding:12px 10px; gap:10px }
  .si { width:36px; height:36px; font-size:16px }
  .sn { font-size:16px }
  .sl { font-size:11px }
  
  .qa-grid { grid-template-columns: repeat(2, 1fr); gap:8px }
  .qb { padding:12px 6px; min-height: 90px }
  .qi { width:36px; height:36px; font-size: 15px }
  .ql { font-size: 10px }
  
  .pn { padding:14px 12px }
  .pt { font-size:13.5px }
  .ai-r { padding-left:44px }
  .doc-btn { padding:4px 8px; font-size:10px }
}

/* Prevent horizontal overflow */
img, svg, iframe, .dw, .pn, .banner, .stats, .act-grid, .cg {
  max-width: 100%;
  overflow-x: hidden;
}
</style>
@endpush

@section('content')
<div class="dw">

{{-- ════════════════════════════════════════
     BANNER
════════════════════════════════════════ --}}
<div class="banner a a1">
  <div class="bd1"></div><div class="bd2"></div>
  <div class="b-left">
    <div class="b-tag"><span class="b-dot"></span>{{ __('messages.patient_portal') }}</div>
    <h2>{{ __('messages.welcome_greeting', ['name' => explode(' ', Auth::user()->name)[0]]) }} 👋</h2>
    <p>{{ __('messages.welcome_subtitle') }}</p>
    <div class="b-actions">
      <a href="{{ url('book_appointments') }}" class="btn-w"><i class="fa fa-calendar-plus-o"></i> {{ __('messages.book_now') }}</a>
      <a href="{{ url('medical_reports') }}" class="btn-o"><i class="fa fa-folder-open-o"></i> {{ __('messages.view_full_history') }}</a>
    </div>
  </div>
  <div class="b-right">
    <div class="ring-wrap">
      <svg viewBox="0 0 170 170" xmlns="http://www.w3.org/2000/svg">
        <circle cx="85" cy="85" r="70" fill="none" stroke="rgba(255,255,255,0.10)" stroke-width="11"/>
        <circle cx="85" cy="85" r="70" fill="none" stroke="url(#rg)" stroke-width="11" stroke-linecap="round" stroke-dasharray="440" stroke-dashoffset="35" transform="rotate(-90 85 85)"/>
        <defs><linearGradient id="rg" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#00c9a7"/><stop offset="100%" stop-color="#1a6bff"/></linearGradient></defs>
      </svg>
      <div class="ring-c"><div class="rs">92<span style="font-size:.5em">%</span></div><div class="rl">{{ __('messages.health_score') }}</div></div>
    </div>
  </div>
</div>

{{-- ════════════════════════════════════════
     STATS
════════════════════════════════════════ --}}
<div class="stats">
  <div class="sc bl a a2">
    <div class="si bl"><i class="fa fa-calendar-check-o"></i></div>
    <div><div class="sn">02</div><div class="sl">{{ __('messages.next_sessions') }}</div><div class="st up"><i class="fa fa-arrow-up"></i> {{ __('messages.this_week') }}</div></div>
  </div>
  <div class="sc gr a a2">
    <div class="si gr"><i class="fa fa-folder-open"></i></div>
    <div><div class="sn">14</div><div class="sl">{{ __('messages.medical_files') }}</div><div class="st up"><i class="fa fa-arrow-up"></i> +2 {{ __('messages.new') }}</div></div>
  </div>
  <div class="sc am a a3">
    <div class="si am"><i class="fa fa-medkit"></i></div>
    <div><div class="sn">03</div><div class="sl">{{ __('messages.active_meds') }}</div><div class="st dn"><i class="fa fa-clock-o"></i> {{ __('messages.refill_soon') }}</div></div>
  </div>
  <div class="sc rs a a3">
    <div class="si rs"><i class="fa fa-credit-card"></i></div>
    <div><div class="sn">{{ __('messages.premium') }}</div><div class="sl">{{ __('messages.insurance_tier') }}</div><div class="st up"><i class="fa fa-check"></i> {{ __('messages.active') }}</div></div>
  </div>
</div>

{{-- ════════════════════════════════════════
     QUICK ACTIONS
════════════════════════════════════════ --}}
<div class="a a4">
  <div class="qa-grid">
    <a href="{{ url('book_appointments') }}" class="qb">
      <div class="qi" style="background:#e8f1ff;color:var(--blue)"><i class="fa fa-calendar-plus-o"></i></div>
      <div class="ql">{{ __('messages.book_appointment') }}</div>
    </a>
    <a href="{{ url('medical_reports') }}" class="qb">
      <div class="qi" style="background:#e0faf5;color:var(--teal)"><i class="fa fa-file-text-o"></i></div>
      <div class="ql">{{ __('messages.my_reports') }}</div>
    </a>
    <a href="{{ url('prescriptions') }}" class="qb">
      <div class="qi" style="background:#fff4dc;color:var(--amber)"><i class="fa fa-medkit"></i></div>
      <div class="ql">{{ __('messages.prescriptions') }}</div>
    </a>
    <a href="{{ url('messages') }}" class="qb">
      <div class="qi" style="background:#ffe5ea;color:var(--rose)"><i class="fa fa-comment-o"></i></div>
      <div class="ql">{{ __('messages.messages') }}<span class="nd"></span></div>
    </a>
  </div>
</div>

{{-- ════════════════════════════════════════
     ACTIVITY SPARKLINES
════════════════════════════════════════ --}}
<div class="act-grid a a4">
  <div class="act-card">
    <div class="act-top">
      <div><div class="act-label">{{ __('messages.steps_today') }}</div><div class="act-val" style="color:var(--blue)">7,842</div></div>
      <span class="act-chg up">↑ 12%</span>
    </div>
    <svg class="sparkline" viewBox="0 0 120 40" preserveAspectRatio="none">
      <polyline fill="rgba(26,107,255,0.08)" stroke="none" points="0,32 20,26 40,16 60,22 80,8 100,14 120,6 120,40 0,40"/>
      <polyline fill="none" stroke="#1a6bff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="0,32 20,26 40,16 60,22 80,8 100,14 120,6"/>
    </svg>
  </div>
  <div class="act-card">
    <div class="act-top">
      <div><div class="act-label">{{ __('messages.calories_burned') }}</div><div class="act-val" style="color:var(--rose)">1,240</div></div>
      <span class="act-chg up">↑ 8%</span>
    </div>
    <svg class="sparkline" viewBox="0 0 120 40" preserveAspectRatio="none">
      <polyline fill="rgba(255,79,109,0.08)" stroke="none" points="0,34 20,28 40,20 60,24 80,12 100,18 120,10 120,40 0,40"/>
      <polyline fill="none" stroke="#ff4f6d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="0,34 20,28 40,20 60,24 80,12 100,18 120,10"/>
    </svg>
  </div>
  <div class="act-card">
    <div class="act-top">
      <div><div class="act-label">{{ __('messages.sleep_hours') }}</div><div class="act-val" style="color:var(--teal)">7.4h</div></div>
      <span class="act-chg dn">↓ 3%</span>
    </div>
    <svg class="sparkline" viewBox="0 0 120 40" preserveAspectRatio="none">
      <polyline fill="rgba(0,201,167,0.08)" stroke="none" points="0,14 20,18 40,10 60,20 80,14 100,22 120,16 120,40 0,40"/>
      <polyline fill="none" stroke="#00c9a7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="0,14 20,18 40,10 60,20 80,14 100,22 120,16"/>
    </svg>
  </div>
</div>

{{-- ════════════════════════════════════════
     MAIN CONTENT GRID
════════════════════════════════════════ --}}
<div class="cg">

  {{-- LEFT COLUMN --}}
  <div class="col-l">

    {{-- Schedule --}}
    <div class="pn a a4">
      <div class="ph"><div class="pt">{{ __('messages.my_schedule') }}</div><a href="{{ url('appointments') }}" class="pl">{{ __('messages.manage_all') }}</a></div>
      <div class="ai">
        <div class="ai-l">
          <img src="{{ asset('assets/img/doctor-thumb-01.jpg') }}" class="av" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
          <div class="avp" style="display:none">SM</div>
          <div class="ai-inf"><div class="ad">Dr. Sarah Mitchell</div><div class="as"><i class="fa fa-stethoscope" style="font-size:9px;margin-right:3px"></i>{{ __('messages.cardiology') }} • {{ __('messages.consultation') }}</div></div>
        </div>
        <div class="ai-r"><div class="adate">{{ __('messages.today') }}</div><div class="at">10:00 AM</div><span class="bp b-ok">{{ __('messages.confirmed') }}</span></div>
      </div>
      <div class="ai urg">
        <div class="ai-l">
          <div class="avp" style="background:linear-gradient(135deg,#ff4f6d,#ff9a6c)">JR</div>
          <div class="ai-inf"><div class="ad">Dr. James Reynolds</div><div class="as"><i class="fa fa-stethoscope" style="font-size:9px;margin-right:3px"></i>{{ __('messages.neurology') }} • {{ __('messages.follow_up') }}</div></div>
        </div>
        <div class="ai-r"><div class="adate">{{ __('messages.tomorrow') }}</div><div class="at">2:30 PM</div><span class="bp b-pd">{{ __('messages.pending') }}</span></div>
      </div>
      <div class="ai don">
        <div class="ai-l">
          <div class="avp" style="background:linear-gradient(135deg,#00c9a7,#00b4d8)">LK</div>
          <div class="ai-inf"><div class="ad">Dr. Layla Khan</div><div class="as"><i class="fa fa-stethoscope" style="font-size:9px;margin-right:3px"></i>{{ __('messages.dermatology') }} • {{ __('messages.check_up') }}</div></div>
        </div>
        <div class="ai-r"><div class="adate">{{ __('messages.last_monday') }}</div><div class="at">11:00 AM</div><span class="bp b-dn">{{ __('messages.completed') }}</span></div>
      </div>
    </div>

    {{-- Tasks --}}
    <div class="pn a a5">
      <div class="ph"><div class="pt">{{ __('messages.tasks_reminders') }}</div><a href="#" class="pl">{{ __('messages.see_all') }}</a></div>
      <div class="task-item">
        <div class="task-check done"><i class="fa fa-check"></i></div>
        <div class="task-text"><div class="task-name done">{{ __('messages.take_morning_meds') }}</div><div class="task-due">{{ __('messages.today') }} · 08:00 AM</div></div>
        <span class="task-tag tag-med">{{ __('messages.medication') }}</span>
      </div>
      <div class="task-item">
        <div class="task-check"></div>
        <div class="task-text"><div class="task-name">{{ __('messages.cardiology_prep') }}</div><div class="task-due">{{ __('messages.today') }} · 9:30 AM</div></div>
        <span class="task-tag tag-appt">{{ __('messages.appointment') }}</span>
      </div>
      <div class="task-item">
        <div class="task-check"></div>
        <div class="task-text"><div class="task-name">{{ __('messages.blood_test_fasting') }}</div><div class="task-due">{{ __('messages.tomorrow') }} · 07:00 AM</div></div>
        <span class="task-tag tag-lab">{{ __('messages.lab') }}</span>
      </div>
      <div class="task-item">
        <div class="task-check"></div>
        <div class="task-text"><div class="task-name">{{ __('messages.renew_prescription') }}</div><div class="task-due">May 15 · Before 5 PM</div></div>
        <span class="task-tag tag-ref">{{ __('messages.refill') }}</span>
      </div>
    </div>

    {{-- Reports --}}
    <div class="pn a a5">
      <div class="ph"><div class="pt">{{ __('messages.recent_reports') }}</div><a href="{{ url('medical_reports') }}" class="pl">{{ __('messages.see_all') }}</a></div>
      <table class="rt">
        <thead>
          <tr>
            <th>{{ __('messages.report') }}</th>
            <th class="r-m">{{ __('messages.date') }}</th>
            <th class="r-m">{{ __('messages.doctor') }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><div class="rn">{{ __('messages.blood_panel') }}</div><div class="rtype">{{ __('messages.lab_result') }}</div></td>
            <td class="r-m" style="color:var(--muted)">May 08, 2025</td>
            <td class="r-m" style="color:var(--muted)">Dr. Mitchell</td>
            <td><a href="#" class="rdl"><i class="fa fa-download"></i> PDF</a></td>
          </tr>
          <tr>
            <td><div class="rn">{{ __('messages.ecg_report') }}</div><div class="rtype">{{ __('messages.cardiology') }}</div></td>
            <td class="r-m" style="color:var(--muted)">Apr 22, 2025</td>
            <td class="r-m" style="color:var(--muted)">Dr. Mitchell</td>
            <td><a href="#" class="rdl"><i class="fa fa-download"></i> PDF</a></td>
          </tr>
          <tr>
            <td><div class="rn">{{ __('messages.mri_brain') }}</div><div class="rtype">{{ __('messages.radiology') }}</div></td>
            <td class="r-m" style="color:var(--muted)">Mar 15, 2025</td>
            <td class="r-m" style="color:var(--muted)">Dr. Reynolds</td>
            <td><a href="#" class="rdl"><i class="fa fa-download"></i> PDF</a></td>
          </tr>
        </tbody>
      </table>
    </div>

    {{-- Timeline --}}
    <div class="pn a a6">
      <div class="ph"><div class="pt">{{ __('messages.upcoming_labs') }}</div><a href="#" class="pl">{{ __('messages.view_all') }}</a></div>
      <div class="timeline">
        <div class="tl-item"><div class="tl-dot bl"></div><div class="tl-title">{{ __('messages.complete_blood_count') }}</div><div class="tl-meta">{{ __('messages.tomorrow') }} · 07:00 AM · City Lab Center</div></div>
        <div class="tl-item"><div class="tl-dot am"></div><div class="tl-title">{{ __('messages.lipid_panel') }}</div><div class="tl-meta">May 18 · 08:30 AM · MediCare Lab</div></div>
        <div class="tl-item"><div class="tl-dot gr"></div><div class="tl-title">{{ __('messages.thyroid_function') }}</div><div class="tl-meta">May 25 · 09:00 AM · City Lab Center</div></div>
        <div class="tl-item"><div class="tl-dot rs"></div><div class="tl-title">{{ __('messages.ecg_followup') }}</div><div class="tl-meta">Jun 02 · 10:30 AM · Cardiac Unit</div></div>
      </div>
    </div>

  </div>{{-- /col-l --}}

  {{-- RIGHT COLUMN --}}
  <div class="col-r">

    {{-- Health Summary --}}
    <div class="pn a a5">
      <div class="ph"><div class="pt">{{ __('messages.health_summary') }}</div><a href="#" class="pl">{{ __('messages.details') }}</a></div>
      <div class="sr-wrap">
        <div style="position:relative;width:136px;height:136px;display:flex;align-items:center;justify-content:center">
          <svg viewBox="0 0 150 150" style="position:absolute;inset:0;width:100%;height:100%">
            <circle cx="75" cy="75" r="60" fill="none" stroke="#edf2fb" stroke-width="10"/>
            <circle cx="75" cy="75" r="60" fill="none" stroke="url(#hg)" stroke-width="10" stroke-linecap="round" stroke-dasharray="377" stroke-dashoffset="30" transform="rotate(-90 75 75)"/>
            <defs><linearGradient id="hg" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#00c9a7"/><stop offset="100%" stop-color="#1a6bff"/></linearGradient></defs>
          </svg>
          <div class="sr-in"><div class="sr-n">92<span style="font-size:.4em">%</span></div><div class="sr-s">{{ __('messages.overall_health') }}</div></div>
        </div>
      </div>
      <div class="vr"><div class="vi" style="background:#e8f1ff;color:var(--blue)"><i class="fa fa-heartbeat"></i></div><div style="flex:1;min-width:0"><div class="vl">{{ __('messages.heart_rate') }}</div><div class="vv">72 bpm</div></div><div class="vbb"><div class="vbf" style="width:72%;background:var(--blue)"></div></div></div>
      <div class="vr"><div class="vi" style="background:#e0faf5;color:var(--teal)"><i class="fa fa-tint"></i></div><div style="flex:1;min-width:0"><div class="vl">{{ __('messages.blood_pressure') }}</div><div class="vv">120/80</div></div><div class="vbb"><div class="vbf" style="width:60%;background:var(--teal)"></div></div></div>
      <div class="vr"><div class="vi" style="background:#fff4dc;color:var(--amber)"><i class="fa fa-thermometer-half"></i></div><div style="flex:1;min-width:0"><div class="vl">{{ __('messages.temperature') }}</div><div class="vv">36.8°C</div></div><div class="vbb"><div class="vbf" style="width:50%;background:var(--amber)"></div></div></div>
      <div class="vr" style="margin-bottom:0"><div class="vi" style="background:#ffe5ea;color:var(--rose)"><i class="fa fa-balance-scale"></i></div><div style="flex:1;min-width:0"><div class="vl">{{ __('messages.bmi') }}</div><div class="vv">22.4</div></div><div class="vbb"><div class="vbf" style="width:55%;background:var(--rose)"></div></div></div>
    </div>

    {{-- Insurance --}}
    <div class="ins-card a a5">
      <div class="ins-chip"></div>
      <div class="ins-num">4523 •••• •••• 7841</div>
      <div class="ins-row">
        <div class="ins-field"><label>{{ __('messages.card_holder') }}</label><span>{{ Auth::user()->name }}</span></div>
        <div class="ins-field" style="text-align:right"><label>{{ __('messages.expires') }}</label><span>12 / 28</span></div>
      </div>
      <div class="ins-badge"><i class="fa fa-shield" style="font-size:10px"></i> {{ __('messages.premium_plan') }}</div>
    </div>

    {{-- Goals --}}
    <div class="pn a a6">
      <div class="ph"><div class="pt">{{ __('messages.health_goals') }}</div><a href="#" class="pl">{{ __('messages.edit') }}</a></div>
      <div class="goal-item"><div class="goal-top"><div class="goal-name">{{ __('messages.daily_steps') }}</div><div class="goal-pct">78%</div></div><div class="goal-bar"><div class="goal-fill" style="width:78%;background:var(--blue)"></div></div><div class="goal-sub">7,842 / 10,000</div></div>
      <div class="goal-item"><div class="goal-top"><div class="goal-name">{{ __('messages.water_intake') }}</div><div class="goal-pct">60%</div></div><div class="goal-bar"><div class="goal-fill" style="width:60%;background:var(--teal)"></div></div><div class="goal-sub">1.5 / 2.5 L</div></div>
      <div class="goal-item"><div class="goal-top"><div class="goal-name">{{ __('messages.weight_goal') }}</div><div class="goal-pct">85%</div></div><div class="goal-bar"><div class="goal-fill" style="width:85%;background:var(--amber)"></div></div><div class="goal-sub">68 kg → 65 kg</div></div>
      <div class="goal-item" style="margin-bottom:0"><div class="goal-top"><div class="goal-name">{{ __('messages.sleep_goal') }}</div><div class="goal-pct">93%</div></div><div class="goal-bar"><div class="goal-fill" style="width:93%;background:var(--rose)"></div></div><div class="goal-sub">7.4 / 8 hrs</div></div>
    </div>

    {{-- Notifications --}}
    <div class="pn a a6">
      <div class="ph"><div class="pt">{{ __('messages.notifications') }} <span class="nd"></span></div><a href="#" class="pl">{{ __('messages.all') }}</a></div>
      <div class="notif-item"><div class="notif-icon" style="background:#e8f1ff;color:var(--blue)"><i class="fa fa-calendar-check-o"></i></div><div class="notif-body"><div class="notif-title n-unread">{{ __('messages.appt_confirmed') }}</div><div class="notif-sub">Dr. Mitchell · Today 10:00 AM</div></div><div class="notif-time">2m</div></div>
      <div class="notif-item"><div class="notif-icon" style="background:#fff4dc;color:var(--amber)"><i class="fa fa-medkit"></i></div><div class="notif-body"><div class="notif-title n-unread">{{ __('messages.refill_reminder') }}</div><div class="notif-sub">Metformin 500mg · 3 days left</div></div><div class="notif-time">1h</div></div>
      <div class="notif-item"><div class="notif-icon" style="background:#e0faf5;color:var(--teal)"><i class="fa fa-file-text-o"></i></div><div class="notif-body"><div class="notif-title">{{ __('messages.report_ready') }}</div><div class="notif-sub">Blood Panel results available</div></div><div class="notif-time">3h</div></div>
      <div class="notif-item"><div class="notif-icon" style="background:#ffe5ea;color:var(--rose)"><i class="fa fa-heartbeat"></i></div><div class="notif-body"><div class="notif-title">{{ __('messages.vitals_alert') }}</div><div class="notif-sub">Blood pressure slightly elevated</div></div><div class="notif-time">Yesterday</div></div>
    </div>

  </div>{{-- /col-r --}}
</div>{{-- /cg --}}

</div>{{-- /dw --}}
@endsection
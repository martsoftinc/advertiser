<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make 7X–20X as an Arbitrage Blogger | Koda.africa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:      #0A0A0F;
            --ink-2:    #1C1C28;
            --surface:  #F7F6F3;
            --muted:    #8A8A99;
            --line:     #E4E3DE;
            --gold:     #C9A84C;
            --gold-light: #F0D080;
            --emerald:  #12B76A;
            --emerald-bg: #EDFAF3;
            --danger:   #E53E3E;
            --danger-bg:#FFF5F5;
            --white:    #FFFFFF;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--surface);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 48px;
            background: rgba(10, 10, 15, 0.82);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .nav-logo {
            font-family: 'DM Serif Display', serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--white);
            letter-spacing: -0.02em;
        }
        .nav-logo span { color: var(--gold); }

        .nav-actions { display: flex; align-items: center; gap: 12px; }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 22px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            color: var(--white);
            border: 1.5px solid rgba(255,255,255,0.2);
            border-radius: 999px;
            background: transparent;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }
        .btn-login:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.4);
        }
        .btn-login svg { width: 14px; height: 14px; opacity: 0.7; }

        .btn-apply-nav {
            display: inline-flex;
            align-items: center;
            padding: 9px 22px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            color: var(--ink);
            background: var(--gold);
            border: none;
            border-radius: 999px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-apply-nav:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            min-height: 100svh;
            background: var(--ink);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 140px 32px 100px;
            position: relative;
            overflow: hidden;
        }

        /* Ambient glows */
        .hero::before {
            content: '';
            position: absolute;
            top: -120px; left: 50%;
            transform: translateX(-50%);
            width: 800px; height: 500px;
            background: radial-gradient(ellipse, rgba(201,168,76,0.18) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -80px; right: -100px;
            width: 500px; height: 400px;
            background: radial-gradient(ellipse, rgba(18,183,106,0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Subtle grid texture */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 0%, black 40%, transparent 100%);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            border: 1px solid rgba(201,168,76,0.3);
            background: rgba(201,168,76,0.08);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 28px;
            position: relative;
            z-index: 1;
        }
        .hero-badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--gold);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .hero h1 {
            font-family: 'DM Serif Display', serif;
            font-weight: 800;
            font-size: clamp(2.6rem, 6vw, 5rem);
            line-height: 1.07;
            letter-spacing: -0.03em;
            color: var(--white);
            max-width: 820px;
            position: relative;
            z-index: 1;
        }

        .hero h1 .highlight {
            display: inline-block;
            position: relative;
        }
        .hero h1 .highlight-text {
            background: linear-gradient(110deg, var(--gold-light) 0%, var(--gold) 40%, var(--emerald) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            margin-top: 24px;
            font-size: 1.1rem;
            color: rgba(255,255,255,0.55);
            max-width: 560px;
            line-height: 1.7;
            font-weight: 400;
            position: relative;
            z-index: 1;
        }
        .hero-sub strong { color: rgba(255,255,255,0.85); font-weight: 500; }

        .hero-ctas {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 40px;
            flex-wrap: wrap;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 15px 32px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            color: var(--ink);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            border: none;
            border-radius: 14px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(201,168,76,0.3);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(201,168,76,0.4);
        }
        .btn-primary svg { width: 16px; height: 16px; }

        .btn-secondary-hero {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 15px 28px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: rgba(255,255,255,0.7);
            background: rgba(255,255,255,0.05);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }
        .btn-secondary-hero:hover {
            background: rgba(255,255,255,0.09);
            border-color: rgba(255,255,255,0.22);
            color: var(--white);
        }

        /* Social proof strip */
        .hero-proof {
            margin-top: 56px;
            display: flex;
            align-items: center;
            gap: 28px;
            flex-wrap: wrap;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .proof-stat { text-align: center; }
        .proof-stat-num {
            font-family: 'DM Serif Display', serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--white);
        }
        .proof-stat-num span { color: var(--gold); }
        .proof-stat-label {
            font-size: 0.7rem;
            color: var(--muted);
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        .proof-divider {
            width: 1px;
            height: 36px;
            background: rgba(255,255,255,0.1);
        }

        /* ── SECTION SHARED ── */
        section { padding: 96px 32px; }
        .section-eyebrow {
            display: inline-block;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 14px;
        }
        .section-title {
            font-family: 'DM Serif Display', serif;
            font-weight: 800;
            font-size: clamp(1.9rem, 4vw, 2.8rem);
            line-height: 1.1;
            letter-spacing: -0.025em;
            color: var(--ink);
            max-width: 700px;
        }
        .section-body {
            margin-top: 14px;
            font-size: 1.05rem;
            color: var(--muted);
            line-height: 1.75;
            max-width: 600px;
        }

        /* ── COMPARISON ── */
        .compare-section { background: var(--white); }
        .compare-inner {
            max-width: 1100px;
            margin: 0 auto;
        }
        .compare-header {
            margin-bottom: 48px;
        }

        .compare-table-wrap {
            overflow: hidden;
            border-radius: 20px;
            border: 1.5px solid var(--line);
            box-shadow: 0 12px 48px rgba(0,0,0,0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--ink);
        }
        thead th {
            padding: 18px 24px;
            font-family: 'DM Serif Display', serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        thead th:first-child { color: rgba(255,255,255,0.4); }
        thead th.th-fb {
            color: rgba(255,255,255,0.6);
            background: #111118;
            border-left: 1px solid rgba(255,255,255,0.06);
        }
        thead th.th-koda {
            color: var(--gold);
            background: #15150E;
            border-left: 1px solid rgba(201,168,76,0.15);
        }

        tbody tr {
            border-top: 1px solid var(--line);
            transition: background 0.15s;
        }
        tbody tr:hover { background: #fafaf8; }
        tbody td {
            padding: 18px 24px;
            font-size: 0.9rem;
        }
        tbody td:first-child {
            font-family: 'DM Serif Display', serif;
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--ink-2);
        }
        .td-fb {
            color: #6B7280;
            background: #fafafa;
            border-left: 1px solid var(--line);
        }
        .td-fb-bad { color: var(--danger); }
        .td-koda {
            background: #FDFCF5;
            border-left: 1.5px solid rgba(201,168,76,0.2);
            font-weight: 600;
            color: #1A6040;
        }

        /* ── FEATURES GRID ── */
        .features-section { background: var(--surface); }
        .features-inner { max-width: 1100px; margin: 0 auto; }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 48px;
        }

        .feat-card {
            background: var(--white);
            border: 1.5px solid var(--line);
            border-radius: 20px;
            padding: 32px 28px;
            transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s;
        }
        .feat-card:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.06);
            transform: translateY(-3px);
            border-color: rgba(201,168,76,0.35);
        }

        .feat-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            background: #F5F0E0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 20px;
        }
        .feat-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 10px;
        }
        .feat-body {
            font-size: 0.875rem;
            color: var(--muted);
            line-height: 1.7;
        }

        /* Pricing card spans 2 cols */
        .feat-card-wide {
            grid-column: span 2;
            background: var(--ink);
            border-color: rgba(201,168,76,0.2);
            color: var(--white);
        }
        .feat-card-wide:hover {
            border-color: rgba(201,168,76,0.5);
        }
        .feat-card-wide .feat-body { color: rgba(255,255,255,0.5); }
        .feat-eyebrow {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold);
            background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.2);
            padding: 3px 10px;
            border-radius: 999px;
            display: inline-block;
            margin-bottom: 14px;
        }
        .feat-card-wide .feat-title { color: var(--white); font-size: 1.3rem; }

        .price-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .price-item-num {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--white);
        }
        .price-item-label {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.4);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ── FORM SECTION ── */
        .apply-section { background: var(--white); }
        .apply-inner {
            max-width: 680px;
            margin: 0 auto;
        }
        .apply-card {
            background: var(--surface);
            border: 1.5px solid var(--line);
            border-radius: 28px;
            padding: 52px 48px;
            margin-top: 48px;
            position: relative;
            overflow: hidden;
        }
        .apply-card::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .lock-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 16px;
            background: #FFF8E8;
            border: 1px solid #EDD88A;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            color: #8A6200;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .lock-badge svg { width: 13px; height: 13px; }

        .apply-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: var(--ink);
        }
        .apply-sub {
            font-size: 0.9rem;
            color: var(--muted);
            line-height: 1.7;
            margin-top: 10px;
        }
        .apply-sub strong { color: var(--ink-2); font-weight: 600; }

        .form-group { margin-top: 22px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 22px; }
        .form-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-2);
            margin-bottom: 8px;
        }
        .form-input, .form-select {
            width: 100%;
            padding: 13px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--ink);
            background: var(--white);
            border: 1.5px solid var(--line);
            border-radius: 12px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            -webkit-appearance: none;
        }
        .form-input::placeholder { color: #B0B0BB; }
        .form-input:focus, .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201,168,76,0.12);
        }
        .form-select { cursor: pointer; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238A8A99' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 40px; }

        .btn-submit {
            width: 100%;
            padding: 15px;
            margin-top: 28px;
            font-family: 'DM Serif Display', serif;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            color: var(--ink);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            border: none;
            border-radius: 14px;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(201,168,76,0.3);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(201,168,76,0.4);
        }

        .form-note {
            margin-top: 14px;
            text-align: center;
            font-size: 0.75rem;
            color: var(--muted);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--ink);
            padding: 36px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid rgba(255,255,255,0.06);
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-logo {
            font-family: 'DM Serif Display', serif;
            font-weight: 800;
            font-size: 1rem;
            color: var(--white);
        }
        .footer-logo span { color: var(--gold); }
        .footer-text { font-size: 0.78rem; color: var(--muted); }

        /* ── MOBILE ── */
        @media (max-width: 768px) {
            nav { padding: 16px 20px; }
            .btn-apply-nav { display: none; }
            .hero { padding: 120px 20px 80px; }
            section { padding: 72px 20px; }
            .form-row { grid-template-columns: 1fr; }
            .apply-card { padding: 32px 24px; }
            .feat-card-wide { grid-column: span 1; }
            .price-grid { grid-template-columns: repeat(2, 1fr); }
            footer { flex-direction: column; text-align: center; padding: 28px 20px; }
            .compare-table-wrap { display: none; }
            .mobile-compare { display: block !important; }
        }

        .mobile-compare {
            display: none;
            margin-top: 32px;
        }
        .mob-compare-card {
            background: var(--white);
            border: 1.5px solid var(--line);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 14px;
        }
        .mob-compare-card-head {
            background: var(--ink-2);
            padding: 12px 18px;
            font-family: 'DM Serif Display', serif;
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--white);
        }
        .mob-compare-row {
            padding: 12px 18px;
            border-top: 1px solid var(--line);
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .mob-compare-row .bad { font-size: 0.82rem; color: var(--danger); }
        .mob-compare-row .good { font-size: 0.82rem; color: var(--emerald); font-weight: 600; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body>

    <!-- ── NAV ── -->
    <nav>
        <div class="nav-logo">koda<span>.</span>africa</div>
        <div class="nav-actions">
            <a href="/login" class="btn-login">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                Log in
            </a>
            <a href="#apply" class="btn-apply-nav">Request Access</a>
        </div>
    </nav>

    <!-- ── HERO ── -->
    <header class="hero">
        <div class="hero-grid"></div>

        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            Invitation Only · Limited Publisher Slots
        </div>

        <h1>
            Turn every dollar of<br>
            ad spend into
            <span class="highlight">
                <span class="highlight-text">&nbsp;7X–20X returns</span>
            </span>
        </h1>

        <p class="hero-sub">
            Stop bleeding money on unpredictable platforms. <strong>Koda.africa</strong> gives arbitrage bloggers 100% human traffic, fixed CPC pricing, and zero ban risk — so your margins actually hold.
        </p>

        <div class="hero-ctas">
            <a href="#apply" class="btn-primary">
                Request Exclusive Access
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
            </a>
            <a href="/login" class="btn-secondary-hero">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:15px;height:15px"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                Publisher Login
            </a>
        </div>

        <div class="hero-proof">
            <div class="proof-stat">
                <div class="proof-stat-num"><span>100%</span></div>
                <div class="proof-stat-label">Human Traffic</div>
            </div>
            <div class="proof-divider"></div>
            <div class="proof-stat">
                <div class="proof-stat-num"><span>1.5–2</span> min</div>
                <div class="proof-stat-label">Avg. Session Time</div>
            </div>
            <div class="proof-divider"></div>
            <div class="proof-stat">
                <div class="proof-stat-num">Fixed <span>CPC</span></div>
                <div class="proof-stat-label">No Bid Surprises</div>
            </div>
            <div class="proof-divider"></div>
            <div class="proof-stat">
                <div class="proof-stat-num"><span>0</span></div>
                <div class="proof-stat-label">Account Bans</div>
            </div>
        </div>
    </header>

    <!-- ── COMPARE ── -->
    <section class="compare-section">
        <div class="compare-inner">
            <div class="compare-header">
                <span class="section-eyebrow">The Honest Comparison</span>
                <h2 class="section-title">Why top bloggers are switching away from Facebook Ads</h2>
                <p class="section-body">The same budget produces wildly different outcomes depending on where it runs. Here's what changes when you move it to Koda.africa.</p>
            </div>

            <div class="compare-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width:28%;color:rgba(255,255,255,0.4);padding:18px 24px;font-family:'DM Serif Display',sans-serif;font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;">Category</th>
                            <th class="th-fb" style="width:36%;">Facebook Ads</th>
                            <th class="th-koda" style="width:36%;">Koda.africa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Traffic Quality</td>
                            <td class="td-fb td-fb-bad">⚠ Up to 60% bot clicks burning budget</td>
                            <td class="td-koda">✓ 100% verified human traffic</td>
                        </tr>
                        <tr>
                            <td>Session Engagement</td>
                            <td class="td-fb td-fb-bad">⚠ High bounce, accidental taps</td>
                            <td class="td-koda">✓ 1.5–2 min avg. time on page</td>
                        </tr>
                        <tr>
                            <td>Account Safety</td>
                            <td class="td-fb td-fb-bad">⚠ Surprise bans with no recourse</td>
                            <td class="td-koda">✓ Zero account closure risk</td>
                        </tr>
                        <tr>
                            <td>Cost Predictability</td>
                            <td class="td-fb td-fb-bad">⚠ Volatile auction-based spikes</td>
                            <td class="td-koda">✓ Fixed CPC — costs known upfront</td>
                        </tr>
                        <tr>
                            <td>Campaign Management</td>
                            <td class="td-fb td-fb-bad">⚠ Constant tweaks, creative fatigue</td>
                            <td class="td-koda">✓ Set and forget — runs itself</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile cards -->
            <div class="mobile-compare">
                <div class="mob-compare-card">
                    <div class="mob-compare-card-head">Traffic Quality</div>
                    <div class="mob-compare-row"><span class="bad">⚠ Facebook: Up to 60% bot clicks</span><span class="good">✓ Koda: 100% human traffic</span></div>
                </div>
                <div class="mob-compare-card">
                    <div class="mob-compare-card-head">Session Engagement</div>
                    <div class="mob-compare-row"><span class="bad">⚠ Facebook: High bounce rates</span><span class="good">✓ Koda: 1.5–2 min avg. session</span></div>
                </div>
                <div class="mob-compare-card">
                    <div class="mob-compare-card-head">Account Safety</div>
                    <div class="mob-compare-row"><span class="bad">⚠ Facebook: Surprise bans</span><span class="good">✓ Koda: Zero closure risk</span></div>
                </div>
                <div class="mob-compare-card">
                    <div class="mob-compare-card-head">Cost Predictability</div>
                    <div class="mob-compare-row"><span class="bad">⚠ Facebook: Volatile auction pricing</span><span class="good">✓ Koda: Fixed CPC, known upfront</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FEATURES ── -->
    <section class="features-section">
        <div class="features-inner">
            <span class="section-eyebrow">Platform Advantages</span>
            <h2 class="section-title">Everything stacked in your favor</h2>

            <div class="features-grid">
                <div class="feat-card">
                    <div class="feat-icon">🚫</div>
                    <div class="feat-title">Bot-Free Traffic</div>
                    <p class="feat-body">While Facebook floods your site with up to 60% bot clicks, every Koda.africa visit comes from a real, engaged human reader.</p>
                </div>
                <div class="feat-card">
                    <div class="feat-icon">⏱</div>
                    <div class="feat-title">Unmatched Engagement</div>
                    <p class="feat-body">Users spend 1.5–2 minutes actively reading your articles — massively boosting ad impressions per visit compared to social traffic.</p>
                </div>
                <div class="feat-card">
                    <div class="feat-icon">🔒</div>
                    <div class="feat-title">Zero Ban Risk</div>
                    <p class="feat-body">Stop waking up to blocked ad managers. Scale your arbitrage business safely, with complete peace of mind and no platform anxiety.</p>
                </div>
                <div class="feat-card">
                    <div class="feat-icon">⚡</div>
                    <div class="feat-title">Set & Forget</div>
                    <p class="feat-body">No more exhausting creative rotations or pixel tweaks. Launch once and let Koda.africa deliver consistent, automated ROI.</p>
                </div>
                <div class="feat-card feat-card-wide">
                    <div class="feat-eyebrow">Fixed CPC Pricing</div>
                    <div class="feat-title">Know your costs before you spend a cent</div>
                    <p class="feat-body">No auction volatility. No surprise spikes at month-end. Fixed CPC across our core African markets means your arbitrage margins hold.</p>
                    <div class="price-grid">
                        <div>
                            <div class="price-item-num">$0.04</div>
                            <div class="price-item-label">🇳🇬 Nigeria</div>
                        </div>
                        <div>
                            <div class="price-item-num">$0.05</div>
                            <div class="price-item-label">🇿🇦 South Africa</div>
                        </div>
                        <div>
                            <div class="price-item-num">$0.03</div>
                            <div class="price-item-label">🇰🇪 Kenya</div>
                        </div>
                        <div>
                            <div class="price-item-num">$0.02</div>
                            <div class="price-item-label">🇬🇭 Ghana</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── APPLY ── -->
    <section id="apply" class="apply-section" style="scroll-margin-top:80px;">
        <div class="apply-inner">
            <div style="text-align:center;">
                <span class="section-eyebrow">Exclusive Access</span>
                <h2 class="section-title" style="margin:0 auto;">Request your publisher invitation</h2>
                <p class="section-body" style="margin:14px auto 0;">To protect traffic purity and margin quality, Koda.africa is strictly invite-only. Our team reviews each application individually and responds within 2 business days.</p>
            </div>

            <div class="apply-card" style="text-align:center;">
                <div class="lock-badge" style="margin:0 auto 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                    Invite-Only Platform
                </div>

                <div class="apply-title" style="margin-bottom:12px;">Ready to scale your arbitrage business?</div>
                <p class="apply-sub" style="max-width:440px;margin:0 auto 36px;">Complete our brief publisher application. Takes under 3 minutes. Our team will review your profile and reach back out with next steps.</p>

                <div style="display:flex;flex-direction:column;align-items:center;gap:14px;">
                    <a href="https://forms.gle/ASvvYTtX1rtC6Ym5A" target="_blank" rel="noopener noreferrer" class="btn-submit" style="display:inline-flex;align-items:center;justify-content:center;gap:10px;width:auto;padding:16px 44px;text-decoration:none;margin-top:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:18px;height:18px;flex-shrink:0"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" /></svg>
                        Begin Application
                    </a>
                    <span style="font-size:0.78rem;color:var(--muted);">Opens in a new tab &nbsp;·&nbsp; Takes ~3 minutes</span>
                </div>

                <div style="margin-top:36px;padding-top:28px;border-top:1.5px solid var(--line);display:flex;align-items:center;justify-content:center;gap:8px;">
                    <span style="font-size:0.82rem;color:var(--muted);">Already have a publisher account?</span>
                    <a href="#" style="font-size:0.82rem;color:var(--gold);font-weight:600;text-decoration:none;">Log in here →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="footer-logo">koda<span>.</span>africa</div>
        <div class="footer-text">© 2026 Koda.africa — Built for content arbitrage publishers.</div>
    </footer>

</body>
</html>
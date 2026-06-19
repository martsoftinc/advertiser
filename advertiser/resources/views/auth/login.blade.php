<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Log In — Koda.africa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:       #0A0A0F;
            --ink-2:     #1C1C28;
            --surface:   #F7F6F3;
            --muted:     #8A8A99;
            --line:      #E4E3DE;
            --gold:      #C9A84C;
            --gold-lt:   #F0D080;
            --white:     #FFFFFF;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            line-height: 1.6;
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
        }

        /* ── SPLIT LAYOUT ── */
        .page {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* ── LEFT PANEL ── */
        .panel-left {
            background: var(--ink);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 56px;
            position: relative;
            overflow: hidden;
        }

        /* ambient glow */
        .panel-left::before {
            content: '';
            position: absolute;
            top: -100px; left: -80px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(201,168,76,0.14) 0%, transparent 65%);
            pointer-events: none;
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -60px; right: -80px;
            width: 380px; height: 380px;
            background: radial-gradient(circle, rgba(18,183,106,0.08) 0%, transparent 65%);
            pointer-events: none;
        }

        /* subtle dot-grid texture */
        .panel-left-grid {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
            mask-image: radial-gradient(ellipse 70% 70% at 30% 50%, black 30%, transparent 100%);
        }

        .left-logo {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            color: var(--white);
            letter-spacing: -0.01em;
            position: relative;
            z-index: 1;
        }
        .left-logo span { color: var(--gold); }

        .left-body {
            position: relative;
            z-index: 1;
        }

        .left-eyebrow {
            display: inline-block;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: var(--gold);
            border: 1px solid rgba(201,168,76,0.25);
            background: rgba(201,168,76,0.08);
            padding: 4px 12px;
            border-radius: 999px;
            margin-bottom: 20px;
        }

        .left-headline {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            line-height: 1.1;
            color: var(--white);
            letter-spacing: -0.02em;
            max-width: 360px;
        }
        .left-headline em {
            font-style: italic;
            background: linear-gradient(110deg, var(--gold-lt), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .left-sub {
            margin-top: 16px;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.45);
            line-height: 1.7;
            max-width: 320px;
        }

        .left-stats {
            display: flex;
            gap: 28px;
            margin-top: 40px;
        }
        .stat-item-num {
            font-family: 'DM Serif Display', serif;
            font-size: 1.6rem;
            color: var(--white);
        }
        .stat-item-num span { color: var(--gold); }
        .stat-item-label {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            margin-top: 2px;
        }
        .stat-divider {
            width: 1px;
            background: rgba(255,255,255,0.08);
            align-self: stretch;
        }

        .left-footer {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.2);
            position: relative;
            z-index: 1;
        }

        /* ── RIGHT PANEL ── */
        .panel-right {
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
        }

        .card-header-text {
            margin-bottom: 36px;
        }
        .card-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.9rem;
            font-weight: 400;
            color: var(--ink);
            letter-spacing: -0.02em;
            line-height: 1.15;
        }
        .card-sub {
            font-size: 0.85rem;
            color: var(--muted);
            margin-top: 6px;
        }

        /* ── ALERTS ── */
        .alert {
            padding: 11px 16px;
            border-radius: 10px;
            font-size: 0.83rem;
            font-weight: 500;
            margin-bottom: 20px;
            border: 1.5px solid;
        }
        .alert-success {
            background: #EDFAF3;
            border-color: #A3E6C5;
            color: #1A6040;
        }
        .alert-danger {
            background: #FFF5F5;
            border-color: #FCCACA;
            color: #9B1C1C;
        }

        /* ── FORM ── */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-2);
            margin-bottom: 8px;
        }
        .form-label .req { color: #E53E3E; margin-left: 2px; }

        .input-wrap {
            display: flex;
            align-items: stretch;
            border: 1.5px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
            background: var(--white);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-wrap:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201,168,76,0.12);
        }

        .input-icon {
            display: flex;
            align-items: center;
            padding: 0 14px;
            color: var(--muted);
            background: transparent;
            border-right: 1.5px solid var(--line);
            flex-shrink: 0;
        }

        .form-control {
            flex: 1;
            padding: 13px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--ink);
            background: transparent;
            border: none;
            outline: none;
        }
        .form-control::placeholder { color: #C0BFBA; }

        .btn-toggle-pw {
            display: flex;
            align-items: center;
            padding: 0 14px;
            background: transparent;
            border: none;
            border-left: 1.5px solid var(--line);
            cursor: pointer;
            color: var(--muted);
            transition: color 0.15s;
            flex-shrink: 0;
        }
        .btn-toggle-pw:hover { color: var(--ink); }

        .btn-login {
            width: 100%;
            padding: 14px;
            margin-top: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            color: var(--ink);
            background: linear-gradient(135deg, var(--gold-lt), var(--gold));
            border: none;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(201,168,76,0.28);
            transition: transform 0.18s, box-shadow 0.18s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(201,168,76,0.38);
        }
        .btn-login:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 28px 0;
            color: var(--line);
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .card-links {
            display: flex;
            justify-content: center;
            gap: 32px;
            flex-wrap: wrap;
        }
        .card-link {
            font-size: 0.85rem;
            color: var(--muted);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s;
        }
        .card-link:hover { color: var(--gold); }
        .card-link-primary {
            color: var(--gold);
            font-weight: 600;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 767px) {
            .page { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 40px 24px; align-items: flex-start; padding-top: 60px; }
            .login-card { max-width: 100%; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body>

<div class="page">

    <!-- ── LEFT PANEL ── -->
    <div class="panel-left">
        <div class="panel-left-grid"></div>

        <div class="left-logo">koda<span>.</span>africa</div>

        <div class="left-body">
            <span class="left-eyebrow">Arbitrage Publishers</span>
            <h1 class="left-headline">Your traffic.<br><em>Your margins.</em><br>Protected.</h1>
            <p class="left-sub">Koda.africa delivers 100% human traffic at fixed CPC pricing — so your arbitrage returns are predictable, not a gamble.</p>

            <div class="left-stats">
                <div>
                    <div class="stat-item-num"><span>7–20</span>×</div>
                    <div class="stat-item-label">Avg. ROI</div>
                </div>
                <div class="stat-divider"></div>
                <div>
                    <div class="stat-item-num"><span>0</span></div>
                    <div class="stat-item-label">Account bans</div>
                </div>
                <div class="stat-divider"></div>
                <div>
                    <div class="stat-item-num"><span>$0.02</span></div>
                    <div class="stat-item-label">From / click</div>
                </div>
            </div>
        </div>

        <div class="left-footer">© 2026 Koda.africa · Invite-only platform</div>
    </div>

    <!-- ── RIGHT PANEL ── -->
    <div class="panel-right">
        <div class="login-card">

            <div class="card-header-text">
                <h2 class="card-title">Welcome back</h2>
                <p class="card-sub">Log in to your publisher dashboard.</p>
            </div>

            <!-- Alerts (Laravel Blade — kept as-is) -->
             @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif
            @if (session()->has('loginError'))
            <div class="alert alert-danger">{{ session()->get('loginError') }}</div>
            @endif 

            <form action="{{route('userlogin')}}" method="post">
                 @csrf 

                <div class="form-group">
                    <label for="email" class="form-label">Email <span class="req">*</span></label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                            </svg>
                        </span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="you@yourdomain.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password <span class="req">*</span></label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="••••••••" required>
                        <button class="btn-toggle-pw" type="button" id="togglePassword" aria-label="Show password">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 13c-2.5 0-4.5-2-4.5-5S5.5 3 8 3s4.5 2 4.5 5-2 5-4.5 5z"/>
                                <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button class="btn-login" type="submit">Log In</button>
            </form>

            <div class="divider">or</div>

            <div class="card-links">
               <!-- <a href="/signup-publisher" class="card-link card-link-primary">Create an account</a>-->
                <a href="/resetpassword" class="card-link">Forgot password?</a>
            </div>

        </div>
    </div>

</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput  = document.getElementById('password');
    const eyeIcon        = document.getElementById('eyeIcon');

    const eyeOpen = `<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 13c-2.5 0-4.5-2-4.5-5S5.5 3 8 3s4.5 2 4.5 5-2 5-4.5 5z"/><path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>`;
    const eyeSlash = `<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.708zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>`;

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        eyeIcon.innerHTML = isPassword ? eyeSlash : eyeOpen;
        this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
    });
</script>

</body>
</html>
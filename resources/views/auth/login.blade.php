<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BDF</title>
    <link rel="icon" href="/BDF.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

        :root {
            --g1: #064e3b;
            --g2: #065f46;
            --g3: #047857;
            --g4: #059669;
            --g5: #10b981;
            --g6: #34d399;
            --g7: #6ee7b7;
            --accent: #a7f3d0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden;

            /* Base deep green */
            background-color: var(--g2);
        }

        /* === 4-CORNER GRADIENT MESH === */

        /* Full background canvas */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                /* TOP-LEFT: Teal-lime burst */
                radial-gradient(ellipse 70% 60% at 0% 0%, #34d399cc 0%, transparent 65%),
                /* TOP-RIGHT: Deep emerald cool */
                radial-gradient(ellipse 65% 55% at 100% 0%, #047857cc 0%, transparent 60%),
                /* BOTTOM-LEFT: Dark forest */
                radial-gradient(ellipse 60% 65% at 0% 100%, #064e3bdd 0%, transparent 60%),
                /* BOTTOM-RIGHT: Mid-green glow */
                radial-gradient(ellipse 70% 60% at 100% 100%, #10b981bb 0%, transparent 60%),
                /* CENTER: Anchor tone */
                radial-gradient(ellipse 50% 50% at 50% 50%, #059669 0%, #065f46 100%);
            z-index: 0;
            animation: meshShift 12s ease-in-out infinite alternate;
        }

        /* Floating orb layer for depth */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle 380px at 20% 80%, rgba(16, 185, 129, 0.22) 0%, transparent 70%),
                radial-gradient(circle 320px at 80% 20%, rgba(110, 231, 183, 0.18) 0%, transparent 70%),
                radial-gradient(circle 280px at 50% 50%, rgba(4, 120, 87, 0.15) 0%, transparent 70%);
            z-index: 0;
            animation: orbDrift 16s ease-in-out infinite alternate-reverse;
        }

        /* Subtle noise grain for texture */
        .grain-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            opacity: 0.035;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-size: 200px 200px;
            pointer-events: none;
        }

        /* Diagonal shimmer lines */
        .shimmer-lines {
            position: fixed;
            inset: 0;
            z-index: 1;
            background-image: repeating-linear-gradient(135deg,
                    transparent,
                    transparent 60px,
                    rgba(255, 255, 255, 0.018) 60px,
                    rgba(255, 255, 255, 0.018) 61px);
            pointer-events: none;
        }

        @keyframes meshShift {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.92;
                transform: scale(1.015);
            }

            100% {
                opacity: 1;
                transform: scale(1.03) rotate(0.5deg);
            }
        }

        @keyframes orbDrift {
            0% {
                transform: translate(0px, 0px);
            }

            33% {
                transform: translate(30px, -20px);
            }

            66% {
                transform: translate(-20px, 25px);
            }

            100% {
                transform: translate(15px, -10px);
            }
        }

        /* === CARD === */
        .login-card {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.97);
            border-radius: 1.25rem;
            padding: 2.5rem 2.25rem 2rem;
            max-width: 440px;
            width: 100%;
            box-shadow:
                0 0 0 1px rgba(16, 185, 129, 0.12),
                0 8px 24px rgba(6, 78, 59, 0.18),
                0 32px 64px rgba(6, 78, 59, 0.22);
            text-align: center;
            animation: cardIn 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            transform: translateY(28px);
            opacity: 0;
        }

        @keyframes cardIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Glowing border ring */
        .login-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 1.4rem;
            background: linear-gradient(135deg, var(--g5), var(--g7), var(--g3), var(--g5));
            z-index: -1;
            opacity: 0.5;
            animation: ringPulse 4s ease-in-out infinite;
        }

        @keyframes ringPulse {

            0%,
            100% {
                opacity: 0.4;
            }

            50% {
                opacity: 0.8;
            }
        }

        .login-card img {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 4px 10px rgba(16, 185, 129, 0.3));
        }

        .login-card h2 {
            margin-bottom: 0.35rem;
            font-weight: 700;
            color: #000000;
            font-size: clamp(1.1rem, 4vw, 1.35rem);
            letter-spacing: -0.01em;
        }

        .login-card .subtitle {
            font-size: 0.8rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 1.75rem;
            color: #ffffff;
            background: #10b981;
            display: inline-block;
            padding: 2px 12px;
            border-radius: 20px;
        }

        /* Divider */
        .login-card hr {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, #d1fae5, transparent);
            margin-bottom: 1.75rem;
        }

        /* === INPUTS === */
        .input-wrap {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-wrap .input-icon-left {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #6ee7b7;
            font-size: 0.85rem;
            pointer-events: none;
            transition: color 0.2s;
            z-index: 2;
        }

        .form-control {
            height: 48px;
            border-radius: 0.65rem;
            border: 1.5px solid #d1fae5;
            padding-left: 2.5rem;
            /* ✅ FIX: right padding reserves space for the eye button inside the input */
            padding-right: 2.75rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            color: #000000;
            background: #f0fdf4;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-control::placeholder {
            color: #888888;
        }

        .form-control:focus {
            border-color: #10b981;
            background: #fff;
            box-shadow: 0 0 0 3.5px rgba(16, 185, 129, 0.15);
            outline: none;
        }

        .is-invalid-field {
            border-color: #fca5a5 !important;
            background: #fff7f7 !important;
        }

        .input-wrap:focus-within .input-icon-left {
            color: #10b981;
        }

        /* === TOGGLE PASSWORD BUTTON — sits INSIDE the input on the right === */
        .input-wrap #togglePassword {
            position: absolute;
            right: 1px;
            /* flush to inner-right edge of input */
            top: 1px;
            /* flush to inner-top edge */
            bottom: 1px;
            /* flush to inner-bottom edge */
            width: 42px;
            background: transparent;
            border: none;
            border-radius: 0 0.6rem 0.6rem 0;
            /* match input's right corners */
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #194e35;
            font-size: 0.85rem;
            transition: color 0.2s, 
            background 0.1s;
            z-index: 2;
        }

        .input-wrap #togglePassword:hover {
            color: #10b981;
            background: rgba(16, 185, 129, 0.07);
        }

        /* === BUTTON === */
        .btn-login {
            background: linear-gradient(90deg, #266d55 0%, #044a33 50%, #266d55 100%);
            color: #ffffff;
            border: none;
            width: 100%;
            height: 48px;
            border-radius: 0.65rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.03em;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #34d399, #10b981);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-login span {
            position: relative;
            z-index: 1;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.5);
        }

        .btn-login:hover::after {
            opacity: 1;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* === ALERTS === */
        .alert-error {
            background: #fff1f2;
            border: 1.5px solid #fca5a5;
            border-radius: 0.65rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-align: left;
        }

        .alert-error i {
            color: #ef4444;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .alert-error span {
            color: #b91c1c;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
            border-radius: 0.65rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-align: left;
        }

        .alert-success i {
            color: #16a34a;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .alert-success span {
            color: #15803d;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* === MOBILE === */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem 1.75rem;
                border-radius: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Texture layers -->
    <div class="grain-overlay"></div>
    <div class="shimmer-lines"></div>

    <div class="login-card">
        <!-- Logo -->
        <img src="/BDF.png" alt="BDF Logo">

        <!-- Name -->
        <h2>Bangladesh Debate Federation</h2>
        <p class="subtitle">Admin Portal</p>
        <hr>

        {{-- Success Message (e.g. after logout) --}}
        @if (session('success'))
            <div class="alert-success">
                <i class="fa fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Error Message (wrong email/password) --}}
        @if ($errors->any())
            <div class="alert-error">
                <i class="fa fa-circle-exclamation"></i>
                <span>{{ $errors->first('email') }}</span>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email field -->
            <div class="input-wrap">
                <input type="email" name="email"
                    class="form-control {{ $errors->has('email') ? 'is-invalid-field' : '' }}"
                    placeholder="Email address" value="{{ old('email') }}" required autofocus>
                <i class="fa fa-envelope input-icon-left"></i>
            </div>

            <!-- Password field — eye button sits INSIDE the input -->
            <div class="input-wrap">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                    required>
                <i class="fa fa-lock input-icon-left"></i>
                <button type="button" id="togglePassword" onclick="togglePass()" title="Show/hide password">
                    <i class="fa fa-eye" id="eyeIcon"></i>
                </button>
            </div>

            <button type="submit" class="btn btn-login">
                <span>Sign In</span>
            </button>
        </form>
    </div>

    <script>
        function togglePass() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>

</html>
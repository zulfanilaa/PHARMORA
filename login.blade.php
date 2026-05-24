<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PHARMORA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #d1e6ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        /* ── Background bergerak gradient ── */
        @keyframes bgShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            background: linear-gradient(135deg, #c2dcff, #daeeff, #b8d4ff, #e0eeff);
            background-size: 300% 300%;
            animation: bgShift 8s ease infinite;
        }

        /* ── Card muncul ── */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-wrapper {
            background: #2b74e2;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            width: 100%;
            max-width: 850px;
            height: 450px;
            position: relative;
            animation: fadeSlideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        /* ── Ilustrasi kanan: shimmer + floating ── */
        @keyframes floatIllust {
            0%, 100% { transform: translateY(0px);   }
            50%       { transform: translateY(-7px); }
        }

        @keyframes shimmerOverlay {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        .bg-image-container {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('img/gambar_login.png') }}");
            background-size: 62% auto;
            background-repeat: no-repeat;
            background-position: right 15px center;
            z-index: 1;

            /* Floating ilustrasi */
            animation: floatIllust 4s ease-in-out infinite;
        }

        /* Shimmer sweep di atas ilustrasi */
        .bg-image-container::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                105deg,
                transparent 40%,
                rgba(255, 255, 255, 0.12) 50%,
                transparent 60%
            );
            background-size: 200% 100%;
            animation: shimmerOverlay 3.5s ease-in-out infinite;
            pointer-events: none;
        }

        .form-section {
            position: relative;
            z-index: 2;
            background: white;
            height: 100%;
            width: 48%;
            clip-path: path('M 0 0 L 330 0 C 380 60, 270 130, 340 210 C 400 280, 280 360, 360 450 L 0 450 Z');
            border-radius: 16px 0 0 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 1.5rem 2.5rem;
            gap: 0;
        }

        /* ── Logo: floating pelan + shimmer kilap ── */
        @keyframes floatLogo {
            0%, 100% { transform: translateY(0px);   }
            50%       { transform: translateY(-4px); }
        }

        @keyframes logoShimmer {
            0%   { filter: drop-shadow(0 0 0px rgba(29, 97, 228, 0)); }
            50%  { filter: drop-shadow(0 0 8px rgba(29, 97, 228, 0.45)); }
            100% { filter: drop-shadow(0 0 0px rgba(29, 97, 228, 0)); }
        }

        .logo-area {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .logo-area img {
            width: 75px;
            height: auto;
            flex-shrink: 0;
            animation: floatLogo 3.5s ease-in-out infinite,
                       logoShimmer 3.5s ease-in-out infinite;
        }

        .logo-area .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-area .logo-name {
            font-size: 1rem;
            font-weight: 800;
            color: #0c3992;
            line-height: 1.1;
            letter-spacing: 0.5px;
        }

        .logo-area .logo-sub {
            font-size: 0.6rem;
            color: #6c757d;
            font-weight: 500;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .logo-divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 0 0 0.9rem 0;
        }

        .form-container-box {
            width: 100%;
            max-width: 270px;
        }

        .form-title {
            color: #0c3992;
            font-size: 1.5rem;
            margin-bottom: 2px;
            line-height: 1.2;
        }

        .form-subtitle {
            font-size: 0.78rem;
            color: #6c757d;
            margin-bottom: 0.9rem;
        }

        .form-label-custom {
            font-size: 0.68rem;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 4px;
            display: block;
        }

        .form-control, .input-group-text {
            border-radius: 10px;
            padding: 7px 12px;
            background-color: #f8fafc !important;
            border-color: #e2e8f0;
            font-size: 0.85rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
            border-color: #007bff;
        }

        .input-group-text {
            color: #94a3b8;
        }

        /* ── Tombol Login: shimmer sweep ── */
        @keyframes btnShimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        .btn-login {
            background-color: #1d61e4;
            border: none;
            border-radius: 10px;
            padding: 8px;
            font-weight: bold;
            font-size: 0.88rem;
            width: 100%;
            color: white;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        /* Shimmer layer di atas tombol */
        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                105deg,
                transparent 35%,
                rgba(255, 255, 255, 0.25) 50%,
                transparent 65%
            );
            background-size: 200% 100%;
            animation: btnShimmer 2.2s ease-in-out infinite;
            border-radius: inherit;
            pointer-events: none;
        }

        .btn-login:hover {
            background-color: #1550c0;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(29, 97, 228, 0.35);
        }

        .btn-login:active {
            transform: translateY(0px);
            box-shadow: none;
        }

        .btn-login.loading {
            pointer-events: none;
            background-color: #1550c0;
        }

        /* ── Spinner ── */
        .spinner {
            display: none;
            width: 15px;
            height: 15px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ── Overlay sukses ── */
        .success-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .success-overlay.show {
            opacity: 1;
            pointer-events: all;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .success-box {
            background: white;
            border-radius: 16px;
            padding: 2rem 2.5rem;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            transform: scale(0.85);
            opacity: 0;
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s;
        }

        .success-overlay.show .success-box {
            transform: scale(1);
            opacity: 1;
        }

        .checkmark-circle {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #e8f5e9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.8rem;
            animation: popIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) 0.15s both;
        }

        @keyframes popIn {
            from { transform: scale(0); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }

        .checkmark-circle i {
            font-size: 1.8rem;
            color: #2e7d32;
        }

        .success-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0c3992;
            margin-bottom: 4px;
        }

        .success-sub {
            font-size: 0.75rem;
            color: #6c757d;
        }

        /* ── Shake error ── */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%       { transform: translateX(-6px); }
            40%       { transform: translateX(6px); }
            60%       { transform: translateX(-4px); }
            80%       { transform: translateX(4px); }
        }

        .shake {
            animation: shake 0.4s ease both;
        }

        .footer-area {
            margin-top: 1rem;
        }

        .footer-area p {
            font-size: 0.62rem;
            color: #adb5bd;
            margin: 0;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                height: auto;
                min-height: 400px;
            }
            .form-section {
                width: 100%;
                clip-path: none;
                border-radius: 20px;
                padding: 2rem 1.5rem;
            }
            .bg-image-container {
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- Overlay sukses -->
<div class="success-overlay" id="successOverlay">
    <div class="success-box">
        <div class="checkmark-circle">
            <i class="bi bi-check-lg"></i>
        </div>
        <p class="success-title">Login Berhasil!</p>
        <p class="success-sub">Mengalihkan ke dashboard...</p>
    </div>
</div>

<div class="login-wrapper">
    
    <div class="bg-image-container"></div>
        
    <div class="form-section">

        <div class="logo-area">
            <img src="{{ asset('img/logo-pharmora.png') }}" alt="Logo Pharmora">
            <div class="logo-text">
                <span class="logo-name">PHARMORA</span>
                <span class="logo-sub">Sistem Informasi Farmasi RS</span>
            </div>
        </div>

        <hr class="logo-divider">

        <div class="form-container-box">
            <h3 class="form-title fw-bold">Selamat Datang</h3>
            <p class="form-subtitle">Login untuk mengakses sistem</p>

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <div class="mb-2">
                    <label class="form-label-custom">Username</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" class="form-control border-start-0" placeholder="Masukkan username" required autocomplete="off">
                    </div>
                </div>

                <div class="mb-1">
                    <label class="form-label-custom">Password</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control border-start-0" placeholder="Masukkan password" id="passwordInput" required>
                        <span class="input-group-text bg-light border-start-0" style="cursor: pointer;" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="btnLogin">
                    <span class="spinner" id="btnSpinner"></span>
                    <i class="bi bi-box-arrow-in-right" id="btnIcon"></i>
                    <span id="btnText">Masuk</span>
                </button>
            </form>
        </div>

        <div class="footer-area">
            <p>&copy; 2026 PHARMORA &middot; Sistem Informasi Farmasi RS</p>
        </div>

    </div>
</div>

@if(session('success') || (isset($loginSuccess) && $loginSuccess))
<script>
    window.addEventListener('DOMContentLoaded', () => showSuccess());
</script>
@endif

@if($errors->any())
<script>
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('loginForm').classList.add('shake');
    });
</script>
@endif

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    function showSuccess() {
        const overlay = document.getElementById('successOverlay');
        overlay.classList.add('show');
    }

    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn     = document.getElementById('btnLogin');
        const spinner = document.getElementById('btnSpinner');
        const icon    = document.getElementById('btnIcon');
        const text    = document.getElementById('btnText');

        btn.classList.add('loading');
        spinner.style.display = 'block';
        icon.style.display    = 'none';
        text.textContent      = 'Memproses...';
    });
</script>

</body>
</html>

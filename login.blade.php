<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PHARMORA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0; padding: 0;
            width: 100%; height: 100%;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @keyframes bgShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            background: linear-gradient(135deg, #c2dcff, #daeeff, #b8d4ff, #e0eeff);
            background-size: 300% 300%;
            animation: bgShift 8s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes cardEntrance {
            0%   { opacity: 0; transform: scale(0.82) translateY(30px); }
            60%  { opacity: 1; transform: scale(1.02) translateY(-4px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        @keyframes slideFromLeft {
            0%   { opacity: 0; transform: translateX(-60px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideFromRight {
            0%   { opacity: 0; transform: translateX(60px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes dropIn {
            0%   { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes riseUp {
            0%   { opacity: 0; transform: translateY(18px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            0%   { opacity: 0; }
            100% { opacity: 1; }
        }
        @keyframes floatIllust {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-7px); }
        }
        @keyframes floatLogo {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-4px); }
        }
        @keyframes logoShimmer {
            0%   { filter: drop-shadow(0 0 0px rgba(29,97,228,0)); }
            50%  { filter: drop-shadow(0 0 8px rgba(29,97,228,0.45)); }
            100% { filter: drop-shadow(0 0 0px rgba(29,97,228,0)); }
        }
        @keyframes btnShimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes bgShimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%       { transform: translateX(-6px); }
            40%       { transform: translateX(6px); }
            60%       { transform: translateX(-4px); }
            80%       { transform: translateX(4px); }
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        @keyframes popIn {
            from { transform: scale(0); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }
        @keyframes slideDown {
            0%   { opacity: 0; transform: translateY(-12px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .login-wrapper {
            background: #2b74e2;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
            overflow: hidden;
            width: 880px;
            height: 470px;
            position: relative;
            animation: cardEntrance 0.7s cubic-bezier(0.22,1,0.36,1) both;
        }

        .bg-image-container {
            position: absolute;
            top: 0; right: 0;
            width: 100%; height: 100%;
            z-index: 1;
            animation:
                slideFromRight 0.65s cubic-bezier(0.22,1,0.36,1) 0.35s both,
                floatIllust    4s   ease-in-out                   1.2s  infinite;
        }
        .bg-image-container::before {
            content: '';
            position: absolute;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-image: url("{{ asset('img/gambar_login.png') }}");
            background-size: 56% auto;
            background-repeat: no-repeat;
            background-position: right 20px center;
            clip-path: path('M 440 0 L 880 0 L 880 470 L 360 470 C 430 360, 310 285, 380 210 C 440 140, 330 65, 440 0 Z');
        }
        .bg-image-container::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,0.1) 50%, transparent 60%);
            background-size: 200% 100%;
            animation: bgShimmer 3.5s ease-in-out 1.2s infinite;
            pointer-events: none;
        }

        .form-section {
            position: relative; z-index: 2;
            background: white;
            height: 100%; width: 50%;
            clip-path: path('M 0 0 L 340 0 C 390 65, 275 140, 345 210 C 410 285, 295 360, 370 470 L 0 470 Z');
            border-radius: 16px 0 0 16px;
            display: flex; flex-direction: column;
            justify-content: center;
            padding: 1.5rem 2.8rem;
            animation: slideFromLeft 0.65s cubic-bezier(0.22,1,0.36,1) 0.2s both;
        }

        .logo-area {
            display: flex; flex-direction: row;
            align-items: center; gap: 10px;
            margin-bottom: 1rem;
            animation: dropIn 0.5s cubic-bezier(0.22,1,0.36,1) 0.55s both;
        }
        .logo-area img {
            width: 75px; height: auto; flex-shrink: 0;
            animation: floatLogo 3.5s ease-in-out 1.2s infinite,
                       logoShimmer 3.5s ease-in-out 1.2s infinite;
        }
        .logo-area .logo-text { display: flex; flex-direction: column; }
        .logo-area .logo-name {
            font-size: 1rem; font-weight: 800;
            color: #1954c9; line-height: 1.1; letter-spacing: 0.5px;
        }
        .logo-area .logo-sub {
            font-size: 0.6rem; color: #6c757d; font-weight: 500;
            letter-spacing: 0.4px; text-transform: uppercase;
        }

        .logo-divider {
            border: none; border-top: 1px solid #e2e8f0;
            margin: 0 0 0.9rem 0;
            animation: fadeIn 0.4s ease 0.7s both;
        }

        .form-container-box { width: 100%; max-width: 280px; }

        .form-title {
            color: #0c3992; font-size: 1.5rem;
            margin-bottom: 2px; line-height: 1.2;
            animation: fadeIn 0.45s ease 0.7s both;
        }
        .form-subtitle {
            font-size: 0.78rem; color: #6c757d; margin-bottom: 0.9rem;
            animation: fadeIn 0.45s ease 0.78s both;
        }

        .form-label-custom {
            font-size: 0.68rem; font-weight: 700; color: #94a3b8;
            letter-spacing: 0.6px; text-transform: uppercase;
            margin-bottom: 4px; display: block;
        }

        .field-username { animation: riseUp 0.45s cubic-bezier(0.22,1,0.36,1) 0.85s both; }
        .field-password { animation: riseUp 0.45s cubic-bezier(0.22,1,0.36,1) 0.95s both; }

        .form-control, .input-group-text {
            border-radius: 10px; padding: 7px 12px;
            background-color: #f8fafc !important;
            border-color: #e2e8f0; font-size: 0.85rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(0,123,255,0.15);
            border-color: #007bff;
        }
        .form-control.is-invalid-custom {
            border-color: #e53e3e !important;
            background-color: #fff5f5 !important;
        }
        .input-group-text { color: #94a3b8; }

        .password-hint {
            font-size: 0.63rem;
            color: #94a3b8;
            margin-top: 3px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2px;
        }
        .password-hint .char-count {
            font-weight: 700;
            transition: color 0.2s;
        }
        .password-hint .char-count.valid   { color: #2e7d32; }
        .password-hint .char-count.invalid { color: #e53e3e; }

        .alert-error {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff0f0;
            border: 1.5px solid #feb2b2;
            border-left: 4px solid #e53e3e;
            border-radius: 10px;
            padding: 8px 12px;
            margin-bottom: 10px;
            font-size: 0.78rem;
            color: #c53030;
            font-weight: 600;
            animation: slideDown 0.35s cubic-bezier(0.22,1,0.36,1) both,
                       shake       0.4s  ease                        0.1s both;
        }
        .alert-error i { font-size: 0.95rem; flex-shrink: 0; color: #e53e3e; }
        .alert-error span { line-height: 1.3; }

        .alert-client-error {
            display: none;
            align-items: center;
            gap: 8px;
            background: #fff0f0;
            border: 1.5px solid #feb2b2;
            border-left: 4px solid #e53e3e;
            border-radius: 10px;
            padding: 8px 12px;
            margin-bottom: 10px;
            font-size: 0.78rem;
            color: #c53030;
            font-weight: 600;
        }
        .alert-client-error.show {
            display: flex;
            animation: slideDown 0.35s cubic-bezier(0.22,1,0.36,1) both,
                       shake       0.4s  ease                        0.1s both;
        }
        .alert-client-error i { font-size: 0.95rem; flex-shrink: 0; color: #e53e3e; }
        .alert-client-error span { line-height: 1.3; }

        .btn-login {
            background-color: #1d61e4;
            border: none; border-radius: 10px;
            padding: 8px; font-weight: bold;
            font-size: 0.88rem; width: 100%;
            color: white; margin-top: 10px;
            display: flex; align-items: center;
            justify-content: center; gap: 6px;
            cursor: pointer; position: relative; overflow: hidden;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            animation: riseUp 0.45s cubic-bezier(0.22,1,0.36,1) 1.05s both;
        }
        .btn-login::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(105deg, transparent 35%, rgba(255,255,255,0.25) 50%, transparent 65%);
            background-size: 200% 100%;
            animation: btnShimmer 2.2s ease-in-out 1.2s infinite;
            border-radius: inherit; pointer-events: none;
        }
        .btn-login:hover {
            background-color: #1550c0;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(29,97,228,0.35);
        }
        .btn-login:active { transform: translateY(0); box-shadow: none; }
        .btn-login.loading { pointer-events: none; background-color: #1550c0; }

        .spinner {
            display: none; width: 15px; height: 15px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: white; border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        .success-overlay {
            position: fixed; inset: 0;
            background: rgba(255,255,255,0);
            display: flex; align-items: center;
            justify-content: center; z-index: 9999;
            pointer-events: none; opacity: 0;
            transition: opacity 0.3s;
        }
        .success-overlay.show {
            opacity: 1; pointer-events: all;
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        .success-box {
            background: white; border-radius: 16px;
            padding: 2rem 2.5rem; text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            transform: scale(0.85); opacity: 0;
            transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), opacity 0.3s;
        }
        .success-overlay.show .success-box { transform: scale(1); opacity: 1; }
        .checkmark-circle {
            width: 56px; height: 56px; border-radius: 50%;
            background: #e8f5e9;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 0.8rem;
            animation: popIn 0.4s cubic-bezier(0.34,1.56,0.64,1) 0.15s both;
        }
        .checkmark-circle i { font-size: 1.8rem; color: #2e7d32; }
        .success-title { font-size: 1rem; font-weight: 700; color: #0c3992; margin-bottom: 4px; }
        .success-sub   { font-size: 0.75rem; color: #6c757d; }

        .footer-area {
            margin-top: 1rem;
            animation: fadeIn 0.45s ease 1.15s both;
        }
        .footer-area p { font-size: 0.62rem; color: #adb5bd; margin: 0; }
    </style>
</head>
<body>

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

            @if(session('error'))
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @elseif($errors->has('username') || $errors->has('password'))
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first('username') ?: $errors->first('password') }}</span>
                </div>
            @elseif($errors->has('credentials'))
                <div class="alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first('credentials') }}</span>
                </div>
            @endif

            <div class="alert-client-error" id="clientError">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span id="clientErrorMsg"></span>
            </div>

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <div class="mb-2 field-username">
                    <label class="form-label-custom">Username</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="bi bi-person"></i></span>
                        <input type="text" name="username"
                               class="form-control border-start-0 {{ $errors->any() || session('error') ? 'is-invalid-custom' : '' }}"
                               placeholder="Masukkan username"
                               value="{{ old('username') }}"
                               required autocomplete="off">
                    </div>
                </div>

                <div class="mb-1 field-password">
                    <label class="form-label-custom">Password</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password"
                               class="form-control border-start-0 {{ $errors->any() || session('error') ? 'is-invalid-custom' : '' }}"
                               placeholder="Min. 8 karakter, huruf &amp; angka"
                               id="passwordInput"
                               minlength="8"
                               required>
                        <span class="input-group-text bg-light border-start-0"
                              style="cursor: pointer;" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </span>
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

<script>
    // ✅ pageshow: terpanggil saat load biasa DAN saat klik tombol back browser
    window.addEventListener('pageshow', function () {
        const btn     = document.getElementById('btnLogin');
        const spinner = document.getElementById('btnSpinner');
        const icon    = document.getElementById('btnIcon');
        const text    = document.getElementById('btnText');
        btn.classList.remove('loading');
        spinner.style.display = 'none';
        icon.style.display    = 'inline';
        text.textContent      = 'Masuk';
    });

    window.addEventListener('DOMContentLoaded', function () {
        @if(session('success') || (isset($loginSuccess) && $loginSuccess))
            showSuccess();
        @endif
    });

    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon  = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    function showSuccess() {
        document.getElementById('successOverlay').classList.add('show');
    }

    const passwordInput = document.getElementById('passwordInput');
    const charCount     = document.getElementById('charCount');
    const clientError   = document.getElementById('clientError');
    const clientMsg     = document.getElementById('clientErrorMsg');

    function showClientError(msg) {
        clientMsg.textContent = msg;
        clientError.classList.add('show');
        passwordInput.classList.add('is-invalid-custom');
    }

    function hideClientError() {
        clientError.classList.remove('show');
        passwordInput.classList.remove('is-invalid-custom');
    }

    passwordInput.addEventListener('input', function () {
        const val = this.value;
        const len = val.length;

        charCount.textContent = len;
        if (len >= 8) {
            charCount.classList.add('valid');
            charCount.classList.remove('invalid');
        } else {
            charCount.classList.add('invalid');
            charCount.classList.remove('valid');
        }

        if (/[^a-zA-Z0-9]/.test(val)) {
            showClientError('Password hanya boleh berisi huruf dan angka.');
        } else {
            hideClientError();
        }
    });

    document.getElementById('loginForm').addEventListener('submit', function (e) {
        const val = passwordInput.value;

        if (val.length < 8) {
            e.preventDefault();
            showClientError('Password minimal 8 karakter.');
            return;
        }

        if (/[^a-zA-Z0-9]/.test(val)) {
            e.preventDefault();
            showClientError('Password hanya boleh berisi huruf dan angka.');
            return;
        }

        // ✅ Loading hanya aktif setelah validasi lolos
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

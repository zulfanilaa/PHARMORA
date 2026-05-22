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
            background-color: #007bff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 10px;
        }
        .login-card {
            background: white;
            padding: 1.8rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 420px;
        }
        .logo-container img {
            width: 160px; /* Kembali ke 140px agar proporsional */
            height: auto;
            margin-bottom: 0px;
            /* Menaikkan logo secara keseluruhan */
            position: relative;
            top: -15px; 
        }
        h2 { 
            font-size: 1.6rem; 
            /* Menaikkan tulisan mengikuti logo */
            margin-top: -50px; 
            margin-bottom: 5px;
        }
        .sub-title {
            font-size: 0.85rem;
            /* Memberi jarak bawah agar tidak menempel ke kotak login */
            margin-top: -5px; 
            margin-bottom: 25px !important; 
        }
        .btn-primary {
            border-radius: 10px;
            padding: 10px;
            font-weight: bold;
            background-color: #007bff;
            border: none;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
        }
        .mb-3 { margin-bottom: 0.7rem !important; }
    </style>
</head>
<body>

<div class="text-center w-100">
    <!-- Area Logo & Header -->
    <div class="logo-container">
        <img src="{{ asset('img/logo-pharmora.png') }}" alt="Logo Pharmora">
    </div>
    <h2 class="text-white fw-bold">PHARMORA</h2>
    <p class="text-white-50 sub-title">Sistem Informasi Farmasi RS</p>

    <!-- Card Login -->
    <div class="login-card text-start mx-auto">
        <h5 class="fw-bold mb-1">Selamat Datang</h5>
        <p class="text-muted small mb-3">Masuk ke dashboard PHARMORA</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold mb-1">USERNAME</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control bg-light border-start-0" placeholder="Username" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold mb-1">PASSWORD</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="Password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 mt-2">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>
        </form>
    </div>
    
    <!-- Footer -->
    <p class="text-white-50 mt-3 mb-0" style="font-size: 0.75rem;">&copy; 2026 PHARMORA · Sistem Informasi Farmasi RS</p>
</div>

</body>
</html>
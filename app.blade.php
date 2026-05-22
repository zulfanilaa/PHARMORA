<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHARMORA - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <style>
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2) !important;
            border-radius: 8px;
            font-weight: bold;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }
        .profile-btn {
            text-decoration: none;
            transition: 0.2s;
        }
        .profile-btn:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            border-radius: 8px;
        }
        .icon-resep {
            transform: rotate(-15deg);
            display: inline-block;
        }
        .hover-opacity:hover {
            opacity: 1 !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
    </style>
</head>

<body class="bg-light min-vh-100">
    <div class="d-flex min-vh-100">

        <div class="d-flex flex-column flex-shrink-0 p-3 bg-primary" style="width: 250px">
            
            <div class="text-white text-center py-0 mb-0">
                <div class="position-relative d-inline-block">
                    <img src="{{ asset('img/logo-pharmora.png') }}" alt="Logo Pharmora" 
                         style="width: 150px; height: auto; margin-top: -20px;">
                </div>
                <div class="fw-bold fs-5" style="margin-top: -45px;">PHARMORA</div>
                <small class="text-white-50 small d-block" style="margin-top: -10px; margin-bottom: 15px;">
                    Sistem Informasi Farmasi RS
                </small>
            </div>
            
            <hr class="border-white opacity-25 my-1" />
            
            @php 
                $user = auth()->user();
                $userRole = strtolower(trim($user->role)); 
                // Variabel bantuan untuk mengecek staff (Admin/Apoteker)
                $isStaff = in_array($userRole, ['admin', 'apoteker']);
            @endphp

            <a href="{{ route('user.index') }}" 
               class="profile-btn d-flex align-items-center gap-2 px-2 py-2 rounded-3 mb-2 text-decoration-none {{ request()->is('user*') ? 'bg-white bg-opacity-25 shadow-sm' : '' }}">
                
                <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                     style="width: 35px; height: 35px; min-width: 35px;">
                    <i class="bi bi-person-fill fs-6"></i>
                </div>

                <div class="text-white overflow-hidden">
                    <div class="fw-bold small text-truncate" title="{{ $user->name }}">
                        {{ $user->name }}
                    </div>
                </div>
            </a>

            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }} text-white d-flex align-items-center gap-2 px-3 py-2">
                        <i class="bi bi-capsule"></i> Farmasi
                    </a>
                </li>
                
                {{-- Menu E-Resep Khusus Dokter --}}
                @if($userRole == 'dokter')
                <li class="nav-item">
                    <a href="{{ route('history.index') }}" class="nav-link {{ request()->is('history*') ? 'active' : '' }} text-white d-flex align-items-center gap-2 px-3 py-2">
                        <i class="bi bi-file-earmark-medical-fill icon-resep"></i> E-Resep
                    </a>
                </li>
                @endif

                {{-- Menu History List untuk Admin DAN Apoteker --}}
                @if($isStaff)
                <li class="nav-item">
                    <a href="{{ route('history.index') }}" class="nav-link {{ request()->is('history*') ? 'active' : '' }} text-white d-flex align-items-center gap-2 px-3 py-2">
                        <i class="bi bi-clock-history"></i> History List
                    </a>
                </li>
                @endif
                
                {{-- Menu Report Muncul untuk Semua (Karena tadi kita sudah filter tombol cetaknya di dalam view) --}}
                <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link {{ request()->is('report*') ? 'active' : '' }} text-white d-flex align-items-center gap-2 px-3 py-2">
                        <i class="bi bi-file-earmark-bar-graph"></i> Report
                    </a>
                </li>
            </ul>
            
            <div class="mt-auto">
                <hr class="border-white opacity-25" />
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-white-50 d-flex align-items-center gap-2 px-3 py-2 border-0 bg-transparent w-100 text-start hover-opacity">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-grow-1 d-flex flex-column overflow-hidden">
            <div class="d-flex align-items-center justify-content-between px-4 py-3 bg-white border-bottom shadow-sm">
                <div>
                    <h5 class="mb-0 fw-bold text-primary">PHARMORA SYSTEM</h5>
                    <small class="text-muted">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</small>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-medium">
                        {{ ucfirst($userRole) }}
                    </span>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                         style="width: 38px; height: 38px">
                         <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>

            <main class="flex-grow-1 overflow-auto bg-light">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
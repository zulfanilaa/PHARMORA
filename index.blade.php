@extends('layouts.app')

@section('content')
<div class="p-4">
    @php 
        $userRole = strtolower(trim(auth()->user()->role)); 
        // Cek apakah user punya hak akses pengelola (Admin atau Apoteker)
        $isPengelola = in_array($userRole, ['admin', 'apoteker']);
    @endphp

    <div class="mb-4">
        <h4 class="fw-bold text-primary mb-0">
            {{ $isPengelola ? 'Input / Edit Nama Obat' : 'Daftar Nama Obat' }}
        </h4>
        <small class="text-muted">
            {{ $isPengelola ? 'Tambah atau ubah data nama obat' : 'Cek ketersediaan nama obat di sistem' }}
        </small>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success py-2 shadow-sm border-0 rounded-3 mb-3">{{ session('success') }}</div>
    @endif
    
    {{-- Alert Warning --}}
    @if(session('warning'))
        <div class="alert alert-warning py-2 shadow-sm border-0 rounded-3 mb-3" style="background-color: #fff3cd; color: #856404;">
            {{ session('warning') }}
        </div>
    @endif

    {{-- FIX: Tampilin Alert Error Validasi kalau Kode Obat Duplikat / Kembar --}}
    @if($errors->any())
        <div class="alert alert-danger py-2 shadow-sm border-0 rounded-3 mb-3" style="background-color: #f8d7da; color: #721c24;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <ul class="mb-0 ps-2" style="list-style-type: none;">
                    @foreach ($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Form Tambah/Edit Muncul untuk Admin DAN Apoteker --}}
    @if($isPengelola)
    <div class="card border-0 rounded-4 shadow-sm mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-pencil-square text-primary me-2"></i>
                {{ isset($obat) ? 'Edit Data Obat' : 'Tambah Data Obat Baru' }}
            </h6>
            
            <form action="{{ isset($obat) ? route('obat.update', $obat->{'id obat'}) : route('obat.store') }}" method="POST">
                @csrf
                @if(isset($obat)) 
                    @method('PUT') 
                @endif
                
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small mb-1">Kode Obat *</label>
                        <input type="text" name="kode_obat" class="form-control rounded-3" 
                               placeholder="Contoh: OBT001" 
                               style="height: 45px;" 
                               value="{{ isset($obat) ? $obat->{'Kode Obat'} : old('kode_obat') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small mb-1">Nama Obat *</label>
                        <input type="text" name="nama_obat" class="form-control rounded-3" 
                               placeholder="Contoh: Paracetamol 500mg" 
                               style="height: 45px;" 
                               value="{{ isset($obat) ? $obat->{'Nama Obat'} : old('nama_obat') }}" required>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-3 flex-grow-1 shadow-sm d-flex align-items-center justify-content-center gap-2" 
                                    style="height: 45px; padding: 0;">
                                <i class="bi {{ isset($obat) ? 'bi-save' : 'bi-plus-circle' }}"></i> 
                                <span class="fw-bold">{{ isset($obat) ? 'Simpan' : 'Tambah' }}</span>
                            </button>
                            
                            @if(isset($obat))
                                <a href="{{ route('obat.index') }}" class="btn btn-outline-secondary rounded-3 px-3 d-flex align-items-center justify-content-center border shadow-sm gap-2" 
                                   style="height: 45px; padding: 0; min-width: 100px;">
                                    <i class="bi bi-x-lg"></i> Batal
                                </a>
                            @else
                                <button type="reset" class="btn btn-outline-secondary rounded-3 px-3 d-flex align-items-center justify-content-center border shadow-sm gap-2" 
                                        style="height: 45px; padding: 0; min-width: 100px;">
                                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Tabel Data --}}
    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-table text-primary me-2"></i>Data Obat 
                    <span class="badge bg-primary rounded-pill ms-1">{{ $semuaObat->total() }}</span>
                </h6>
                <form action="{{ route('obat.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-sm rounded-3" 
                           placeholder="Cari kode / nama obat..." 
                           value="{{ request('search') }}" style="width:220px;">
                    <button class="btn btn-primary btn-sm rounded-3"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0 text-center">
                    <thead style="background-color: #e7f1ff; color: #0d6efd;">
                        <tr>
                            <th style="width: 50px">No</th>
                            <th style="width: 80px">ID</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            @if($isPengelola)
                                <th style="width: 150px">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($semuaObat as $item)
                        <tr>
                            <td>{{ ($semuaObat->currentPage()-1) * $semuaObat->perPage() + $loop->iteration }}</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $item->{'id obat'} }}</span></td>
                            <td><strong class="text-primary">{{ $item->{'Kode Obat'} }}</strong></td>
                            <td class="text-start px-3">{{ $item->{'Nama Obat'} }}</td>
                            
                            @if($isPengelola)
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Admin & Apoteker bisa klik Edit --}}
                                    <a href="{{ route('obat.edit', $item->{'id obat'}) }}" class="btn btn-outline-primary btn-sm p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- Admin & Apoteker bisa akses tombol Hapus --}}
                                    <form action="{{ route('obat.destroy', $item->{'id obat'}) }}" method="POST" class="m-0 d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data obat ini?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ $isPengelola ? 5 : 4 }}" class="py-5">
                                <i class="bi bi-inbox fs-2 text-muted d-block mb-2"></i>
                                <span class="text-muted">Data tidak ditemukan.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $semuaObat->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
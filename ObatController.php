<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    // Menampilkan daftar nama obat (Warna Biru)
    public function index(Request $request)
    {
        $search = $request->search;
        
        // Memakai DB::table langsung ke nama tabel aslimu agar pencarian lancar
        $semuaObat = DB::table('input / edit nama obat')
            ->when($search, function($query) use ($search) {
                $query->where('Kode Obat', 'like', "%{$search}%")
                      ->orWhere('Nama Obat', 'like', "%{$search}%");
            })
            ->orderBy('id obat', 'desc')
            ->paginate(10);

        return view('obat.index', compact('semuaObat', 'search'));
    }

    // Menyimpan nama obat baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',
        ]);

        // Cek duplikat langsung ke tabel 'input / edit nama obat'
        $cekDuplikat = DB::table('input / edit nama obat')
            ->where('Kode Obat', $request->kode_obat)
            ->exists();

        if ($cekDuplikat) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['kode_obat' => 'Gagal Tambah! Kode obat ini sudah terdaftar di sistem. Silakan update stoknya saja di menu Stok Obat.']);
        }

        // Simpan data ke tabel 'input / edit nama obat'
        DB::table('input / edit nama obat')->insert([
            'Kode Obat' => $request->kode_obat,
            'Nama Obat' => $request->nama_obat,
            'create_at' => now(), // Sesuai kolom di phpMyAdmin kamu: 'create_at' (tanpa 'd')
            'update_at' => now(), // Sesuai kolom di phpMyAdmin kamu: 'update_at' (tanpa 'd')
        ]);

        return redirect()->route('obat.index')->with('success', 'Data obat baru berhasil ditambahkan!');
    }

    // Mengambil data untuk edit nama obat
    public function edit($id)
    {
        // Ambil data dari tabel yang benar
        $obat = DB::table('input / edit nama obat')->where('id obat', $id)->first();
        
        if (!$obat) {
            abort(404);
        }

        $search = request('search');
        $semuaObat = DB::table('input / edit nama obat')->orderBy('id obat', 'desc')->paginate(10);
        
        return view('obat.index', compact('obat', 'semuaObat', 'search'));
    }

    // Memperbarui data nama obat
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',
        ]);

        // Cek duplikat ke tabel yang benar dengan mengecualikan id obat ini
        $cekDuplikat = DB::table('input / edit nama obat')
            ->where('Kode Obat', $request->kode_obat)
            ->where('id obat', '!=', $id)
            ->exists();

        if ($cekDuplikat) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['kode_obat' => 'Gagal Ubah! Kode obat ini sudah dipakai oleh obat lain.']);
        }

        // Update ke tabel yang benar
        DB::table('input / edit nama obat')->where('id obat', $id)->update([
            'Kode Obat' => $request->kode_obat,
            'Nama Obat' => $request->nama_obat,
            'update_at' => now(),
        ]);

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui!');
    }

    // Menghapus nama obat
    public function destroy($id)
    {
        DB::table('input / edit nama obat')->where('id obat', $id)->delete();
        return redirect()->route('obat.index')->with('warning', 'Data obat berhasil dihapus.');
    }
}
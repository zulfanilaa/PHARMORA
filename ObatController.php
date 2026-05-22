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

    // Menyimpan nama obat baru (Super Ketat)
    public function store(Request $request)
    {
        $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',
        ], [
            'kode_obat.required' => 'Kode obat wajib diisi ya!',
            'nama_obat.required' => 'Nama obat beserta dosisnya wajib diisi!',
        ]);

        // ATURAN 1: Cek apakah KODE OBAT sudah pernah ada? (Mutlak Unik)
        $cekKode = DB::table('input / edit nama obat')
            ->where('Kode Obat', $request->kode_obat)
            ->exists();

        if ($cekKode) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['kode_obat' => 'Gagal Tambah! Kode obat ini sudah terdaftar di sistem. Satu kode khusus untuk satu obat!']);
        }

        // ATURAN 2: Cek apakah NAMA OBAT + DOSIS sudah pernah ada? (Mutlak Unik)
        $cekNama = DB::table('input / edit nama obat')
            ->where('Nama Obat', $request->nama_obat)
            ->exists();

        if ($cekNama) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_obat' => 'Gagal Tambah! Nama obat dengan dosis tersebut sudah ada di sistem.']);
        }

        // SIMPAN: Jika lolos kedua pengecekan di atas, baru data dimasukkan
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

    // Memperbarui data nama obat (Super Ketat)
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',
        ], [
            'kode_obat.required' => 'Kode obat wajib diisi!',
            'nama_obat.required' => 'Nama obat wajib diisi!',
        ]);

        // ATURAN 1 PAS EDIT: Cek apakah kode baru sudah dipakai oleh obat lain
        $cekKode = DB::table('input / edit nama obat')
            ->where('Kode Obat', $request->kode_obat)
            ->where('id obat', '!=', $id)
            ->exists();

        if ($cekKode) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['kode_obat' => 'Gagal Ubah! Kode obat ini sudah dipakai oleh data obat lain.']);
        }

        // ATURAN 2 PAS EDIT: Cek apakah nama + dosis baru sudah dipakai oleh obat lain
        $cekNama = DB::table('input / edit nama obat')
            ->where('Nama Obat', $request->nama_obat)
            ->where('id obat', '!=', $id)
            ->exists();

        if ($cekNama) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_obat' => 'Gagal Ubah! Nama obat dengan dosis ini sudah ada di data lain.']);
        }

        // UPDATE: Jalankan jika lolos validasi
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

<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermohonanController extends Controller
{
    public function create()
    {
        // Cek apakah user sudah melengkapi profile
        $user = Auth::user();
        if (!$user->profile || !$user->profile->isComplete()) {
            return redirect()->route('profile.index')
                ->with('error', 'Mohon lengkapi profile Anda terlebih dahulu sebelum mengajukan permohonan');
        }

        return view('permohonan.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $user = Auth::user();
            
            // Generate nomor surat
            $nomorSurat = 'PINDAH-' . date('Ymd') . '-' . rand(1000, 9999);

            // Validasi input
            $validatedData = $request->validate([
                'pindah_ke_rt' => 'required',
                'alasan_pindah' => 'required',
                'alamat' => 'required',
                'no_telp' => 'nullable|string|max:15'
            ]);

            // Simpan permohonan
            $permohonan = Permohonan::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'nomor_surat' => $nomorSurat,
                'pindah_ke_rt' => $request->pindah_ke_rt,
                'alasan_pindah' => $request->alasan_pindah,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'status' => 'proses'
            ]);

            DB::commit();

            return redirect()->route('home')->with('success', 'Permohonan berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $user = Auth::user();
        
        // Ambil semua permohonan user yang login dan join dengan tabel profile
        $permohonan = Permohonan::select('permohonan.*', 'profiles.rt as asal_rt')
                               ->join('profiles', 'permohonan.user_id', '=', 'profiles.user_id')
                               ->where('permohonan.user_id', $user->id)
                               ->orderBy('permohonan.created_at', 'desc')
                               ->get();

        return view('permohonan.riwayat', compact('permohonan'));
    }

    // Tambahkan method untuk menampilkan halaman cek status
    public function status()
    {
        return view('permohonan.status');
    }

    // Tambahkan method untuk API cek status
    public function cekStatus($nomorSurat)
    {
        $permohonan = Permohonan::where('nomor_surat', $nomorSurat)->first();

        if (!$permohonan) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor surat tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'permohonan' => [
                'nomor_surat' => $permohonan->nomor_surat,
                'nama_pemohon' => $permohonan->nama,
                'tanggal_pengajuan' => $permohonan->created_at->format('d/m/Y'),
                'status' => $permohonan->status
            ]
        ]);
    }

    public function cetakSurat($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        return view('surat.cetak', compact('permohonan'));
    }
}

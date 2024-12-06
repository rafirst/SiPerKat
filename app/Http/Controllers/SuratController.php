<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function cetak($id)
    {
        $permohonan = Permohonan::findOrFail($id);

        // Pastikan hanya mengizinkan cetak jika status ditolak
        if ($permohonan->status !== 'ditolak') {
            return redirect()->route('admin.response.index')->with('error', 'Surat hanya bisa dicetak jika status ditolak.');
        }

        return view('surat.cetak', compact('permohonan'));
    }
} 
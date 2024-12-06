<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Hitung total semua permohonan
        $totalPermohonan = Permohonan::count();
        
        // Hitung status permohonan untuk semua user
        $diprosesCount = Permohonan::where('status', 'proses')->count();
        $disetujuiCount = Permohonan::where('status', 'diterima')->count();
        $ditolakCount = Permohonan::where('status', 'ditolak')->count();

        return view('home', compact(
            'totalPermohonan',
            'diprosesCount',
            'disetujuiCount',
            'ditolakCount'
        ));
    }
}
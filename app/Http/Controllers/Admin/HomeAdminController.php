<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user() || $request->user()->role !== 'admin') {
            return redirect('/home');
        }

        $permohonanBaru = Permohonan::where('status', 'proses')->count();
        $permohonanDisetujui = Permohonan::where('status', 'disetujui')->count();
        $permohonanDitolak = Permohonan::where('status', 'ditolak')->count();
        
        $permohonanTerbaru = Permohonan::where('status', 'proses')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.homeAdmin', compact(
            'permohonanBaru',
            'permohonanDisetujui',
            'permohonanDitolak',
            'permohonanTerbaru'
        ));
    }
} 
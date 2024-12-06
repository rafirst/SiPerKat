<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ResponseController extends Controller
{
    public function index()
    {
        $totalPermohonan = Permohonan::count();
        $pendingCount = Permohonan::where('status', 'proses')->count();
        $approvedCount = Permohonan::where('status', 'diterima')->count();
        $rejectedCount = Permohonan::where('status', 'ditolak')->count();
        
        $permohonan = Permohonan::with(['user.profile'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        
        return view('admin.response.index', compact(
            'permohonan',
            'totalPermohonan',
            'pendingCount',
            'approvedCount',
            'rejectedCount'
        ));
    }

    public function show($id)
    {
        $permohonan = Permohonan::with(['user.profile'])->findOrFail($id);
        return view('admin.response.show', compact('permohonan'));
    }

    public function approve($id)
    {
        DB::beginTransaction();
        try {
            $permohonan = Permohonan::lockForUpdate()->findOrFail($id);
            
            $permohonan->status = 'diterima';
            $permohonan->admin_comment = request('keterangan');
            $permohonan->save();
            
            DB::commit();
            
            Log::info('Permohonan disetujui', [
                'id' => $id,
                'status' => $permohonan->status,
                'comment' => $permohonan->admin_comment
            ]);
            
            return redirect()->route('admin.response.index')
                            ->with('success', 'Permohonan berhasil disetujui');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error approving permohonan', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('admin.response.index')
                            ->with('error', 'Gagal memproses permohonan: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        DB::beginTransaction();
        try {
            $permohonan = Permohonan::lockForUpdate()->findOrFail($id);
            
            $permohonan->status = 'ditolak';
            $permohonan->admin_comment = request('keterangan');
            $permohonan->save();
            
            DB::commit();
            
            Log::info('Permohonan ditolak', [
                'id' => $id,
                'status' => $permohonan->status,
                'comment' => $permohonan->admin_comment
            ]);
            
            return redirect()->route('admin.response.index')
                            ->with('success', 'Permohonan berhasil ditolak');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error rejecting permohonan', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('admin.response.index')
                            ->with('error', 'Gagal memproses permohonan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $permohonan = Permohonan::findOrFail($id);
            
            $permohonan->update([
                'status' => $request->status,
                'admin_comment' => $request->keterangan,
                'tanggal_response' => now()
            ]);

            return redirect()->route('admin.response.index')
                ->with('success', 'Status permohonan berhasil diperbarui');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status permohonan');
        }
    }

    public function cetakSurat($id)
    {
        try {
            $permohonan = Permohonan::with(['user', 'user.profile'])->findOrFail($id);
            
            // Pastikan hanya permohonan yang diterima yang bisa dicetak
            if ($permohonan->status !== 'diterima') {
                return back()->with('error', 'Hanya permohonan yang diterima yang dapat dicetak');
            }

            return view('surat.cetak', compact('permohonan'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
} 
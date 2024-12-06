<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function index()
    {
        $adminProfile = AdminProfile::where('user_id', Auth::id())->first();
        
        return view('admin.profile', [
            'user' => $adminProfile
        ]);
    }

    public function update(Request $request)
    {
        try {
            $adminProfile = AdminProfile::where('user_id', Auth::id())->first();
            
            $validated = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|email|unique:admin_profiles,email,' . $adminProfile->id,
                'no_telepon' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            // Update data satu per satu
            $adminProfile->nama_lengkap = $validated['nama_lengkap'];
            $adminProfile->email = $validated['email'];
            $adminProfile->no_telepon = $validated['no_telepon'];
            
            // Update password jika ada
            if (!empty($validated['password'])) {
                $adminProfile->password = Hash::make($validated['password']);
            }

            // Simpan perubahan
            $adminProfile->save();

            return redirect()->back()->with('success', 'Profile berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateFoto(Request $request)
    {
        try {
            $request->validate([
                'foto_profile' => 'required|image|mimes:jpeg,png|max:5120',
            ]);

            $adminProfile = AdminProfile::where('user_id', Auth::id())->first();

            if ($request->hasFile('foto_profile')) {
                // Hapus foto lama jika ada
                if ($adminProfile->foto) {
                    $oldPath = public_path('storage/profile-photos/' . $adminProfile->foto);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                $foto = $request->file('foto_profile');
                $filename = time() . '_' . str_replace(' ', '_', $foto->getClientOriginalName());
                
                // Pastikan direktori exists
                $path = public_path('storage/profile-photos');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                // Simpan foto langsung ke public path
                $foto->move($path, $filename);
                
                // Update database
                $adminProfile->foto = $filename;
                $adminProfile->save();

                // Debug log
                Log::info('Foto disimpan di: ' . $path . '/' . $filename);
                Log::info('URL foto: ' . asset('storage/profile-photos/' . $filename));

                return redirect()->back()->with('success', 'Foto profile berhasil diperbarui');
            }

            return redirect()->back()->with('error', 'Tidak ada foto yang diunggah');
        } catch (\Exception $e) {
            Log::error('Error saat upload foto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
} 
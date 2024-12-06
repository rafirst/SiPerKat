<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rt' => 'required|string',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string',
            'nik' => 'required|string|size:16',
        ]);

        try {
            $user = Auth::user();
            
            // Update atau buat profile
            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'rt' => $request->rt,
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                    'nik' => $request->nik,
                ]
            );

            return redirect()->back()->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }
    
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            
            // Debug request
            Log::info('Request data:', $request->all());
            
            if ($request->hasFile('foto')) {
                Log::info('File foto ditemukan');
                
                $file = $request->file('foto');
                $fileName = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                
                // Pastikan direktori exists
                if (!file_exists(public_path('storage/profile_photos'))) {
                    mkdir(public_path('storage/profile_photos'), 0777, true);
                }
                
                // Simpan file secara langsung ke public path
                $file->move(public_path('storage/profile_photos'), $fileName);
                
                Log::info('File berhasil dipindahkan ke storage');
                
                // Update atau create profile
                $profile = Profile::updateOrCreate(
                    ['user_id' => $user->id],
                    ['foto' => $fileName]
                );
                
                Log::info('Profile updated/created:', $profile->toArray());
            }
            
            DB::commit();
            return redirect()->back()->with('success', 'Profil berhasil diperbarui');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error dalam update profile: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Gagal mengupdate profile: ' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && file_exists(public_path('storage/profile_photos/' . $user->profile_photo))) {
                unlink(public_path('storage/profile_photos/' . $user->profile_photo));
            }
            
            // Simpan foto baru
            $photo = $request->file('profile_photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile_photos', $filename);
            
            $user->profile_photo = $filename;
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        dd($user);
        $user->save();
        
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
} 
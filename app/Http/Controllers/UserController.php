<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function profile()
    {
        // dd(Auth::check()); // Ini akan mengembalikan true jika pengguna login, false jika tidak
        // $user = Auth::user();  // Mendapatkan data pengguna yang sedang login
        return view('users.profile', compact('user'));


    }
    
    // Menyimpan data pengg una baru
    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek kelengkapan data profil
        if (empty($user->alamat) || empty($user->no_telepon) || empty($user->nik)) {
            return redirect()->route('profile.index')->with('error', 'Silakan lengkapi data profil Anda sebelum membuat permohonan.');
        }

        // Validasi data permohonan
        $request->validate([
            'asal_rt' => 'required',
            'pindah_ke_rt' => 'required',
            'no_telp' => 'required',
            'alasan_pindah' => 'required',
            'alamat' => 'required',
        ]);

        // Simpan permohonan
        // ...

        return redirect()->route('home')->with('success', 'Permohonan berhasil disimpan.');
    }

    public function register(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Login pengguna
        Auth::login($user);

        // Redirect ke halaman home
        return redirect()->route('home');
    }
}

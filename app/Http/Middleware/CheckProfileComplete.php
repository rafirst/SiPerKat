<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        if (!$user->profile || !$user->profile->rt || !$user->profile->alamat || !$user->profile->no_telepon || !$user->profile->nik) {
            return redirect()->route('profile.index')
                ->with('error', 'Silakan lengkapi profil Anda terlebih dahulu sebelum mengajukan permohonan.');
        }

        return $next($request);
    }
}
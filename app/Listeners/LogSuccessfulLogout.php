<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\LoginHistory;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        if ($event->user) {
            // Cari record login terakhir
            $lastLogin = LoginHistory::where('user_id', $event->user->id)
                ->whereNull('logout_at')
                ->latest()
                ->first();

            // Update jika ditemukan
            if ($lastLogin) {
                $lastLogin->update([
                    'logout_at' => now()
                ]);
            }
        }
    }
} 
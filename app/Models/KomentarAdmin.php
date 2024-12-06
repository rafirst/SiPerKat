<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarAdmin extends Model
{
    protected $table = 'komentar_id';

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_admin_id');
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $table = 'rts';
    
    protected $fillable = [
        'nama_rt'
    ];

    // Relasi dengan User (RT Asal)
    public function users()
    {
        return $this->hasMany(User::class, 'rt_id', 'id');
    }

    // Relasi dengan Permohonan (RT Tujuan)
    public function permohonans()
    {
        return $this->hasMany(Permohonan::class, 'rt_tujuan', 'id');
    }
}

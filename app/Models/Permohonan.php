<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';

    protected $fillable = [
        'user_id',
        'nama',
        'nomor_surat',
        'pindah_ke_rt',
        'alasan_pindah',
        'alamat',
        'no_telp',
        'status',
        'admin_comment',
        'tanggal_response',
        'admin_comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    
    
}

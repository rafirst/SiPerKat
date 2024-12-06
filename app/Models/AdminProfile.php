<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;

    protected $table = 'admin_profiles';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'email',
        'password',
        'no_telepon',
        'foto'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getFotoProfileUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/profile_pictures/' . $this->foto);
        }
        return asset('images/default-profile.png');
    }
} 
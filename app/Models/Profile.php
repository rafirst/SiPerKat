<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    
    protected $fillable = [
        'user_id',
        'foto',
        'nik',
        'rt',
        'no_telepon',
        'alamat'
    ];

    public function isComplete()
    {
        return !empty($this->rt) && 
               !empty($this->alamat) && 
               !empty($this->no_telepon) && 
               !empty($this->nik);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getFotoUrlAttribute()
    {
        return $this->profile_photo ? asset('storage/profile_photos/' . $this->profile_photo) : asset('img/Profile.png');
    }
}

<?php

namespace Database\Seeders;

use App\Models\RT;
use Illuminate\Database\Seeder;

class RTSeeder extends Seeder
{
    public function run()
    {
        RT::create([
            'nama_rt' => 'RT 001',
            'wilayah' => 'Jakarta Selatan'
        ]);
        
        RT::create([
            'nama_rt' => 'RT 002',
            'wilayah' => 'Jakarta Pusat'
        ]);
    }
}
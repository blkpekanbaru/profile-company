<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'name' => 'Workshop Gambar Bangunan',
            'image' => 'assets/img/blk-3d.jpg',
        ]);
        Facility::create([
            'name' => 'Tourism Building',
            'image' => 'assets/img/blk-3d.jpg',
        ]);
    }
}

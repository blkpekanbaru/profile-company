<?php

namespace Database\Seeders;

use App\Models\Workshop;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workshops = [
            // Kejuruan Bangunan
            [
                'department' => 'Bangunan',
                'name' => 'Gambar Bangunan (AutoCAD/BIM)',
                'image' => 'assets/img/kejuruan/bangunan.png',
            ],
            // Kejuruan Las
            [
                'department' => 'Las',
                'name' => 'Fillet Welder SMAW 2F',
                'image' => 'assets/img/kejuruan/las.png',
            ],
            // Kejuruan Listrik
            [
                'department' => 'Listrik',
                'name' => 'Pemasangan Instalasi Listrik Bangunan Sederhana',
                'image' => 'assets/img/kejuruan/listrik.png',
            ],
            // Kejuruan Otomotif
            [
                'department' => 'Otomotif',
                'name' => 'Pemeliharaan Kendaraan Ringan (Mobil)',
                'image' => 'assets/img/kejuruan/otomotif.png',
            ],
            // Kejuruan Pariwisata
            [
                'department' => 'Pariwisata',
                'name' => 'Barista / Pembuatan Minuman Kopi',
                'image' => 'assets/img/kejuruan/pariwisata.jpg',
            ],
            // Kejuruan Teknik Pendingin
            [
                'department' => 'Teknik Pendingin',
                'name' => 'Teknisi AC Residensial',
                'image' => 'assets/img/kejuruan/teknik-pendingin.png',
            ],
            // Kejuruan TIK
            [
                'department' => 'TIK',
                'name' => 'Desain Grafis Muda',
                'image' => 'assets/img/kejuruan/TIK.webp',
            ],
        ];

        foreach ($workshops as $item) {
            // Ambil department berdasarkan nama yang ada di screenshot admin kamu
            $dept = Department::where('name', $item['department'])->first();

            if ($dept) {
                Workshop::create([
                    'department_id' => $dept->id,
                    'name' => $item['name'],
                    'slug' => Str::slug($item['name']),
                    'external_link' => 'https://siapkerja.kemnaker.go.id',
                    'image' => $item['image'],
                    'status' => 1,
                ]);

                // Update angka 'Total Pelatihan' agar tidak 0 lagi di dashboard
                $dept->increment('total_workshops');
            }
        }
    }
}

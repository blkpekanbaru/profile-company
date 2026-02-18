<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'history',
                'title' => 'Sejarah & Transformasi',
                'content' => json_encode([
                    [
                        'year' => '1982 – 2000',
                        'title' => 'Era Pembentukan',
                        'description' => 'Dibawah Departemen Tenaga Kerja RI BLK Pekanbaru didirikan sebagai inisiatif pemerintah pusat untuk mempercepat penyediaan tenaga kerja terampil di daerah.'
                    ],
                    [
                        'year' => '2000 – 2018',
                        'title' => 'Era Otonomi Daerah',
                        'description' => 'Pelimpahan ke Pemerintah Provinsi Riau. Nama berubah menjadi Unit Pelaksana Teknis (UPT) BLK Pekanbaru di bawah naungan Disnakertrans Provinsi Riau.'
                    ],
                    [
                        'year' => '2018 – 2022',
                        'title' => 'Era Re-Sentralisasi',
                        'description' => 'Menjadi Unit Pelaksana Teknis Pusat (UPTP) di bawah Kementerian Ketenagakerjaan RI untuk menyeragamkan kualitas pelatihan secara nasional.'
                    ],
                    [
                        'year' => '2022 – Sekarang',
                        'title' => 'Era Transformasi Modern',
                        'description' => 'Berubah menjadi Satuan Pelayanan Pelatihan Vokasi dan Produktivitas (Satpel PVP) Pekanbaru di bawah koordinasi BBPVP Medan berdasarkan Permenaker No. 1 Tahun 2022.'
                    ]
                ])
            ],
            [
                'key' => 'vision_mission',
                'title' => 'Visi & Misi',
                'content' => '<h3>Visi</h3><p>Terwujudnya tenaga kerja yang kompeten mandiri dan berdaya saing</p><h3>Misi</h3><ol><li>Meningkatkan kualitas pelatihan vokasi dan produktivitas</li><li>Mengembangkan jejaring kemitraan dengan dunia usaha dan dunia industri</li><li>Meningkatkan kualitas tata kelola administrasi dan pelayanan publik</li></ol>'
            ],
            [
                'key' => 'structure',
                'title' => 'Struktur Organisasi',
                'content' => '<p>Halaman ini menampilkan bagan susunan organisasi yang berlaku di lingkungan BLK Pekanbaru</p>',
                'image' => 'assets/img/struktur-organisasi.jpg'
            ],
            [
                'key' => 'main_task',
                'title' => 'Tugas Pokok',
                'content' => '<p>Melaksanakan pengembangan pelatihan vokasi dan produktivitas pemberdayaan serta sertifikasi tenaga kerja instruktur dan tenaga pelatihan di wilayah kerja BLK Pekanbaru</p>'
            ],
            [
                'key' => 'functions',
                'title' => 'Fungsi',
                'content' => '<h3>Fungsi Utama</h3><ol><li>Penyusunan rencana program dan anggaran</li><li>Pelaksanaan pelatihan vokasi dan peningkatan produktivitas</li><li>Pelaksanaan fasilitasi pemagangan</li><li>Pelaksanaan peningkatan kompetensi instruktur dan tenaga pelatihan</li><li>Pelaksanaan sertifikasi kompetensi</li><li>Pelaksanaan uji coba program sistem dan metode pelatihan vokasi</li><li>Pelaksanaan konsultasi pelatihan vokasi dan produktivitas</li><li>Pelaksanaan promosi dan pengukuran peningkatan produktivitas</li><li>Pelaksanaan peningkatan jejaring pelatihan vokasi dan produktivitas</li><li>Pelaksanaan pemantauan pelatihan vokasi dan produktivitas</li><li>Pelaksanaan urusan organisasi dan sumber daya manusia aparatur tata laksana keuangan rumah tangga persuratan kearsipan perlengkapan dan pengelolaan barang milik negara</li><li>Penyusunan evaluasi dan pelaporan</li></ol>'
            ],
        ];

        foreach ($data as $item) {
            Profile::updateOrCreate(['key' => $item['key']], $item);
        }
    }
}

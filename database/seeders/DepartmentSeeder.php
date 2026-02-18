<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Pariwisata',
                'image' => 'pariwisata.jpg',
                'description' => 'Kejuruan Pariwisata di Satpel PVP Pekanbaru menawarkan program pelatihan yang dirancang untuk membekali peserta dengan keterampilan teknis dan pelayanan di bidang industri pariwisata. Mulai dari pelayanan tamu, pengelolaan perjalanan wisata, hingga dasar-dasar hospitality, pelatihan ini memberikan pengalaman praktis yang sesuai dengan standar layanan industri. Dengan pendekatan berbasis kompetensi, peserta dipersiapkan untuk bekerja secara profesional di sektor pariwisata serta mampu bersaing di dunia kerja yang terus berkembang.'
            ],
            [
                'name' => 'Listrik',
                'image' => 'listrik.png',
                'description' => 'Kejuruan Listrik di Satpel PVP Pekanbaru menawarkan program pelatihan yang dirancang untuk membekali peserta dengan keterampilan teknis di bidang instalasi dan perawatan sistem kelistrikan. Mulai dari pemasangan instalasi listrik rumah tangga hingga pemeliharaan peralatan listrik, pelatihan ini memberikan pengalaman praktis yang sesuai dengan standar keselamatan dan kebutuhan industri. Dengan pendekatan berbasis kompetensi, peserta dipersiapkan untuk bekerja secara profesional serta mampu bersaing di dunia kerja yang terus berkembang.'
            ],
            [
                'name' => 'Teknik Pendingin',
                'image' => 'teknik-pendingin.png',
                'description' => 'Kejuruan Teknik Pendingin di Satpel PVP Pekanbaru menawarkan program pelatihan yang dirancang untuk membekali peserta dengan keterampilan teknis di bidang instalasi, perawatan, dan perbaikan sistem pendingin. Mulai dari perawatan AC rumah tangga hingga sistem refrigerasi, pelatihan ini memberikan pengalaman praktis yang sesuai dengan standar industri. Dengan pendekatan berbasis kompetensi, peserta dipersiapkan untuk bekerja secara profesional di bidang jasa pendingin maupun industri terkait, serta mampu bersaing di dunia kerja yang terus berkembang.'
            ],
            [
                'name' => 'Bangunan',
                'image' => 'bangunan.png',
                'description' => 'Kejuruan Teknik Pendingin di Satpel PVP Pekanbaru menawarkan program pelatihan yang dirancang untuk membekali peserta dengan keterampilan teknis di bidang instalasi, perawatan, dan perbaikan sistem pendingin. Mulai dari perawatan AC rumah tangga hingga sistem refrigerasi, pelatihan ini memberikan pengalaman praktis yang sesuai dengan standar industri. Dengan pendekatan berbasis kompetensi, peserta dipersiapkan untuk bekerja secara profesional di bidang jasa pendingin maupun industri terkait, serta mampu bersaing di dunia kerja yang terus berkembang.'
            ],
            [
                'name' => 'Otomotif',
                'image' => 'otomotif.png',
                'description' => 'Kejuruan Otomotif di Satpel PVP Pekanbaru menawarkan program pelatihan yang dirancang untuk membekali peserta dengan keterampilan teknis di bidang perawatan dan perbaikan kendaraan bermotor. Mulai dari servis berkala, sistem mesin, hingga perawatan sistem kelistrikan kendaraan, pelatihan ini memberikan pengalaman praktis yang sesuai dengan standar industri. Dengan pendekatan berbasis kompetensi, peserta dipersiapkan untuk bekerja secara profesional di bengkel maupun industri otomotif, serta mampu bersaing di dunia kerja yang terus berkembang.'
            ],
            [
                'name' => 'Las',
                'image' => 'las.png',
                'description' => 'Kejuruan Las di Satpel PVP Pekanbaru menawarkan program pelatihan yang dirancang untuk membekali peserta dengan keterampilan teknis dalam berbagai teknik pengelasan. Mulai dari pengelasan dasar hingga proses las listrik dan gas, pelatihan ini memberikan pengalaman praktis yang sesuai dengan standar industri. Dengan pendekatan berbasis kompetensi, peserta dipersiapkan untuk bekerja secara profesional di bidang fabrikasi, konstruksi, maupun manufaktur, sehingga mampu bersaing di dunia kerja yang terus berkembang.'
            ],
            [
                'name' => 'TIK',
                'image' => 'TIK.webp',
                'description' => 'Kejuruan Teknologi Informasi dan Komunikasi (TIK) di Satpel PVP Pekanbaru menawarkan program pelatihan yang dirancang untuk membekali peserta dengan keterampilan teknis di bidang teknologi digital dan pengelolaan informasi. Mulai dari pengoperasian komputer, pengolahan data, hingga dasar jaringan komputer, pelatihan ini memberikan pengalaman praktis yang sesuai dengan kebutuhan industri. Dengan pendekatan berbasis kompetensi, peserta dipersiapkan untuk bekerja secara profesional di bidang teknologi informasi serta mampu bersaing di dunia kerja yang terus berkembang.'
            ],
        ];

        foreach ($departments as $dept) {
            Department::create([
                'name' => $dept['name'],
                'slug' => Str::slug($dept['name']),
                'image' => 'assets/img/kejuruan/' . $dept['image'],
                'description' => $dept['description'],
                'total_workshops' => 0,
                'status' => true
            ]);
        }
    }
}

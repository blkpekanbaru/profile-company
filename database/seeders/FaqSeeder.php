<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu Satpel PVP Pekanbaru?',
                'answer' => 'Satuan Pelayanan Pelatihan Vokasi dan Produktivitas (Satpel PVP) Pekanbaru adalah unit kerja di bawah naungan BBPVP yang fokus pada pengembangan keterampilan kerja dan produktivitas masyarakat di wilayah Pekanbaru dan sekitarnya.',
                'sort_order' => 1
            ],
            [
                'question' => 'Apa yang dimaksud dengan PBK?',
                'answer' => 'PBK adalah Pelatihan Berbasis Kompetensi, yaitu pelatihan yang menitikberatkan pada penguasaan kemampuan kerja yang mencakup pengetahuan, keterampilan, dan sikap sesuai dengan standar yang ditetapkan.',
                'sort_order' => 2
            ],
            [
                'question' => 'Apakah ada biaya yang harus dikeluarkan masyarakat untuk mengikuti pelatihan?',
                'answer' => 'Seluruh biaya pelatihan di Satpel PVP Pekanbaru ditanggung oleh negara (GRATIS). Masyarakat tidak dipungut biaya apapun mulai dari pendaftaran hingga selesai pelatihan.',
                'sort_order' => 3
            ],
            [
                'question' => 'Apa saja persyaratan untuk menjadi peserta pelatihan di Satpel PVP Pekanbaru?',
                'answer' => 'Persyaratan umum meliputi: Warga Negara Indonesia (WNI), usia minimal 18 tahun, tidak sedang menempuh pendidikan formal, dan memiliki akun SIAPkerja.',
                'sort_order' => 4
            ],
            [
                'question' => 'Bagaimana Cara Membuat Akun SIAPkerja?',
                'answer' => 'Buka situs kemnaker.go.id, klik daftar, lalu isi data diri sesuai KTP, alamat email aktif, dan nomor handphone. Lakukan verifikasi melalui email untuk mengaktifkan akun.',
                'sort_order' => 5
            ],
            [
                'question' => 'Bagaimana proses seleksi pelatihan di Satpel PVP Pekanbaru?',
                'answer' => 'Proses seleksi terdiri dari seleksi administrasi secara online, tes tertulis (substantif), dan sesi wawancara untuk melihat motivasi serta kesiapan calon peserta.',
                'sort_order' => 6
            ],
            [
                'question' => 'Apa saja fasilitas yang diperoleh peserta pelatihan?',
                'answer' => 'Peserta akan mendapatkan konsumsi, pakaian kerja, ATK, modul pelatihan, asuransi (selama pelatihan), dan uang saku harian.',
                'sort_order' => 7
            ],
            [
                'question' => 'Apa yang dimaksud dengan kelas Boarding dan Non-Boarding?',
                'answer' => 'Kelas Boarding diperuntukkan bagi peserta dari luar kota yang disediakan asrama dan makan selama pelatihan. Sedangkan Non-Boarding diperuntukkan bagi peserta lokal yang tidak menginap.',
                'sort_order' => 8
            ],
            [
                'question' => 'Apa yang diperoleh peserta setelah lulus pelatihan dan sertifikasi?',
                'answer' => 'Peserta yang lulus akan mendapatkan Sertifikat Pelatihan dari Satpel PVP Pekanbaru dan Sertifikat Kompetensi dari BNSP jika dinyatakan kompeten pada uji kompetensi.',
                'sort_order' => 9
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

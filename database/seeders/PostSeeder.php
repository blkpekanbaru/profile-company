<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Enums\PostStatusEnum;
use App\Enums\PostCategoryEnum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'BLK Membuka Pendaftaran Pelatihan Berbasis Kompetensi 2026',
                'categories' => [PostCategoryEnum::NEWS, PostCategoryEnum::TRAINING],
                'content' => 'Lembaga Pelatihan Kerja (BLK) kembali membuka pendaftaran untuk berbagai kejuruan di tahun anggaran 2026. Program ini bertujuan untuk meningkatkan skill masyarakat agar siap bersaing di dunia industri',
                'status' => PostStatusEnum::PUBLISHED,
            ],
            [
                'title' => 'Jadwal Tes Seleksi Tahap I Kejuruan Teknik Informatika',
                'categories' => [PostCategoryEnum::ANNOUNCEMENT],
                'content' => 'Diberitahukan kepada seluruh calon peserta yang telah mendaftar kejuruan TI, tes seleksi akan dilaksanakan pada hari Senin depan pukul 08.00 WIB di Lab Komputer 1',
                'status' => PostStatusEnum::PUBLISHED,
            ],
            [
                'title' => 'Libur Nasional dan Cuti Bersama Februari 2026',
                'categories' => [PostCategoryEnum::ANNOUNCEMENT, PostCategoryEnum::NEWS],
                'content' => 'Sehubungan dengan hari libur nasional, seluruh kegiatan pelatihan ditiadakan sementara dan akan dimulai kembali pada tanggal yang telah ditentukan',
                'status' => PostStatusEnum::PUBLISHED,
            ],
        ];

        foreach ($posts as $item) {
            $post = Post::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']) . '-' . rand(100, 999),
                'content' => $item['content'],
                'status' => $item['status']
            ]);

            // 2. Simpan Label ke tabel pivot 'post_category_labels'
            foreach ($item['categories'] as $category) {
                $post->categories()->create([
                    'category' => $category
                ]);
            }

            $post->images()->create([
                'path' => 'assets/img/posts/blk-3d.jpg'
            ]);
        }
    }
}

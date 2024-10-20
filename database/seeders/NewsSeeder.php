<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsCategory::create([
            'name' => 'Berita Sekolah',
            'slug' => 'berita-sekolah',
            'description' => 'Berita-berita terbaru dari MAN 1 Padang Panjang',
            'meta_title' => 'Berita Sekolah',
            'meta_description' => 'Berita-berita terbaru dari MAN 1 Padang Panjang',
            'meta_keywords' => 'berita, berita terbaru, berita MAN 1 Padang Panjang, berita sekolah, berita terbaru, Padang Panjang',
        ]);

        NewsCategory::create([
            'name' => 'Pengumuman',
            'slug' => 'pengumuman',
            'description' => 'Pengumuam-pengumuman terbaru dari MAN 1 Padang Panjang',
            'meta_title' => 'Pengumuman',
            'meta_description' => 'Pengumuam-pengumuman terbaru dari MAN 1 Padang Panjang',
            'meta_keywords' => 'pengumuman, pengumuman terbaru, pengumuman, MAN 1 Padang Panjang, pengumuman sekolah, pengumuman terbaru, Padang Panjang',
        ]);

        News::create([
            'title' => 'Selamat Data Siswa Baru TA 2023/2024',
            'slug' => 'selamat-datang-siswa-baru-ta-2023-2024',
            'category_id' => 1,
            'user_id' => 1,
            'status' => 'published',
            'content' => '<p>Selamat datang siswa baru TA 2023/2024, semoga menjadi siswa yang berprestasi dan berbudi pekerti luhur.</p>',
            'meta_title' => 'Selamat Data Siswa Baru TA 2023/2024',
            'meta_description' => 'Selamat datang siswa baru TA 2023/2024, semoga menjadi siswa yang berprestasi dan berbudi pekerti luhur.',
            'meta_keywords' => 'siswa baru, siswa, siswa baru, MAN 1 Padang Panjang',
        ]);

        News::create([
            'title' => 'MAN 1 Padang Panjang Raih Juara 1 Lomba Sekolah Sehat',
            'slug' => 'man-1-padang-panjang-raih-juara-1-lomba-sekolah-sehat',
            'category_id' => 1,
            'user_id' => 1,
            'status' => 'published',
            'content' => '<p> MAN 1 Padang Panjang berhasil meraih juara 1 lomba sekolah sehat tingkat nasional, semoga prestasi ini dapat terus dipertahankan.</p>',
            'meta_title' => 'MAN 1 Padang Panjang Raih Juara 1 Lomba Sekolah Sehat',
            'meta_description' => 'MAN 1 Padang Panjang berhasil meraih juara 1 lomba sekolah sehat tingkat nasional, semoga prestasi ini dapat terus dipertahankan.',
            'meta_keywords' => 'juara 1, lomba sekolah sehat, MAN 1 Padang Panjang',
        ]);

        News::create([
            'title' => 'Pengumuman Ujian Akhir Semester Genap',
            'slug' => 'pengumuman-ujian-akhir-semester-genap',
            'category_id' => 2,
            'user_id' => 1,
            'status' => 'published',
            'content' => '<p>Pengumuman Ujian Akhir Semester Genap akan dilaksanakan pada tanggal 20 Juni 2024, jangan lupa belajar dengan sungguh-sungguh.</p>',
            'meta_title' => 'Pengumuman Ujian Akhir Semester Genap',
            'meta_description' => 'Pengumuman Ujian Akhir Semester Genap akan dilaksanakan pada tanggal 20 Juni 2024, jangan lupa belajar dengan sungguh-sungguh.',
            'meta_keywords' => 'pengumuman, ujian akhir semester, genap',
        ]);

        News::create([
            'title' => 'Pengumuman Penerimaan Siswa Baru TA 2024/2025',
            'slug' => 'pengumuman-penerimaan-siswa-baru-ta-2024-2025',
            'category_id' => 2,
            'user_id' => 1,
            'content' => '<p>Pengumuman Penerimaan Siswa Baru TA 2024/2025 akan dilaksanakan pada tanggal 20 Juli 2024, jangan lupa mendaftar.</p>',
            'meta_title' => 'Pengumuman Penerimaan Siswa Baru TA 2024/2025',
            'meta_description' => 'Pengumuman Penerimaan Siswa Baru TA 2024/2025 akan dilaksanakan pada tanggal 20 Juli 2024, jangan lupa mendaftar.',
            'meta_keywords' => 'pengumuman, penerimaan siswa baru, TA 2024/2025',
        ]);

        NewsComment::create([
            'name' => 'User Test 1',
            'email' => 'test1@example.com',
            'comment' => 'Wah Berita yang sangat bagus, semangat terus ya, Jangan lupa belajar dengan sungguh-sungguh ya teman-teman semua, figghhtttttttt !!!',
            'status' => 'approved',
            'news_id' => 1,
        ]);

        NewsComment::create([
            'name' => 'User Test 2',
            'email' => 'test2@example.com',
            'comment' => 'terima kasih atas informasinya yang sangat bermanfaat sekali, semangat terus ya teman-teman semua !!!, jangan lupa belajar dengan sungguh-sungguh ya teman-teman semua !!!, GAMBATTE !!!, FIGHTING !!!, SEMANGAT !!!, SEMANGAT !!!, SEMANGAT !!!',
            'status' => 'approved',
            'news_id' => 1,
        ]);

        NewsComment::create([
            'name' => 'User Test 2',
            'email' => 'test2@example.com',
            'comment' => 'Apapun dimana pun, kapan pun, kita harus tetap semangat, ketika kita semangat, maka kita akan menjadi pemenang, semangat teman-teman semua !!!, FIGHTING !!!, SEMANGAT !!!, SEMANGAT !!!, SEMANGAT !!!',
            'status' => 'approved',
            'news_id' => 2,
        ]);

        NewsComment::create([
            'name' => 'Office Gariskode',
            'email' => 'office@gariskode.com',
            'comment' => 'terima kasih atas kerjasamanya, semoga kita dapat terus bekerja sama dengan baik, saya dari office gariskode mengucapkan terima kasih atas kerjasamanya, semoga kita dapat terus bekerja sama dengan baik, semangat teman-teman semua !!!',
            'status' => 'approved',
            'news_id' => 1,
            'user_id' => 1,
        ]);


    }
}

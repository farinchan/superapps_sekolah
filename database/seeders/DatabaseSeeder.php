<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Extracurricular;
use App\Models\SekapurSirih;
use App\Models\SettingBanner;
use App\Models\SettingWebsite;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $admin =  Role::create(['name' => 'admin']);
        $kepsek =  Role::create(['name' => 'kepsek']);
        $guru =  Role::create(['name' => 'guru']);
        $guru_bk =  Role::create(['name' => 'guru_bk']);
        $bendahara =  Role::create(['name' => 'bendahara']);
        $staff =  Role::create(['name' => 'staff']);
        $siswa =  Role::create(['name' => 'siswa']);
        $orangtua =  Role::create(['name' => 'orangtua']);

        user::create([
            'email' => 'fajri@gariskode.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');


        SettingWebsite::create([
            'name' => 'MAN 1 Padang Panjang',
            'logo' => 'setting/logo.png',
            'favicon' => 'setting/favicon.png',
            'email' => 'info@man1kotapadangpanjang.sch.id',
            'phone' => '-',
            'address' => '-',
            'latitude' => '-0.45620075799254894',
            'longitude' => '100.42101383650129',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'twitter' => 'https://twitter.com',
            'youtube' => 'https://youtube.com',
            'whatsapp' => 'https://whatsapp.com',
            'telegram' => 'https://telegram.com',
            'linkedin' => 'https://linkedin.com',
            'about' => 'MAN 1 Padang Panjang adalah Madrasah Aliyah yang berada di Kota Padang Panjang, Sumatera Barat.',
        ]);

        SettingBanner::create([
            'title' => 'Website Resmi',
            'subtitle' => 'MAN 1 Padang Panjang',
            'image' => 'banner/1729394266_man1.png',
            'url' => 'https://gariskode.com',
            'status' => 1,
        ]);

        $this->call([
            NewsSeeder::class,
        ]);

        User::factory(15)->create()->each(function ($user) {
            $user->assignRole('guru');
        });

        for ($i = 2; $i <= 15; $i++) {
            Teacher::factory()->create([
                'user_id' => $i,
            ]);
        }

        Event::factory(10)->create();

        Extracurricular::create([
            'name' => 'MPK',
            'slug' => 'mpk',
            'description' => 'Majelist Pimpinan Kelas adalah wadan kelas yang bertugas mengatur kegiatan kelas.',
            'image' => 'extracurricular/example.png',
        ]);

        Extracurricular::create([
            'name' => 'OSIM',
            'slug' => 'osim',
            'description' => 'Organisasi Siswa Intra Madrasah adalah organisasi yang bertugas mengatur kegiatan ekstrakurikuler.',
            'image' => 'extracurricular/example.png',
        ]);

        Extracurricular::create([
            'name' => 'Dewan Ambalan',
            'slug' => 'dewan-ambalan',
            'description' => 'Dewan Ambalan adalah dewan yang bertugas mengatur kegiatan kepramukaan.',
            'image' => 'extracurricular/example.png',
        ]);

        Extracurricular::create([
            'name' => 'PIK-R',
            'slug' => 'pik-r',
            'description' => 'PIK-R Adalahh ........',
            'image' => 'extracurricular/example.png',
        ]);

        Extracurricular::create([
            'name' => 'Sispala',
            'slug' => 'sispala',
            'description' => 'Sispala adalah organisasi siswa pecinta alam ........',
            'image' => 'extracurricular/example.png',
        ]);

        Extracurricular::create([
            'name' => 'UKS',
            'slug' => 'uks',
            'description' => 'UKS adalah unit kesehatan sekolah yang bertugas mengatur kegiatan kesehatan.',
            'image' => 'extracurricular/example.png',
        ]);

        Extracurricular::create([
            'name' => 'PMR',
            'slug' => 'pmr',
            'description' => 'Palang Merah Remaja adalah organisasi yang bertugas mengatur kegiatan kemanusiaan.',
            'image' => 'extracurricular/example.png',
        ]);

        Extracurricular::create([
            'name' => 'KIR dan Riset',
            'slug' => 'kir-dan-riset',
            'description' => 'KIR dan Riset adalah kegiatan yang bertujuan untuk mengembangkan minat dan bakat siswa.',
            'image' => 'extracurricular/example.png',
        ]);

        Extracurricular::create([
            'name' => 'ER (robotic)',
            'slug' => 'er-robotic',
            'description' => 'ER (robotic) adalah kegiatan ......',
            'image' => 'extracurricular/example.png',
        ]);

        SekapurSirih::create([
            'image' => 'sekapur_sirih/sekapur_sirih.png',
            'content' => '<h6> Assalamu\'alaikum Wr. Wb. </h6> <p> Selamat datang di website MAN 1 Padang Panjang. Semoga dengan adanya website ini, kita dapat lebih mudah dalam mendapatkan informasi seputar kegiatan sekolah. </p> <p> Terima kasih. Wassalamu\'alaikum Wr. Wb. </p>',
        ]);
    }
}

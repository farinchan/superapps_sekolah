<?php

namespace Database\Seeders;

use App\Models\SettingBanner;
use App\Models\SettingWebsite;
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
        $guru =  Role::create(['name' => 'guru']);
        $siswa =  Role::create(['name' => 'siswa']);

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
            'title' => 'MAN 1 Padang Panjang Membuka Pendaftaran Siswa Baru',
            'subtitle' => 'Pendaftaran Siswa Baru Tahun Ajaran 2024/2025 Telah Dibuka',
            'image' => 'banner/1.png',
            'url' => 'https://gariskode.com',
            'status' => 1,
        ]);
    }
}

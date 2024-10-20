<?php

namespace Database\Seeders;

use App\Models\Event;
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
    }
}

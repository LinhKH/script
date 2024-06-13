<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('admin')->insert([
            'admin_name' => 'Site Admin',
            'admin_email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('123456'),
        ]);

        DB::table('general_settings')->insert([
            'com_name' => 'YahooBaba Tour Travel',
            'com_logo' => 'logo.png',
            'com_email' => 'company@email.com',
            'com_phone' => '0987654321',
            'address' => '9978,USA',
            'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum you need to be sure there isnt anything embarrassing hidden in the middle of text.',
            'footer_copyright' => 'Copyright © 2023-2024',
            'cur_format' => '$',
        ]);

        DB::table('banner')->insert([
            'title' => 'Curabitur elementum erat pellentesque convallis lacinia',
            'sub_title' => 'Lorem Ipsum is simply dummy text Lorem Ipsum.',
            'image' => 'banner.jpg',
        ]);
    }
}

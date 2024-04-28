<?php

namespace Database\Seeders;

use App\Models\ChildPost;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChildPostSeeder extends Seeder
{
    public function run()
    {
        ChildPost::create([
            'uuid' => '1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p',
            'slug' => 'intro-to-programming',
            'author' => 'iqbal',
            'judul' => 'Introduction to Programming',
            'konten' => 'lorem ipsum',
            'image_path' => 'images/intro-to-programming.jpg',
        ]);

        ChildPost::create([
            'uuid' => '1b2c3d4e-5f6g-7h8i-9j0k-1l2m3n4o5p6q',
            'slug' => 'web-design-basics',
            'author' => 'iqbul',
            'judul' => 'Web Design Basics',
            'konten' => 'lorem ipsum',
            'image_path' => 'images/web-design-basics.jpg',
        ]);

        // Tambahkan sebanyak yang Anda inginkan
    }
}

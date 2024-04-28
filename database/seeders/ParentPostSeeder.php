<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ParentPost;
use Illuminate\Database\Seeder;

class ParentPostSeeder extends Seeder
{
    public function run()
    {
        ParentPost::create([
            'uuid' => '1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p',
            'slug' => 'programming-basics',
            'judul' => 'Programming Basics',
            'image_path' => 'images/programming-basics.jpg',
            'category_uuid' => '1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p', // Sesuaikan dengan UUID kategori yang sudah ada
        ]);

        ParentPost::create([
            'uuid' => '1b2c3d4e-5f6g-7h8i-9j0k-1l2m3n4o5p6q',
            'slug' => 'web-development',
            'judul' => 'Web Development',
            'image_path' => 'images/web-development.jpg',
            'category_uuid' => '1b2c3d4e-5f6g-7h8i-9j0k-1l2m3n4o5p6q', // Sesuaikan dengan UUID kategori yang sudah ada
        ]);

        // Tambahkan sebanyak yang Anda inginkan
    }
}

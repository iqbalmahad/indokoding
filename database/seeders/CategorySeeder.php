<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'uuid' => '1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p',
            'slug' => 'programming',
            'judul' => 'Programming',
        ]);

        Category::create([
            'uuid' => '1b2c3d4e-5f6g-7h8i-9j0k-1l2m3n4o5p6q',
            'slug' => 'technology',
            'judul' => 'Technology',
        ]);

        // Tambahkan sebanyak yang Anda inginkan
    }
}

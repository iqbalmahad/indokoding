<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChildPostParentPostSeeder extends Seeder
{
    public function run()
    {
        DB::table('child_post_parent_post')->insert([
            [
                'uuid' => Uuid::uuid4()->toString(),
                'parent_post_uuid' => '1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p', // UUID dari parent_post yang sudah ada
                'child_post_uuid' => '1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p', // UUID dari child_post yang sudah ada
            ],
            [
                'uuid' => Uuid::uuid4()->toString(),
                'parent_post_uuid' => '1b2c3d4e-5f6g-7h8i-9j0k-1l2m3n4o5p6q', // UUID dari parent_post yang sudah ada
                'child_post_uuid' => '1b2c3d4e-5f6g-7h8i-9j0k-1l2m3n4o5p6q', // UUID dari child_post yang sudah ada
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);
    }
}

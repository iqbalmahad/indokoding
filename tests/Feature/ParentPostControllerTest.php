<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParentPostControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStoreParentPostWithImage(): void
    {
        $this->post('/api/postparents',)
            ->assertStatus(200);
    }


    public function testStoreParentPostWithoutImage(): void
    {
        $response = $this->postJson('/api/parentposts', [
            'slug' => 'test-slug',
            'judul' => 'Test Judul',
            'category_id' => 1, // Ganti dengan id kategori yang valid
        ]);

        $response->assertStatus(422) // Memastikan respons status 422 (Unprocessable Entity) karena gambar tidak diunggah
            ->assertJsonStructure(['errors' => ['img']]); // Memastikan respons memiliki struktur yang diharapkan untuk error validasi img
    }
}

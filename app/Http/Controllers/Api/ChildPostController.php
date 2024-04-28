<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ChildPostController extends Controller
{
    public function index()
    {
        $childPosts = DB::table('child_posts')
            ->select('child_posts.*', 'parent_posts.judul as parent_judul')
            ->leftJoin('child_post_parent_post', 'child_posts.uuid', '=', 'child_post_parent_post.child_post_uuid')
            ->leftJoin('parent_posts', 'child_post_parent_post.parent_post_uuid', '=', 'parent_posts.uuid')
            ->get();
        return response()->json($childPosts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|string|max:255|unique:child_posts',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Menambah validasi untuk gambar
            'author' => 'required|string',
            'parent_post_uuid' => 'required|exists:parent_posts,uuid',
        ], [
            'slug.required' => 'Slug harus diisi.',
            'slug.unique' => 'Slug sudah digunakan.',
            'judul.required' => 'Judul harus diisi.',
            'konten.required' => 'Konten harus diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang diterima adalah jpeg, png, jpg, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimum adalah 2MB.',
            'author.required' => 'Penulis harus diisi.',
            'parent_post_uuid.required' => 'Parent post UUID harus diisi.',
            'parent_post_uuid.exists' => 'Parent post UUID tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $uuid = Uuid::uuid4()->toString(); // Menghasilkan UUID Versi 4 secara acak

            // Simpan gambar jika ada
            if ($request->hasFile('gambar')) {
                $imagePath = $request->file('gambar')->store('public/images');
                $imageUrl = Storage::url($imagePath);
            } else {
                $imageUrl = null;
            }

            DB::table('child_posts')->insert([
                'uuid' => $uuid,
                'slug' => $request->slug,
                'judul' => $request->judul,
                'konten' => $request->konten,
                'image_path' => $imageUrl, // Simpan URL gambar jika ada
                'author' => $request->author,
                'parent_post_uuid' => $request->parent_post_uuid,
            ]);

            // Mengambil data berdasarkan slug setelah menyimpan
            $childPost = DB::table('child_posts')->where('slug', $request->slug)->first();

            return response()->json(['message' => 'Childpost created successfully', 'data' => $childPost]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function show($slug)
    {
        $childPost = DB::table('child_posts')
            ->select('child_posts.*', 'parent_posts.judul as parent_judul')
            ->leftJoin('child_post_parent_post', 'child_posts.uuid', '=', 'child_post_parent_post.child_post_uuid')
            ->leftJoin('parent_posts', 'child_post_parent_post.parent_post_uuid', '=', 'parent_posts.uuid')
            ->where('child_posts.slug', $slug)
            ->first();
        if (!$childPost) {
            return response()->json(['error' => 'Childpost not found'], 404);
        }
        return response()->json($childPost);
    }

    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Menambah validasi untuk gambar
            'author' => 'required|string',
            'parent_post_uuid' => 'required|exists:parent_posts,uuid',
        ], [
            'judul.required' => 'Judul harus diisi.',
            'konten.required' => 'Konten harus diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang diterima adalah jpeg, png, jpg, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimum adalah 2MB.',
            'author.required' => 'Penulis harus diisi.',
            'parent_post_uuid.required' => 'Parent post UUID harus diisi.',
            'parent_post_uuid.exists' => 'Parent post UUID tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $childPost = DB::table('child_posts')->where('uuid', $uuid)->first();
            if (!$childPost) {
                return response()->json(['error' => 'Childpost not found'], 404);
            }

            // Update data
            $updateData = [
                'judul' => $request->judul,
                'konten' => $request->konten,
                'author' => $request->author,
                'parent_post_uuid' => $request->parent_post_uuid,
            ];

            // Update gambar jika ada
            if ($request->hasFile('gambar')) {
                $imagePath = $request->file('gambar')->store('public/images');
                $imageUrl = Storage::url($imagePath);
                $updateData['image_path'] = $imageUrl; // Simpan URL gambar jika ada
            }

            DB::table('child_posts')->where('uuid', $uuid)->update($updateData);

            // Mengambil data setelah update
            $updatedChildpost = DB::table('child_posts')->where('uuid', $uuid)->first();

            return response()->json(['message' => 'Childpost updated successfully', 'data' => $updatedChildpost]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($uuid)
    {
        $childPost = DB::table('child_posts')->where('uuid', $uuid)->first();
        if (!$childPost) {
            return response()->json(['error' => 'Childpost not found'], 404);
        }

        DB::table('child_posts')->where('uuid', $uuid)->delete();

        return response()->json(['message' => 'Childpost deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ParentPostController extends Controller
{
    public function index()
    {
        try {
            $parent_posts = DB::table('parent_posts')->get();
            return response()->json($parent_posts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|string|max:255|unique:parent_posts',
            'judul' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Menambah validasi untuk gambar
            'category_id' => 'required', //required|exists:categories,id nanti ganti pake ini
        ], [
            'slug.required' => 'Slug harus diisi.',
            'slug.unique' => 'Slug sudah digunakan.',
            'judul.required' => 'Judul harus diisi.',
            'img.required' => 'Gambar harus diunggah.',
            'img.image' => 'File harus berupa gambar.',
            'img.mimes' => 'Format gambar yang diterima adalah jpeg, png, jpg, atau gif.',
            'img.max' => 'Ukuran gambar maksimum adalah 2MB.',
            // 'category_id.required' => 'Kategori harus dipilih.',
            // 'category_id.exists' => 'Kategori tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $uuid = Uuid::uuid4()->toString(); // Menghasilkan UUID Versi 4 secara acak

            // Simpan gambar
            $imagePath = $request->file('img')->store('public/images');
            $imageUrl = Storage::url($imagePath);

            DB::table('parent_posts')->insert([
                'uuid' => $uuid,
                'slug' => $request->slug,
                'judul' => $request->judul,
                'image_path' => $imageUrl, // Simpan URL gambar
                'category_id' => $request->category_id,
            ]);

            // Mengambil data berdasarkan slug setelah menyimpan
            $parentpost = DB::table('parent_posts')->where('slug', $request->slug)->first();

            return response()->json(['message' => 'Parentpost created successfully', 'data' => $parentpost]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function show($slug)
    {
        try {
            $parentpost = DB::table('parent_posts')->where('slug', $slug)->first();

            if (!$parentpost) {
                return response()->json(['error' => 'Parentpost not found'], 404);
            }

            return response()->json($parentpost);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($uuid)
    {
        try {
            $parentpost = DB::table('parent_posts')->where('uuid', $uuid)->first();

            if (!$parentpost) {
                return response()->json(['error' => 'Parent post not found'], 404);
            }

            return response()->json(['data' => $parentpost]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('parent_posts')->ignore($uuid, 'uuid'), // Mengabaikan UUID saat validasi unique
            ],
            'judul' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Menambah validasi untuk gambar
            'category_id' => 'required', //required|exists:categories,id nanti ganti pake ini
        ], [
            'slug.required' => 'Slug harus diisi.',
            'slug.unique' => 'Slug sudah digunakan.',
            'judul.required' => 'Judul harus diisi.',
            'img.image' => 'File harus berupa gambar.',
            'img.mimes' => 'Format gambar yang diterima adalah jpeg, png, jpg, atau gif.',
            'img.max' => 'Ukuran gambar maksimum adalah 2MB.',
            // 'category_id.required' => 'Kategori harus dipilih.',
            // 'category_id.exists' => 'Kategori tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            // Cek apakah UUID yang dimasukkan valid
            $parentpost = DB::table('parent_posts')->where('uuid', $uuid)->first();
            if (!$parentpost) {
                return response()->json(['error' => 'Parent post not found'], 404);
            }

            // Update data parent post
            $dataToUpdate = [
                'slug' => $request->slug,
                'judul' => $request->judul,
                'category_id' => $request->category_id,
            ];

            // Jika ada gambar yang diunggah, update juga URL gambar
            if ($request->hasFile('img')) {
                // Simpan gambar baru
                $imagePath = $request->file('img')->store('public/images');
                $imageUrl = Storage::url($imagePath);
                $dataToUpdate['image_path'] = $imageUrl;
            }

            // Lakukan update
            DB::table('parent_posts')->where('uuid', $uuid)->update($dataToUpdate);

            // Ambil data setelah diupdate
            $updatedParentPost = DB::table('parent_posts')->where('uuid', $uuid)->first();

            return response()->json(['message' => 'Parent post updated successfully', 'data' => $updatedParentPost]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    public function destroy($uuid)
    {
        try {
            $deleted = DB::table('parent_posts')->where('uuid', $uuid)->delete();

            if ($deleted) {
                return response()->json(['message' => 'Parentpost deleted successfully']);
            } else {
                return response()->json(['error' => 'Parentpost not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        try {
            return response()->json(['categories' => $categories], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $uuid = Uuid::uuid4()->toString(); // Menghasilkan UUID Versi 4 secara acak
        DB::table('categories')->insert([
            'uuid' => $uuid,
            'judul' => $request->judul,
            'slug' => $request->slug,
        ]);

        $category = DB::table('categories')->where('slug', $request->slug)->first();

        return response()->json(['category' => $category], 201);
    }

    public function show($slug)
    {
        try {
            $parentpost = DB::table('categories')->where('slug', $slug)->first();

            if (!$parentpost) {
                return response()->json(['error' => 'Category not found'], 404);
            }

            return response()->json($parentpost);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $affected = DB::table('categories')
            ->where('uuid', $uuid)
            ->update([
                'judul' => $request->judul,
                'slug' => $request->slug,
            ]);

        if ($affected) {
            $category = DB::table('categories')->find($uuid);
            return response()->json(['category' => $category], 200);
        }

        return response()->json(['error' => 'Category not found'], 404);
    }

    public function destroy($uuid)
    {
        try {
            // Periksa apakah ada parent_posts yang terkait dengan kategori yang akan dihapus
            $parentPostsExist = DB::table('parent_posts')->where('category_uuid', $uuid)->exists();

            if ($parentPostsExist) {
                return response()->json(['error' => 'Cannot delete category, it is still related to parentposts'], 400);
            }

            // Jika tidak ada parent_posts yang terkait, lanjutkan untuk menghapus kategori
            $deleted = DB::table('categories')->where('uuid', $uuid)->delete();

            if ($deleted) {
                return response()->json(['message' => 'Category deleted successfully'], 200);
            } else {
                return response()->json(['error' => 'Category not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\Guest;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    public function indexKategori()
    {
        $categories = DB::table('categories')->get();
        try {
            return response()->json(['categories' => $categories], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showKategori($slug)
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

    public function indexParent()
    {
        try {
            $parent_posts = DB::table('parent_posts')->get();
            return response()->json($parent_posts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showParent($slug)
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

    public function indexChild()
    {
        $childposts = DB::table('child_posts')->get();
        return response()->json($childposts);
    }

    public function showChild($slug)
    {
        $childpost = DB::table('child_posts')->where('slug', $slug)->first();
        if (!$childpost) {
            return response()->json(['error' => 'Childpost not found'], 404);
        }
        return response()->json($childpost);
    }
}

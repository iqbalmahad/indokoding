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
            $parentPosts = DB::table('parent_posts')
                ->select('parent_posts.*', 'child_posts.judul as child_judul')
                ->leftJoin('child_post_parent_post', 'parent_posts.uuid', '=', 'child_post_parent_post.parent_post_uuid')
                ->leftJoin('child_posts', 'child_post_parent_post.child_post_uuid', '=', 'child_posts.uuid')
                ->get();
            return response()->json($parentPosts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showParent($slug)
    {
        try {
            $parentPost = DB::table('parent_posts')
                ->select('parent_posts.*', 'child_posts.judul as child_judul')
                ->leftJoin('child_post_parent_post', 'parent_posts.uuid', '=', 'child_post_parent_post.parent_post_uuid')
                ->leftJoin('child_posts', 'child_post_parent_post.child_post_uuid', '=', 'child_posts.uuid')
                ->where('parent_posts.slug', $slug)
                ->first();

            if (!$parentPost) {
                return response()->json(['error' => 'Parentpost not found'], 404);
            }

            return response()->json($parentPost);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function indexChild()
    {
        $childPosts = DB::table('child_posts')
            ->select('child_posts.*', 'parent_posts.judul as parent_judul')
            ->leftJoin('child_post_parent_post', 'child_posts.uuid', '=', 'child_post_parent_post.child_post_uuid')
            ->leftJoin('parent_posts', 'child_post_parent_post.parent_post_uuid', '=', 'parent_posts.uuid')
            ->get();
        return response()->json($childPosts);
    }

    public function showChild($slug)
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
}

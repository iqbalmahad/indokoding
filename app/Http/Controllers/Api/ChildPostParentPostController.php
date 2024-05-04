<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChildPostParentPostController extends Controller
{
    public function index()
    {
        $childPostParentPosts = DB::table('child_post_parent_post')->get();
        return response()->json($childPostParentPosts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_post_uuid' => 'required|uuid',
            'child_post_uuid' => 'required|uuid',
        ]);

        $created = DB::table('child_post_parent_post')->insert([
            'parent_post_uuid' => $request->parent_post_uuid,
            'child_post_uuid' => $request->child_post_uuid,
        ]);

        if ($created) {
            return response()->json(['message' => 'ChildPostParentPost created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create ChildPostParentPost'], 500);
        }
    }

    public function destroy($id)
    {
        $deleted = DB::table('child_post_parent_post')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'ChildPostParentPost deleted successfully']);
        } else {
            return response()->json(['error' => 'ChildPostParentPost not found'], 404);
        }
    }
}

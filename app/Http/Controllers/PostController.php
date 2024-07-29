<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Website;

class PostController extends Controller
{
    public function store(Request $request, $websiteId) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $website = Website::findOrFail($websiteId);

        $post = $website->posts()->create($request->only(['title', 'description']));

        return response()->json([
            "message" => "New Post added",
            "post" => $post,
        ], 201);
    }
}

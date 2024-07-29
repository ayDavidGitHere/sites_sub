<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Website;

class WebsiteController extends Controller
{
    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        $website = Website::create($request->all());

        return response()->json([
            "message" => "Website created successfully", 
            "website" => $website,
        ], 201);
    }

    public function index() {
        $websites = Website::all();

        return response()->json([
            "websites" => $websites
        ]);
    }

    public function getPosts($websiteId) {
        $website = Website::findOrFail($websiteId);
        $posts = $website->posts;  

        return response()->json($posts);
    }
}

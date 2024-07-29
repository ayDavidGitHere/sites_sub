<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;

class SubscriptionController extends Controller
{
    public function store(Request $request, String $websiteId) {
        $request->validate(['email' => 'required|email|max:255']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'User with this email does not exist.'], 404);
        }

        $website = Website::findOrFail($websiteId);

        $subscription = Subscription::where([
            'user_id' => $user->id,
            'website_id' => $website->id,
        ])->first();
        if ($subscription) {
            return response()->json(['message' => 'User is already subscribed to this website.'], 200);
        }

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'website_id' => $website->id,
        ]);
        
        return response()->json([
            "message" => "Website subscription successful",
            "subscription" => $subscription,
        ], 201);
    }

}

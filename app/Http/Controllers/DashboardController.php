<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $currentUser = Auth::user();
        $latestPosts = Post::latest()->take(5)->get();

        return Inertia::render('Dashboard', [
            'currentUser' => $currentUser,
            'latestPosts' => $latestPosts
        ]);
    }

}

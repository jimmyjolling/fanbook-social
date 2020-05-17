<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        $id = Auth::id();
        $profile = Profile::where('user_id', $id)->first();
        $user = User::where('id', $id)->first();
        $posts = Post::orderBy('id', 'desc')->simplePaginate(2);

        return view('home', compact('profile', 'posts', 'id', 'user'));
    }
}

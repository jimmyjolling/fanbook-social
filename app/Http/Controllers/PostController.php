<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostEditRequest;

class PostController extends Controller
{

    Public function createPost(PostRequest $request) {
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->back();
    }

    Public function editPost(PostEditRequest $request) {
        $id = $request->input('post_id');
        $post = post::findOrFail($id);

        $post->update([
            'title' => $request->input('title-edit'),
            'content' => $request->input('content-edit')
        ]);

        return redirect()->back();
    }

    Public function deletePost(Request $request) {
        $post = post::findOrFail($request->input('post-id-delete'));
        $post->delete();

        return redirect()->back();
    }

    Public function myPosts($id) {
        $id = Auth::id();
        $profile = Profile::where('user_id', $id)->first();
        $posts = Post::where('user_id', $id)->orderBy('id', 'desc')->get();

        return view('profile.my-posts', compact('profile', 'posts', 'id'));
    }

    Public function like($liked_id, $liker_id)
    {
        $post_liked = Post::find($liked_id);
        $post_liker = User::find($liker_id);

        $post_liker->like($post_liked);

        return redirect()->back()->with('status', 'The post has been liked!');
    }

    Public function unlike($liked_id, $liker_id)
    {
        $post_liked = Post::find($liked_id);
        $post_liker = User::find($liker_id);

        $post_liker->unlike($post_liked);

        return redirect()->back()->with('status', 'The post has been unliked!');
    }
}

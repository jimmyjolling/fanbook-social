<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    Public function show($id) {
        $post = Post::where('id', $id)->first();
        $comments = Comment::where('post_id', $id)->get();

        return view('profile.comments', compact('post', 'comments'));
    }

    Public function store(CommentRequest $request)
    {
        $post = Post::findOrFail($request->input('post_id'));

        $comment = new Comment;
        $comment->body = $request->input('body');
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->back();
    }

    Public function edit(CommentRequest $request)
    {
        $id = $request->input('comment_id');
        $comment = Comment::findOrFail($id);

        $comment->update([
            'body' => $request->input('body'),
        ]);

        return redirect()->back()->with('status', 'Edited comment');
    }

    Public function delete(Request $request) {
        $comment = Comment::findOrFail($request->input('comment-id-delete'));
        $comment->delete();

        return redirect()->back()->with('status', 'deleted comment');
    }
}

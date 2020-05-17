<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->post_id = $post->id;

        Auth::user()->comments()->save($comment);

        return redirect()->route('top');
    }
    
    public function destroy(Request $request, Post $post, Comment $comment)
    {
        $comment->delete();        
        return redirect()->route('top');
    }
}

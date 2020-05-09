<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function create()
    {
        return view('posts/create');
    }

    public function store(Request $request) {
        $post = new Post();
        $post->content = $request->content;

        Auth::user()->posts()->save($post);

        return redirect()->route('top');
    }
}

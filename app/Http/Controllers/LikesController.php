<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikesController extends Controller
{
    public function store(Request $request, Post $post)
    {

        $like = new Like();

        $like->post_id = $post->id;

        Auth::user()->likes()->save($like);

        return redirect()->route('top');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function create()
    {
        return view('posts/create');
    }

    public function store(PostRequest $request) {
        // 画像保存
        $image_file = $request->image;

        // store('保存したいフォルダパス')で写真を保存
        $image_path = $image_file->store('public');

        $post = new Post();
        $post->content = $request->content;
        $post->image_path = str_replace('public/', '', $image_path); // フォルダ名を除外

        Auth::user()->posts()->save($post);

        return redirect()->route('top');
    }

    public function edit(Post $post) 
    {
        return view('posts/edit', ['post' => $post]);
    }

    public function update()
    {
        //
    }
}

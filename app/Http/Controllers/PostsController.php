<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPost;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    
    public function update(EditPost $request, Post $post)
    {
        // 画像が選択されている時
        if (!is_null( $request->image)) {
            // もとの画像ファイルを削除
            Storage::delete('public/' . $post->image_path);

            // 送信されたファイルを代入
            $image_file = $request->image;
            
            // store('保存したいフォルダパス')で写真を保存
            $image_path = $image_file->store('public');
            
            // image_pathカラムに新しい画像ファイルのパスを代入
            $post->image_path = str_replace('public/', '', $image_path); // フォルダ名を除外
        }
        
        $post->content = $request->content;
        $post->save();

        return redirect()->route('top');
    }

    public function destroy(Request $request, Post $post) {
        // 画像ファイルそのものを削除
        Storage::delete('public/' . $post->image_path);

        $post->delete(); // レコード削除

        return redirect()->route('top');
    }
}

<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikesController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $is_checked = $request->checked;
        Log::info(gettype($is_checked));
        Log::info(gettype($post));
        Log::debug($request);


        // チェックの有無で削除か作成か判断
        if ($is_checked == '') {
            $like = new Like();
    
            $like->post_id = $post->id;
    
            Auth::user()->likes()->save($like);
        } else {
            $like = Auth::user()->likes()->where('post_id', $post->id);
            $like->delete();
        }


        return redirect()->route('top');
    }
}

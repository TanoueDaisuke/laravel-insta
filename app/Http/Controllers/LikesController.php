<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikesController extends Controller
{
    public function toggle(Request $request, Int $post_id)
    {
        $is_checked = $request->checked;

        // チェックの有無で削除か作成か判断
        if ($is_checked == '') {
            $like = new Like();
    
            $like->post_id = $post_id;
    
            Auth::user()->likes()->save($like);

            $is_checked = 'checked';
        } else {
            $like = Auth::user()->likes()->where('post_id', $post_id);
            $like->delete();

            $is_checked = '';
        }


        return response()->json([
            'checked' => $is_checked
        ]);
    }
}

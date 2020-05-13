<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ログインユーザーに紐づく投稿データを作成順に取得
        $posts = Post::orderBy('created_at', 'desc')->get();
        $auth_user = Auth::user();

        return view('home', [
            'posts' => $posts,
            'auth_user' => $auth_user
        ]);
    }
}

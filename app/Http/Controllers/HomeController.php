<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
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
        $posts = Auth::user()
            ->posts()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', [
            'posts' => $posts
        ]);
    }
}

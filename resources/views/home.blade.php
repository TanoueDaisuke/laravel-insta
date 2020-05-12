@extends('layouts/app')

@section('styles')
    <link href="{{ asset('/css/top.css') }}" rel="stylesheet">
@endsection

@section('content')
    @foreach($posts as $post)
        <div class="post_wrapper">
            <div class="post_top">   
                <div class="left">
                    <a href="#"><img src="{{ asset('/img/nadeshiko.png') }}" alt=""> {{-- 投稿ユーザーのアイコン --}}</a>
                    <a href="#" class="hover"><p>{{ $post->user->name }}</p></a> {{-- 投稿ユーザー名 --}}                
                </div>

                {{-- ログインユーザーの投稿 --}}
                @if ($auth_user == $post->user)
                    <div class="right">
                        <a href="{{ route('posts.edit', ['post' => $post])}}" class="first"><i class="fas fa-pen"></i></a> {{-- 投稿編集アイコン --}}
                        <a href="#"><i class="fas fa-trash-alt"></i></a> {{-- 投稿削除アイコン --}}
                    </div>
                @endif
            </div>

            {{-- <img src="{{ asset('/img/rainbow_bridge.jpg') }}" alt=""> 投稿写真 --}}
            <img src="/storage/{{$post->image_path}}" alt=""> {{-- 投稿写真 --}}

            <div class="post_bottom_wrapper">
                <div class="inner">
                    <div class="icons">                                
                        <a href="#"><i class="far fa-heart"></i></a> {{-- いいねアイコン(ハート) --}}
                        <a href="#" class="comment"><i class="far fa-comment"></i></a> {{-- コメントアイコン --}}
                    </div>
            
                    <div class="post_bottom">
                        <p><span>〇〇</span> が「いいね！」しました</p>

                        {{-- 投稿者のコメント(content) --}}
                        <p><span>{{ $post->user->name }}</span> {{ $post->content }}</p>

                        <div class="comments">
                            {{-- ここに他人からの複数のコメント表示 --}}
                            <p><span>△△</span> きれい！(例)</p>
                        </div>    
                        <p class="date">{{ $post->updated_at }}</p>            
                    </div>
                </div>
            </div>
        
            {{-- コメント作成 --}}
            <form method="GET" action="#">                
                @csrf {{-- Cross-Site Request Forgeriesの対策 --}}
                <input placeholder="コメント ..." type="text" name="message">
            </form>
        </div>
    @endforeach
@endsection
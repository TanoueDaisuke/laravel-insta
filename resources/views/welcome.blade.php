@extends('layouts/app')

@section('styles')
    <link href="{{ asset('/css/top.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="post_wrapper">
        <div class="post_top">   
            <div class="left">
                <a href="#"><img src="{{ asset('/img/nadeshiko.png') }}" alt=""> {{-- 投稿ユーザーのアイコン --}}</a>
                <a href="#" class="hover"><p>投稿ユーザー</p></a> {{-- 投稿ユーザー名 --}}                
            </div>                 
            <a href="#"><i class="fas fa-trash-alt"></i></a> {{-- 投稿削除アイコン --}}
        </div>

        <img src="{{ asset('/img/rainbow_bridge.jpg') }}" alt=""> {{-- 投稿写真 --}}

        <div class="post_bottom_wrapper">
            <div class="inner">
                <div class="icons">                                
                    <a href="#"><i class="far fa-heart"></i></a> {{-- いいねアイコン(ハート) --}}
                    <a href="#" class="comment"><i class="far fa-comment"></i></a> {{-- コメントアイコン --}}
                </div>
        
                <div class="post_bottom">
                    <p><span>〇〇</span> が「いいね！」しました</p>
                    <div class="comments">
                        {{-- ここに複数のコメント表示 --}}
                        <p><span>〇〇</span> 写真撮った！(例)</p>
                        <p><span>△△</span> きれい！(例)</p>
                    </div>    
                    <p class="date">2020-05-07 13:12:36</p>            
                </div>
            </div>
        </div>
    
        {{-- コメント作成 --}}
        <form method="GET" action="#">                
            @csrf {{-- Cross-Site Request Forgeriesの対策 --}}
            <input placeholder="コメント ..." type="text" name="message">
        </form>
    </div>
@endsection
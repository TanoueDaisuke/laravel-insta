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

                {{-- ログインユーザーの投稿のみ「編集ボタン」と「削除ボタンを表示」 --}}
                @if ($auth_user == $post->user)
                    <div class="right">
                        <a href="{{ route('posts.edit', ['post' => $post])}}"><i class="fas fa-pen"></i></a> {{-- 投稿編集アイコン --}}
                        <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button name="delete" type="button"><i class="fas fa-trash-alt"></i></button> {{-- 投稿削除アイコン --}}
                        </form>
                    </div>
                @endif

            </div>

            {{-- <img src="{{ asset('/img/rainbow_bridge.jpg') }}" alt=""> 投稿写真 --}}
            <img src="/storage/{{$post->image_path}}" alt=""> {{-- 投稿写真 --}}

            <div class="post_bottom_wrapper">
                <div class="inner">
                    <div class="icons">
                        <form action="{{ route('likes.store', ['post' => $post]) }}" method="post">
                            @csrf
                            <button>
                                {{-- 自分がいいねしていたらredクラスを i タグに与えるロジック --}}
                                {{ $red_class = '' }}
                                @foreach($post->likes as $like)                                    
                                    @if($like->user == $auth_user)
                                        <?php $red_class = 'red'; ?> {{-- redクラスは赤色にするクラス --}}
                                        @break
                                    @endif
                                @endforeach

                                <i class="far fa-heart {{$red_class}}"></i>
                            </button>  
                        </form>

                        <a href="#" class="comment"><i class="far fa-comment"></i></a> {{-- コメントアイコン --}}
                    </div>
            
                    <div class="post_bottom">
                        <?php  
                            $like_count = $post->likes->count(); // 〇〇と「他△人がいいねしました」の△
                            
                            if ($like_count >= 1) {
                                $one_liked_user = $post->likes->first()->user->name; 

                                if ($like_count == 1) {
                                    echo "<p><span>{$one_liked_user}</span> が「いいね！」しました</p>";
                                } else if ($like_count > 1 ) {
                                    echo "<p><span>{$one_liked_user}</span>, 他" . ($like_count-1) . "人が「いいね！」しました</p>";
                                }
                            } 
                        ?>

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

@section('scripts')
    <script src="{{ asset('/js/confirm_delete.js') }}"></script>
@endsection
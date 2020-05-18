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
                        <form action="{{ route('likes.toggle', ['post_id' => $post->id]) }}" method="post" data-post-id="{{ $post->id}}">
                            @csrf
                            {{-- 自分がいいねしていたらcheckedクラスを i タグに与えるロジック --}}
                            {{ $checked = '' }}
                            @foreach($post->likes as $like)                                    
                                @if($like->user == $auth_user)
                                    <?php $checked = 'checked'; ?> {{-- checkedクラスは赤色にするクラス --}}
                                    @break
                                @endif
                            @endforeach
                            
                            <input type="hidden" name="{{ $checked }}" value="{{ $checked }}">
                            <button class="like-btn" type="button">
                                @if($checked)
                                    <i class="fas fa-heart post{{$post->id}} {{$checked}}"></i>
                                @else                                
                                    <i class="far fa-heart post{{$post->id}}"></i>
                                @endif
                            </button>  
                        </form>

                        <a href="{{ route('comments.index', ['post' => $post]) }}" class="comment"><i class="far fa-comment"></i></a> {{-- コメントアイコン --}}
                    </div>
            
                    <div class="post_bottom">
                        <?php  
                            $like_count = $post->likes->count(); // 〇〇と「他△人がいいねしました」の△
                            
                            if ($like_count >= 1) {
                                $one_liked_user = $post->likes->first()->user->name; 

                                if ($like_count == 1) {
                                    echo "<p id=post{$post->id} data-like-count={$like_count} data-auth-user={$auth_user->name}><span>{$one_liked_user}</span> が「いいね！」しました</p>";
                                } else if ($like_count > 1 ) {
                                    echo "<p id=post{$post->id} data-like-count={$like_count} data-auth-user={$auth_user->name}><span>{$one_liked_user}</span>, 他" . ($like_count-1) . "人が「いいね！」しました</p>";
                                }
                            } else {
                                echo "<p id=post{$post->id} data-like-count={$like_count} data-liked-user={$auth_user->name}></p>" ;// jsで使うので空のpタグを用意
                            }
                        ?>

                        {{-- 投稿者のコメント(content) --}}
                        <p><span>{{ $post->user->name }}</span> {{ $post->content }}</p>

                        <div class="comments">
                            {{-- ここに他人からの複数のコメント表示 --}}
                            @foreach($post->comments as $comment)
                                <div class="line_comment" id="comment{{$comment->id}}">
                                    <p><span>{{$comment->user->name}}</span> {{$comment->message}}</p> {{--１つのコメント --}}
    
                                    {{-- コメント投稿者がログインユーザーなら削除できるようにする --}}
                                    @if($comment->user == $auth_user)                                
                                        <form action="{{ route('comments.destroy', ['post' => $post, 'comment' => $comment]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button name="delete" type="button"><i class="fas fa-times js-comment-delete" data-comment-id="{{$comment->id}}"></i></button> {{-- 投稿削除アイコン --}}
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>    
                        <p class="date">{{ $post->updated_at }}</p>            
                    </div>
                </div>
            </div>
        
            {{-- コメント作成 --}}
            <form class="comment_post" method="POST" action="{{ route('comments.store', ['post' => $post]) }}">                
                @csrf {{-- Cross-Site Request Forgeriesの対策 --}}
                <input placeholder="コメント ..." type="text" name="message" required>
                <button disabled>送信</button>
            </form>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script src="{{ asset('/js/confirm_delete.js') }}"></script>
    <script src="{{ asset('/js/handle_like.js') }}"></script>
    <script src="{{ asset('/js/handle_comment.js') }}"></script>
@endsection
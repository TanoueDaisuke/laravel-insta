@extends('layouts/app')

@section('styles')
    <link href="{{ asset('/css/comments/main.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="post_wrapper">
        <img src="/storage/{{$post->image_path}}" alt=""> {{-- 投稿写真 --}}

        <div class="post_right">
            <div class="profile">
                <a href="#"><img src="{{ asset('/img/nadeshiko.png') }}" alt=""> {{-- 投稿ユーザーのアイコン --}}</a>
                <a href="#" class="hover"><p>{{ $post->user->name }}</p></a> {{-- 投稿ユーザー名 --}}                
            </div>

            <div class="comments">
                <p class="auther_post"><span>{{ $post->user->name }}</span> {{ $post->content }}</p>

                <div class="other_comments">
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
            </div>

            <div class="icon_form_wrap">
                <div class="icon_wrap">
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
    
                        <a href="#" class="comment"><i class="far fa-comment"></i></a> {{-- コメントアイコン --}}
                    </div>
    
                    <div class="like_display">
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
                    </div>
                </div>

                {{-- コメント作成 --}}
                <form class="comment_post" method="POST" action="{{ route('comments.store', ['post' => $post]) }}">                
                    @csrf {{-- Cross-Site Request Forgeriesの対策 --}}
                    
                    {{-- コメント一覧ページからコメントしたら再びこのページにリダイレクトするようにする --}}
                    <input type="hidden" name="from_page" value="comments.index">

                    <input placeholder="コメント ..." type="text" name="message" required>
                    <button disabled>送信</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/confirm_delete.js') }}"></script>
    <script src="{{ asset('/js/handle_like.js') }}"></script>
    <script src="{{ asset('/js/handle_comment.js') }}"></script>
@endsection
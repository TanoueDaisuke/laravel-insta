<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>Lara Stagram</title>
</head>
<body>
<header>
    <div class="header_inner">
        <h1>
            <a href="/"><img src="https://fontmeme.com/permalink/200507/5ef500071d1e8087e12a53f96a5b3fd8.png" alt="lara stagram" border="0"></a>
        </h1>
        <nav>
            <ul>
                <li class="post_btn">
                    <a href="#">投稿</a>
                </li>
                <li class="profile_btn">
                    <a href="#"><i class="fas fa-user-alt"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
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
</main>

<footer>
    <p>Copyright &copy; HaseTano </p>
</footer>
</body>
</html>
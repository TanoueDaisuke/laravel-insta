<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    
    @yield('styles') {{-- cssの読み込み部分 --}}

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
    
    @yield('content') {{-- main部分 --}}

</main>

<footer>
    <p>Copyright &copy; HaseTano </p>
</footer>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="{{ asset('/css/auth/login.css') }}" rel="stylesheet">
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
    <div class="login_wrapper">
        <h2><img src="https://fontmeme.com/permalink/200507/5ef500071d1e8087e12a53f96a5b3fd8.png" alt="lara stagram" border="0"></h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input placeholder="メールアドレス" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input placeholder="パスワード" type="password" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


            <button type="submit">
                ログインする
            </button>

            {{-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif --}}
        </form>
    </div>
</main>

<footer>
    <p>Copyright &copy; HaseTano </p>
</footer>
</body>
</html>
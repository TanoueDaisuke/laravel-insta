@extends('layouts/app')

@section('styles')
    <link href="{{ asset('/css/auth/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="auth_wrapper">
        <h2><img src="https://fontmeme.com/permalink/200508/001ead33dcb56859ac8c3055a7e8b2fa.png" alt="login"></h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            @error('email')
                <span class="error mail" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input placeholder="メールアドレス" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            
            @error('password')
                <span class="error password" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input placeholder="パスワード" type="password" name="password" required autocomplete="current-password">

            <button type="submit">
                ログインする
            </button>

            {{-- デフォであったけどおそらく使わんのでコメントアウト --}}
            {{-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif --}}
        </form>

        <p>アカウントをお持ちでないですか？ <span><a class="hover" href="{{ route('register') }}">登録する</a></span></p>
    </div>
@endsection
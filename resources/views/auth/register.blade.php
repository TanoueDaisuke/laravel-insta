@extends('layouts/app')

@section('styles')
    <link href="{{ asset('/css/auth/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="auth_wrapper">
        <h2><img src="https://fontmeme.com/permalink/200509/3f27c70dc7ea226ccf1d1b0bc0095927.png" alt="sign in"></h2>
        <p class="register_under_logo">友達の写真や動画をチェックしよう</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input placeholder="メールアドレス" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            
            @error('email')
            <span class="error email" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input placeholder="ユーザーネーム" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="error name" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input placeholder="パスワード" type="password" name="password" required autocomplete="new-password">

            @error('password')
                <span class="error password" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input placeholder="パスワード確認" type="password" name="password_confirmation" required autocomplete="new-password">

            <button type="submit">登録する</button>

            <p>アカウントをお持ちですか？ <span><a class="hover" href="{{ route('login') }}">ログインする</a></span></p>

        </form>
    </div>    
@endsection
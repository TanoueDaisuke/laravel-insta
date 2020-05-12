@extends('layouts/app')

@section('styles')
  <link href="{{ asset('/css/post.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="post_wrapper" id="edit">
    <h2><img src="https://fontmeme.com/permalink/200510/1738bc06b232d8955d642cb7ede9e4e0.png" alt="post page"></h2>
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" >    
      @csrf    
      
      <label for="image" id="toggle-label">
        ＋写真を選択
        <input id="image" name="image" type="file" required> {{-- TODO: 画像の保存方法をどうするか --}}
      </label>

      <div id="relative" class="active">
        <span id="close-btn"><i class="fas fa-times-circle"></i></span>
        <img id="preview" src="/storage/{{$post->image_path}}"> {{-- プレビュー画像を表示 --}}
      </div>

      <textarea name="content" placeholder="キャプションを書く" autofocus required value>{{old('content', $post->content)}}</textarea>
      {{-- TODO: ハッシュタグもできたらやりたい --}}

      <button>投稿する</button>
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('/js/image_preview.js') }}"></script>
@endsection

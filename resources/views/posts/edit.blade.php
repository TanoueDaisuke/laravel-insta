@extends('layouts/app')

@section('styles')
  <link href="{{ asset('/css/post.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="post_wrapper">
    <h2><img src="https://fontmeme.com/permalink/200510/1738bc06b232d8955d642cb7ede9e4e0.png" alt="post page"></h2>
    <form action="{{ route('posts.update', ['post' => $post]) }}" method="post" enctype="multipart/form-data" >    
      @csrf          
      @method('PUT') {{-- put通信を実装 --}}
      
      <label for="image" id="toggle-label">
        ＋写真を選択
        <input id="image" name="image" type="file"> {{-- TODO: 画像の保存方法をどうするか --}}
      </label>

      <div id="relative" class="active">
        <span id="close-btn"><i class="fas fa-times-circle"></i></span>
        <img src="/storage/{{$post->image_path}}"> {{-- プレビュー画像を表示 --}}
      </div>

      <textarea name="content" placeholder="キャプションを書く" autofocus required value>{{old('content', $post->content)}}</textarea>
      {{-- TODO: ハッシュタグもできたらやりたい --}}

      <button>更新する</button>
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('/js/image_preview.js') }}"></script>
@endsection

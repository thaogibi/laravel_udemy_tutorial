@extends('layouts.app')

@section('title', 'List posts')

@section('content')
  @if(count($posts))
    <h1>List posts</h1>

    {{-- c1: nếu dùng cách này thì uncomment 1-5 bên post.blade.php --}}
    @foreach($posts as $key => $post)
      @include('posts.partials.post')
    @endforeach


    {{-- c2: nếu dùng cách này thì uncomment dòng 6 bên post.blade.php --}}
    {{-- @each('posts.partials.post', $posts, 'post')      --}}


  @else
    <p>Not found posts</p>
  @endif
@endsection

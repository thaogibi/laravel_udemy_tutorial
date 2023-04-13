@extends('layouts.app')

@section('title', 'List posts')

@section('content')
  
  <h1>List posts</h1>

  {{-- c1: nếu dùng cách này thì uncomment 1-5 bên post.blade.php --}}
  @forelse($posts as $key => $post)
    @include('posts.partials.post')
  @empty
    <p>Not found posts</p>
  @endforelse
  {{-- c2: nếu dùng cách này thì uncomment dòng 6 bên post.blade.php --}}
  {{-- @each('posts.partials.post', $posts, 'post')      --}}
@endsection

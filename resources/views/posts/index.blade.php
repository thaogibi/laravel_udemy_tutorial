@extends('layouts.app')

@section('title', 'List posts')

@section('content')
  @if(count($posts))
    <h1>List posts</h1>
    @foreach($posts as $key => $post)
      <p>{{ $key }} . {{ $post['title'] }}</p>      
    @endforeach
  @else
    <p style="color:red">Not found posts</p>
  @endif
@endsection

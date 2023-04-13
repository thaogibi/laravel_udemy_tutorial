@extends('layouts.app')

@section('title', 'Create new post')

@section('content')
  <h1>Create new post</h1>
  <form action="{{ route('posts.store')}}" method="POST">
    @csrf
    @include('posts.partials.form')
    <div><input class="btn btn-primary btn-block" type="submit" value="Create"></div>
  </form>
@endsection
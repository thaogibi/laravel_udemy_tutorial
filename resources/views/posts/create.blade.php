@extends('layouts.app')

@section('title', 'Create new post')

@section('content')
  <h1>Create new post</h1>
  <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    @include('posts.partials.form')
    <div><input class="btn btn-primary btn-block" type="submit" value="Create"></div>
  </form>
@endsection
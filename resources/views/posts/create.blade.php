@extends('layouts.app')

@section('title', 'Create new post')

@section('content')
  <h1>Create new post</h1>
  <form action="{{ route('posts.store')}}" method="POST">
    @csrf
    <table>
      <tbody>
        @include('posts.partials.form')
      
        <tr>
          <input type="submit" value="Create">
        </tr>
      </tbody>
    </table>
  </form>
@endsection
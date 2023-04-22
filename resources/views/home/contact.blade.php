@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<h1>Contact</h1>
<p>Hello this is contact!</p>

@can('secret')
  <p>
    <a href="{{route('home.secret')}}">
      Go to SECRET
    </a>
  </p>
@endcan

@endsection
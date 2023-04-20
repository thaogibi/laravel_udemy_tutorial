@extends('layouts.app')


@section('title', 'GiBi')

@section('content')
  <form method='POST' action="{{ route('register') }}">
    @csrf
    <div class="form-group">
      <label>Name:</label>
      <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
    </div>
    <div class="form-group">
      <label>Email:</label>
      <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
    </div>
    <div class="form-group">
      <label>Password:</label>
      <input type="password" name="password" required class="form-control">
    </div>
    <div class="form-group">
      <label>Re-password</label>
      <input type="password" name="password_confirmation" required class="form-control">
    </div>
    <button type="submit" class="btn btn-primary btn-block">Register</button>
  </form>
@endsection
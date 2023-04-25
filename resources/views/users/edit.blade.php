@extends('layouts.app')

@section('content')
  <form method="post" action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data" class="form-horizontal">
    @csrf
    @method('put')
    <div class="row">
      <div class="col-4">
        <img src="" class="img-thumbnail avarta">
        <div class="card mt-4">
          <div class="card body">
            <h6>Upload a diffrent photo</h6>
            <input class="form-control-life" type="file" name="avatar">
          </div>
        </div>
      </div>

      <div class="col-8">
        <div class="form-group">
          <label>Name:</label>
          <input class="form-control" value="" type="text" name="name">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Save changes">
        </div>
      </div>
    </div>
  </form>
@endsection
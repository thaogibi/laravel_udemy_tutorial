<div class="form-group">
  <label for="title">Title</label>
  <input id ="title" type="text" name="title" value="{{ old('title', optional($post ?? null)->title)}}">
</div>

@error('title')
  <div>{{ $message }}</div>
@enderror

<div class="form-group">
  <label for="content">Content</label>
  <textarea class="form-control" name="content">{{ old('content', optional($post ?? null)->content )}}</textarea>
</div>


{{-- display error --}}
@if($errors->any())
  @foreach($errors->all() as $error)
  <tr>
    <li>{{ $error }}</li>
  </tr>
  @endforeach
@endif

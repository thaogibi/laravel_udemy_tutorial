<div class="form-group">
  <label for="title">Title</label>
  <input id ="title" type="text" name="title" value="{{ old('title', optional($post ?? null)->title)}}">
</div>

{{-- @error('title')
  <div class="alert alert-danger">{{ $message }}</div>
@enderror --}}

<div class="form-group">
  <label for="content">Content</label>
  <textarea class="form-control" name="content">{{ old('content', optional($post ?? null)->content )}}</textarea>
</div>


{{-- display if error --}}
@include('components.errors')

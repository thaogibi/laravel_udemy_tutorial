{{-- c1: cách này tương ứng với c1 bên ../index.blade.php --}}
{{-- @if($loop->even)
  <div style='background-color:gray'>{{ $key }} - {{ $post['title'] }}</div>
@else
  <div>{{ $key }} - {{ $post['title'] }}</div>
@endif --}}

<h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h3>

{{-- c2: cách này tương ứng với c2 bên ../index.blade.php --}}
{{-- <p>{{ $key }} - {{ $post ['title'] }}</p> --}}




{{-- thời gian thêm và người viết --}}
<p class="text-muted">
  Added {{$post->created_at->diffForHumans()}} 
  by: {{ $post->user->name }}
</p>


{{-- số lượng comment --}}
@if($post->comments_count)
  <p>{{ $post->comments_count }} comments</p>
@else
  <p>No comments yet!</p>
@endif


<div class="mb-3">
  <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
  <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete" class="btn btn-primary">
  </form>
</div>
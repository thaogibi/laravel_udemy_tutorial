{{-- c1: cách này tương ứng với c1 bên ../index.blade.php --}}
{{-- @if($loop->even)
  <div style='background-color:gray'>{{ $key }} - {{ $post['title'] }}</div>
@else
  <div>{{ $key }} - {{ $post['title'] }}</div>
@endif --}}



{{-- <h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h3> --}}
<h3>
  @if($post->trashed())
      <del>
  @endif
  <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
      href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
  @if($post->trashed())
      </del>
  @endif
</h3>
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
  {{-- @can('update', $post)
    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
  @endcan --}}



  {{-- @can('delete', $post)
    <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
      @csrf
      @method('DELETE')
      <input type="submit" value="Delete" class="btn btn-primary">
    </form>
  @endcan --}}

  @if(!$post->trashed())

    @can('update', $post)
      <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
    @endcan
    
    @can('delete', $post)
      <form method="POST" class="d-inline"
          action="{{ route('posts.destroy', ['post' => $post->id]) }}">
          @csrf
          @method('DELETE')

          <input type="submit" value="Delete!" class="btn btn-primary"/>
      </form>
    @endcan
  @else
    <p style="color:red">Deleted at {{ $post->deleted_at}}<p>
  @endif
</div>
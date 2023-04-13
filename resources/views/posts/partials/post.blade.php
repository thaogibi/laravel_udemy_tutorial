{{-- c1: cách này tương ứng với c1 bên ../index.blade.php --}}
@if($loop->even)
  <p style='background-color:gray'>{{ $key }} - {{ $post['title'] }}</p>
@else
  <p>{{ $key }} - {{ $post['title'] }}</p>
@endif

{{-- c2: cách này tương ứng với c2 bên ../index.blade.php --}}
{{-- <p>{{ $key }} - {{ $post ['title'] }}</p> --}}



<div>
  <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete">
  </form>
</div>
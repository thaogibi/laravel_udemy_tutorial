{{-- c1: cách này tương ứng với c1 bên ../index.blade.php --}}
@if($loop->even)
  <p style='background-color:gray'>{{ $key }} - {{ $post['title'] }}</p>
@else
  <p>{{ $key }} - {{ $post['title'] }}</p>
@endif

{{-- c2: cách này tương ứng với c2 bên ../index.blade.php --}}
{{-- <p>{{ $key }} - {{ $post ['title'] }}</p> --}}


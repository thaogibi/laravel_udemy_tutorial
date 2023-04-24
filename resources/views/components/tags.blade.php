{{-- <p>
  @foreach($tags as $tag)
    <a href="#" class="badge bg-success bg-lg">{{ $tag->name }}</a>
  @endforeach
</p> --}}

<div class="badge bg-{{ $type ?? 'success'}}">
  {{$slot}}
</div>
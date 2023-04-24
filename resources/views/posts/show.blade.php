@extends('layouts.app')

@section('title', $post->title)


@section('content')
  <div class="row">
    <div class="col-8">
        <h1 style="display:inline">{{ $post->title }} </h1>
        <sup>
          {{-- @if(now()->diffForHumans($post->created_at) < 5) --}}
          @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20)
            {{-- @badge(['show' => true])
              Brand new Post!
            @endbadge --}}
            @component('components.badge', (['type' => 'primary']))
                New!
            @endcomponent
          @endif
        </sup>

        
        @if($post->created_at)
          <p>Added {{ $post->created_at->diffForHumans() }}</p>

          {{-- @if(now()->diffForHumans($post->created_at) < 5)
            <div class="alert alert-info">New!</div>
          @endif --}}
        
        @endif
        
        <p>{{ $post->content }}</p>






        @foreach($post->tags as $tag)
          @component('components.tags')
            {{-- <a href="#" style="color:aliceblue; text-decoration:none">{{ $tag->name }}</a> --}}
            <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}" style="color:aliceblue; text-decoration:none">{{ $tag->name }}</a>
          @endcomponent
        @endforeach

        {{-- @tags(['tags' => $post->tags])
        @endtags --}}






        


        <hr>
        {{-- hiển thị số lượng người đang xem trang này --}}
        <p>Currently read by {{ $counter }} people</p>

        <hr>
        
        
        
        
        
        <h4>Comments</h4>
          @forelse($post->comments as $comment)
              <p>
                  {{ $comment->content }}
              </p>
              <p class="text-muted">
                  added {{ $comment->created_at->diffForHumans() }}
              </p>
              {{-- @updated(['date' => $comment->created_at])
              @endupdated --}}
          @empty
              <p>No comments yet!</p>
          @endforelse
      


    </div>

    <div class="col-4">
      @include('posts.partials.activity')
    </div>
    
  </div>

@endsection
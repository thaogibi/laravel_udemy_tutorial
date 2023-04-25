@extends('layouts.app')

@section('title', $post->title)


@section('content')
  <div class="row">
    <div class="col-8">

      @if($post->image)
        <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
          <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
      @else
          <h1>
      @endif
          {{ $post->title }}
          <sup>
            {{-- @if(now()->diffForHumans($post->created_at) < 5) --}}
            @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20)
              {{-- @badge(['show' => true])
                Brand new Post!
              @endbadge --}}
              @component('components.badge', (['type' => 'primary']))
                Brand new Post!
              @endcomponent
            @endif
          </sup>
      @if($post->image)    
          </h1>
      </div>
      @else
          </h1>
      @endif

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
      
      {{-- hiển thị image --}}
      {{-- <img src="http://laravel.test/storage/{{ $post->image->path }}"> --}}
      {{-- <img src="{{ $post->image->url() }}"> --}}
      {{--<img src="{{ asset($post->image->path) }}"> {{-- hình nhỏ nhưng ko hoạt động --}}
      


      
      <h4>Comments</h4>
      
      @include('comments.create')

      @forelse($post->comments as $comment)
          <p>
              {{ $comment->content }}
          </p>
          <p class="text-muted">
              added {{ $comment->created_at->diffForHumans() }}
              by {{ $comment->user->name }}
          </p>
          {{-- @updated(['date' => $comment->created_at, 'name' => $post->user->name])
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
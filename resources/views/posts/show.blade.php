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

            {{-- c1: --}}
              {{--
              @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20)  {{-- hoặc viết ntn @if(now()->diffForHumans($post->created_at) < 20) --}}
                {{-- @component('components.badge', (['type' => 'primary']))
                  Brand new Post!
                @endcomponent --}}


                {{-- @badge(['show' => true]) //ko dùng đc, phiên bản cũ
                  Brand new Post!
                @endbadge --}}
                {{-- <x-badge type='primary'>
                  Brand new Post!
                </x-badge>
              @endif --}}


            {{-- c2: lưu ý cách truyền DL với biến và biểu thức php nhé --}}
              <x-badge type='primary'  :show="now()->diffInMinutes($post->created_at) < 20">
                Brand new Post!
              </x-badge>


          </sup>
      @if($post->image)    
          </h1>
      </div>
      @else
          </h1>
      @endif

      <h1 style="display:inline">{{ $post->title }} </h1>
      <sup>
        <x-badge type='primary' :show="now()->diffInMinutes($post->created_at) < 20">
          New!
        </x-badge>
      </sup>

      
      
      <x-updated :date="$post->created_at" :name="$post->user->name">
      </x-updated>
      <x-updated :date="$post->updated_at">
        Updated
      </x-updated>
      
      <p>{{ $post->content }}</p>






      <x-tags :tags="$post->tags"></x-tags>

      {{-- @tags(['tags' => $post->tags])
      @endtags --}}






      


      <hr>
      {{-- hiển thị số lượng người đang xem trang này --}}
      <p>Currently read by {{ $counter }} people</p>

      
      {{-- hiển thị image --}}
      {{-- <img src="http://laravel.test/storage/{{ $post->image->path }}"> --}}
      {{-- <img src="{{ $post->image->url() }}"> --}}
      {{--<img src="{{ asset($post->image->path) }}"> {{-- hình nhỏ nhưng ko hoạt động --}}
      




      @auth
        @if(!$post->trashed())
    
          @can('update', $post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-secondary">Edit</a>
          @endcan
          
          @can('delete', $post)
            <form method="POST" class="d-inline"
                action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @csrf
                @method('DELETE')
    
                <input type="submit" value="Delete!" class="btn btn-danger"/>
            </form>
          @endcan
        @else
          <p style="color:red">Deleted at {{ $post->deleted_at}}<p>
        @endif
      @endauth      





      <hr>

      
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
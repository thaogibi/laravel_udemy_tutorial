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

  <sup>
    {{-- c1: --}}
      {{-- 
        @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20)   {{--   hoặc viết ntn  @if(now()->diffInMinutes($post->created_at) < 20) --}}
        {{-- @component('components.badge', (['type' => 'primary']))
          New!
        @endcomponent --}}

        {{-- @badge(['show' => true])
          Brand new Post!
        @endbadge --}}

        {{-- <x-badge type='primary' show=true>
          New!
        </x-badge> --}}
      {{-- @endif --}}

      
    {{-- c2 ngắn gọn hơn rất nhiều: lưu ý khi truyền dữ liệu bằng các biểu thức và biến php phải có tiền tố là dấu : nhé--}}
    <x-badge type='primary' :show="now()->diffInMinutes($post->created_at) < 20">
        New!
    </x-badge>
  </sup>

</h3>
{{-- c2: cách này tương ứng với c2 bên ../index.blade.php --}}
{{-- <p>{{ $key }} - {{ $post ['title'] }}</p> --}}




{{-- thời gian thêm, sửa và người viết --}}
  {{-- <p class="text-muted">
    Added {{$post->created_at->diffForHumans()}} 
    by: {{ $post->user->name }}
  </p> --}}

  <x-updated :date="$post->created_at" :name="$post->user->name">
  </x-updated>
  <x-updated :date="$post->updated_at">
    Updated
  </x-updated>


  
{{-- hiển thị tag --}}
  {{-- @foreach($post->tags as $tag)
    <x-tags>
      <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}" style="color:aliceblue; text-decoration:none">{{ $tag->name }}</a>
    </x-tags>
  @endforeach --}}

  {{-- @foreach($post->tags as $tag)
    @component('components.tags')
      <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}" style="color:aliceblue; text-decoration:none">{{ $tag->name }}</a>
    @endcomponent
  @endforeach --}}

  <x-tags :tags="$post->tags"></x-tags>



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
</div>
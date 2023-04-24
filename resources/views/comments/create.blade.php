<div class="mb-2 mt-2">
  @auth
    <form action="#" method="POST">
      @csrf

      <div class="form-group">
        <textarea class="form-control" name="content"></textarea>
      </div>

      <button class="btn btn-primary btn-block" type="submit">Add comment</button>
      
    </form>

  @else
    <a href=" {{ route('login') }} ">Login</a>  to comment
  @endauth
</div>
{{-- display if error --}}
@include('components.errors')


<hr>
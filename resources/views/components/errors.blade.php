{{-- display if error --}}
@if($errors->any())
  <div class="mt-2 mb-2">
      @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{ $error }}
        </div>
      @endforeach
  </div>
@endif


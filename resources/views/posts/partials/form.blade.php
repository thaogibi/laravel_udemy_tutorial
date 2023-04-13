<tr>
  <th>Title</th>
  <td><input type="text" name="title" value="{{ old('title', optional($post ?? null)->title)}}"></td>
</tr>
<tr>
  <th>Content</th>
  <td><textarea name="content">{{ old('content', optional($post ?? null)->content )}}</textarea></td>
</tr>

{{-- display error --}}
@if($errors->any())
  @foreach($errors->all() as $error)
  <tr>
    <li>{{ $error }}</li>
  </tr>
  @endforeach
@endif
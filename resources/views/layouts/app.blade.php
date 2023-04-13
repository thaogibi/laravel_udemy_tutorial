<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}" defer></script>
  <title>GB_Laravel - @yield('title')</title>
</head>
<body>
  <div>
    @if(session('status'))
    <div style="background: green; color:white">
      {{ session('status' )}}
    </div>
  @endif
    @yield('content')
  </div>
</body>
</html>
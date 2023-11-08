<!doctype html>
<html lang="en">

<head>
  @include('layout.partials.head')
</head>

<body>

  @include('layout.partials.navbar')

  

  @yield('content')


  {{-- @yield('content2') --}}


  @include('layout.partials.scripts')
</body>

</html>
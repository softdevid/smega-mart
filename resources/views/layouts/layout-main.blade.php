<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }} | SMEGAMART</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;600;700&family=Poppins:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="bg-white">
        {{-- @include('layouts.partials.header.header-top') --}}
        @include('layouts.partials.header.header-mid')
        @include('layouts.partials.header.header-bottom')
        @include('layouts.partials.breadcrumb')
    </header>

    <div class="py-3 lg:py-8 px-2">
      @yield('content')
    </div>

    <footer class="bg-white">
      @include('layouts.partials.footer.footer-mid')
      @include('layouts.partials.footer.footer-bottom')
    </footer>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/flowbite.js') }}"></script>
  <script defer src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
</body>
</html>

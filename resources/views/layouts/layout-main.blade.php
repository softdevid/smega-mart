<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | SMEGAMART</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;600;700&family=Poppins:wght@200;300;400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if (request()->is('gallery') || request()->is('about'))
        <link rel="stylesheet" href="{{ asset('assets/glightbox/dist/css/glightbox.min.css') }}">
    @endif
</head>

<body>
    <header class="bg-white">
        @include('layouts.partials.header.header-top')
        @include('layouts.partials.header.header-mid')
        @include('layouts.partials.header.header-bottom')
        @include('layouts.partials.breadcrumb')
    </header>

    <div class="py-3 lg:py-8">
        @yield('content')
    </div>

    {{-- partner --}}
    @if ($title == 'Beranda')
        @include('layouts.partials.footer.partner')
    @endif

    <footer class="bg-slate-200">
        @include('layouts.partials.footer.footer-mid')
        @include('layouts.partials.footer.footer-bottom')
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    <script defer src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/header-mid.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>

    @if (request()->is('gallery') || request()->is('about'))
        <script src="{{ asset('assets/glightbox/dist/js/glightbox.min.js') }}"></script>
        <script>
            var lightbox = GLightbox();
            lightbox.on('open', (target) => {
                console.log('lightbox opened');
            });
        </script>
    @endif
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }} | Kasir Smega Mart</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <link href="/css/app.css" rel="stylesheet">
</head>

<body class="antialiased">


    <nav
        class="sm:px-4 py-2.5 bg-[#bb1724] text-white fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <a href="/admin-dashboard" class="flex items-center ml-3 sm:ml-0">
                {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo"> --}}
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"><b>KASIR</b> | Smega
                    Mart</span>
            </a>
            <div class="flex md:order-2">
                <a href="/logout" type="submit"
                    class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Logout</a>
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden bg-gray-100 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 mt-4 bg-white text-black rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-[#bb1724]">
                    <li>
                        <a href="{{ route('kasir.index') }}"
                            class="block py-2 pr-4 pl-3 text-black rounded hover:text-black md:hover:bg-transparent md:hover:text-white md:hover:bg-blue-800 md:p-2 {{ request()->is('/dashboard') ? 'text-black bg-white md:bg-white md:text-black p-3' : 'md:text-white' }}"
                            aria-current="page">Kasir</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pr-4 pl-3 text-black rounded hover:text-black md:hover:bg-transparent md:hover:text-white md:hover:bg-blue-800 md:p-2 {{ request()->is('/dashboard/products') ? 'text-black bg-white md:bg-white md:text-black p-3' : 'md:text-white' }}"
                            aria-current="page">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('laporan.index') }}"
                            class="block py-2 pr-4 pl-3 text-black rounded hover:text-black md:hover:bg-transparent md:hover:text-white md:hover:bg-blue-800 md:p-2 {{ request()->is('admin-storage') ? 'text-black bg-white md:bg-white md:text-black p-3' : 'md:text-white' }}"
                            aria-current="page">Laporan</a>
                    </li>
                    <li>
                        <a href="/orders"
                            class="block py-2 pr-4 pl-3 text-black rounded hover:text-black md:hover:bg-transparent md:hover:text-white md:hover:bg-blue-800 md:p-2 {{ request()->is('admin-storage') ? 'text-black bg-white md:bg-white md:text-black p-3' : 'md:text-white' }}"
                            aria-current="page">Pesanan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- <div class="mx-10 max-w-lg">
        <div role="status">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 mt-20 my-7">
                <h1 class="text-3xl tracking-tight font-bold text-gray-900">{{ $title }}</h1>
            </div>
            <div class="max-w-lg shadow-md ml-7">
                @yield('content')
            </div>
        </div>
    </div> --}}
    <header class="bg-white shadow mt-16 sm:mt-20">
        @if ($title == 'Laporan')
            <div
                class="container flex flex-wrap justify-between items-center max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="flex text-3xl tracking-tight font-bold text-gray-900">{{ $title }}</h1>

                {{-- search --}}
                <div class="md:basis-3/5 px-2">
                    <button type="button"
                        class="md:hidden tex-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg text-sm p-2.5 mr-1"
                        data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Cari</span>
                    </button>
                    <div class="hidden relative md:block">
                        <div class="relative mt-3 md:mt-0">
                            <form>
                                <div class="flex">
                                    <div class="relative w-full">
                                        <input type="search" id="search-dropdown"
                                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg sm:rounded-l-none border border-gray-300 focus:ring-[#c51826] focus:border-[#c51826]"
                                            placeholder="Cari laporan...">
                                        <button type="submit"
                                            class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-[#bb1724] rounded-r-lg border border-[#bb1724] hover:bg-[#ac1521] focus:ring-4 focus:outline-none focus:ring-red-300">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                            <span class="sr-only">Cari</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="navbar-search"
                        class="absolute z-10 top-9 left-0 hidden justify-between items-center w-full md:hidden">
                        <div class="relative mt-24">
                            <form>
                                <div class="flex">
                                    <div class="relative w-full">
                                        <input type="search" id="search-dropdown"
                                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg sm:rounded-l-none border border-gray-300 focus:ring-[#c51826] focus:border-[#c51826] shadow-lg"
                                            placeholder="Cari laporan...">
                                        <button type="submit"
                                            class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-[#bb1724] rounded-r-lg border border-[#bb1724] hover:bg-[#ac1521] focus:ring-4 focus:outline-none focus:ring-red-300">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                            <span class="sr-only">Cari</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- drawer init and toggle -->
                <div class="text-right">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        type="button" data-drawer-target="drawer-swipe" data-drawer-show="drawer-swipe"
                        data-drawer-placement="bottom" data-drawer-edge="true"
                        data-drawer-edge-offset="bottom-[60px]" aria-controls="drawer-swipe">
                        Cek Laporan
                    </button>
                </div>
            </div>
        @else
            <div
                class="container flex flex-wrap justify-between items-center max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="flex text-3xl tracking-tight font-bold text-gray-900">{{ $title }}</h1>
            </div>
        @endif
    </header>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Replace with your content -->
            <div class="px-4 py-6 sm:px-0">
                <div class="rounded-lg h-96">
                    @yield('content')
                </div>
            </div>
            <!-- /End replace -->
        </div>
    </main>

    {{-- <div class="bg-gray-200">
        <div class="container">
            <div class="py-6 px-3" style="bottom: 0;">
                <p class="text-sm text-center text-gray-500"><b>&copy 2022</b> Dibuat oleh <a
                        href="https://softdev.akriliklasercutting.com" target="_blank" class="font-bold">SOFTDEV
                        COMMUNITY</a> dengan sepenuh &#10084;&#65039;</p>
            </div>
        </div>
    </div> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    <script defer src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
</body>

</html>

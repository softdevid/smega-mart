@extends('layouts.layout-main')
@section('content')
    <div id="brgDetail"></div>

    <div class="container">
        @if ($errors->any())
            <div class="mb-4 flex rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-200 dark:text-red-800"
                role="alert">
                <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="font-medium">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session()->has('success'))
            <div id="alert-3" class="mb-4 flex rounded-lg bg-green-100 p-4 dark:bg-green-200" role="alert">
                <svg aria-hidden="true" class="h-5 w-5 flex-shrink-0 text-green-700 dark:text-green-800" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"\
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session()->has('error'))
            <div id="alert-2" class="mb-4 flex rounded-lg bg-red-100 p-4 dark:bg-red-200" role="alert">
                <svg aria-hidden="true" class="h-5 w-5 flex-shrink-0 text-red-700 dark:text-red-800" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                    {{ session('error') }}
                </div>
                <button type="button"
                    class="-mx-1.5 -my-1.5 ml-auto inline-flex h-8 w-8 rounded-lg bg-red-100 p-1.5 text-red-500 hover:bg-red-200 focus:ring-2 focus:ring-red-400 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif
        <div id="message"></div>
        <div id="success"></div>

        <div class="rounded-lg border bg-white p-4 lg:p-8">
            <div class="grid grid-cols-1 items-center gap-2 md:grid-cols-12 md:gap-4 lg:grid-cols-12 lg:gap-6">
                <div class="md:col-span-5 lg:col-span-5">
                    <main id="gallery">
                        <div id="main-image">
                            @if ($product->cloud_Img == null or $product->cloud_img == '-')
                                <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663833101/products/produk_fwzfro.jpg"
                                    alt="Image"
                                    class="mt-2 h-[314px] max-w-full rounded-md border border-gray-300 bg-gray-50 object-contain p-1">
                            @else
                                <img src="{{ $product->img_urls }}" alt="Image"
                                    class="mt-2 h-[314px] max-w-full rounded-md border border-gray-300 bg-gray-50 object-contain p-1">
                            @endif
                        </div>
                        <div id="images" class="mt-3 grid grid-cols-4 gap-x-4">
                            @if ($product->cloud_Img == null or $product->cloud_img == '-')
                                <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663833101/products/produk_fwzfro.jpg"
                                    alt="Image"
                                    class="mt-2 h-auto max-w-full rounded-md border border-gray-300 bg-gray-50 p-1">
                            @else
                                <img src="{{ $product->img_urls }}" alt="Image"
                                    class="mt-2 h-auto max-w-full rounded-md border border-gray-300 bg-gray-50 p-1">
                            @endif
                            @foreach ($images as $images)
                                <img src="{{ $images->img_urls }}" alt="Image"
                                    class="mt-2 h-auto max-w-full rounded-md border border-gray-300 bg-white p-1">
                            @endforeach
                        </div>
                        <script>
                            let images = document.querySelectorAll("#gallery > #images > img");
                            images.forEach((image) =>
                                image.addEventListener("click", function() {
                                    let imagesSrc = image.getAttribute("src");
                                    document.querySelector("#gallery > #main-image > img").setAttribute("src", imagesSrc);
                                })
                            );
                        </script>
                    </main>
                </div>

                <form action="{{ route('order.store') }}" method="post">
                    @csrf
                    {{-- inputan hidden cart --}}
                    <input type="hidden" name="barcode" id="barcode" value="{{ $product->barcode }}">
                    <input type="hidden" name="namaBarang" id="namaBarang" value="{{ $product->namaBarang }}">
                    <input type="hidden" name="hrgJual" id="hrgJual" value="{{ $product->hrgJual }}">
                    <input type="hidden" name="status" id="status" value="0">
                    <input type="hidden" name="noFaktur" id="noFaktur" value="{{ $noFaktur }}">
                    <input type="hidden" name="kdUser" id="kdUser" value="{{ auth()->user()->kdUser ?? '' }}">
                    <input type="hidden" name="subtotal" id="subtotal"
                        value="{{ request('qty') * $product->hrgJual }}">

                    {{-- stok --}}
                    <input type="hidden" name="stok" id="stok" value="{{ $product->stok }}">

                    <div class="md:col-span-7 lg:col-span-7 lg:mb-40">
                        <div class="mt-7 p-1 lg:mt-0 lg:p-0 lg:pl-5">
                            <h2 class="mb-3 text-xl font-semibold uppercase tracking-wide text-gray-600">
                                {{ $product->namaBarang }}
                            </h2>
                            <p class="mb-3 text-sm text-slate-600">
                                {{ $product->kategori->namaKategori }}
                            </p>
                            <h3 class="mb-3 text-xl font-semibold text-red-800">
                                Rp.{{ number_format($product->hrgJual, 0, ',', '.') }}
                            </h3>
                            <p class="mb-3 text-sm text-black">
                                Stok: {{ $product->stok }}
                            </p>
                            <div class="mb-3 grid grid-cols-4 gap-2 text-sm text-slate-600">
                                <div class="flex">
                                    <input type="number" min="1" value="1" name="qty" id="qty"
                                        class="w-[100px] text-center">
                                    <button
                                        class="ml-2 flex w-auto rounded-lg bg-blue-600 text-sm text-white hover:bg-blue-700">
                                        <b class="mx-3" id="addCart">Add <i
                                                class="fa-solid fa-cart-shopping"></i></b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-7 grid grid-cols-1 rounded-lg border bg-white p-4 lg:p-8">
            <div>
                <h4 class="mb-3 text-base font-medium">Informasi Produk</h4>
                <div class="my-4">
                    {{-- <h1 class="text-2xl text-center">Bahan pembuat</h1> --}}
                    <p>{{ $product->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection

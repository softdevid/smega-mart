@extends('layouts.layout-main')
@section('content')
    <div class="container">
      <div class="bg-white border rounded-lg p-4 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-12 lg:grid-cols-12 gap-2 md:gap-4 lg:gap-6 items-center">
            <div class="md:col-span-5 lg:col-span-5">
                <main id="gallery">
                    <div id="main-image">
                      @if($product->cloud_Img == null or $product->cloud_img == '-')
                        <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663833101/products/produk_fwzfro.jpg" alt="Image"
                            class="mt-2 h-[314px] max-w-full rounded-md border border-gray-300 bg-gray-50 object-contain p-1">
                      @else
                      	<img src="{{ $product->img_urls }}" alt="Image"
                            class="mt-2 h-[314px] max-w-full rounded-md border border-gray-300 bg-gray-50 object-contain p-1">
                      @endif
                    </div>
                    <div id="images" class="mt-3 grid grid-cols-4 gap-x-4">
                      @if($product->cloud_Img == null or $product->cloud_img == '-')
                        <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663833101/products/produk_fwzfro.jpg" alt="Image"
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
            <div class="md:col-span-7 lg:col-span-7 lg:mb-40">
                <div class="mt-7 lg:mt-0 p-1 lg:p-0 lg:pl-5">
                    <h2 class="mb-3 text-xl text-gray-600 font-semibold uppercase tracking-wide">
                        {{ $product->namaBarang }}
                    </h2>
                    <p class="mb-3 text-sm text-slate-600">
                      {{ $product->kategori->namaKategori }}
                    </p>
                    <h3 class="mb-3 text-xl font-semibold text-red-800">Rp.{{ number_format($product->hrgJual, 0, ',', '.') }}</h3>
                    <p class="mb-3 text-sm text-slate-600">
                        Stok : <span>{{ $product->stok }}</span>
                    </p>
                </div>
            </div>
        </div>
      </div>
        <div class="grid grid-cols-1 mt-7 bg-white border rounded-lg p-4 lg:p-8">
            <div>
                <h4 class="text-base font-medium mb-3">Informasi Produk</h4>
                <div class="my-4">
                  {{-- <h1 class="text-2xl text-center">Bahan pembuat</h1> --}}
                  <p>{{ $product->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

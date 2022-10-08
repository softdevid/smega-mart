@extends('layouts.layout-main')
@section('content')
    {{-- alamat pengirim --}}
    <div class="container rounded-lg border-t-4 bg-white py-5 shadow-lg">
        <div class="m-3">

            <div class="text-red-700"><i class="fa fa-location-dot"></i> Alamat Pengiriman</div>

            <div class="mt-2 grid grid-cols-1 md:grid-cols-2">
                <div>{{ auth()->user()->namaUser }} ({{ auth()->user()->no_hp }}) </div>
                <div>{{ auth()->user()->kabupaten }}, {{ auth()->user()->kecamatan }}, {{ auth()->user()->desa }},
                    {{ auth()->user()->alamat_lengkap }}</div>
            </div>


        </div>
    </div>

    {{-- form checkout --}}

    {{-- produk --}}
    <div class="container mt-3 rounded-lg border-t-4 bg-white py-5 shadow-lg">
        <div class="m-3">

            <div class="text-red-700"><i class="fa fa-box"></i> Produk dipesan</div>

            <div class="mt-2 grid grid-cols-1">
                <div class="container">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        #
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Image</span>
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Product
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Qty
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Price
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        SubTotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brg as $key => $b)
                                    <form action="{{ route('order.update', [$b->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" value="{{ $b->id }}" name="id[]" id="id[]">
                                        <input type="hidden" value="{{ $b->noFaktur }}">
                                        <tr
                                            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                            <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="w-32 p-4">
                                                @if ($b->barang->img_urls == null)
                                                    <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663833101/products/produk_fwzfro.jpg"
                                                        alt="Apple Watch" class="h-8 w-8">
                                                @else
                                                    <img src="{{ $b->barang->img_urls }}" alt="Apple Watch"
                                                        class="h-8 w-8">
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                {{ $b->namaBarang }}
                                            </td>
                                            <td class="mx-auto items-center justify-between py-4 px-6">
                                                <div>
                                                    <input type="number" id="first_product"
                                                        class="block w-14 rounded-lg border border-gray-300 bg-gray-50 px-2.5 py-1 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                                        placeholder="1" required="" min="1"
                                                        value="{{ $b->qty }}">
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                Rp. {{ number_format($b->hrgJual, 0, ',', '.') }}
                                            </td>
                                            <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                Rp. {{ number_format($b->qty * $b->hrgJual, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- total bayar --}}

    <div class="container mt-3 rounded-lg border-t-4 bg-white py-5 shadow-lg">
        <div class="m-3">

            <div class="text-center">
                <div class="mt-4 text-sm text-red-700"><i class="fa fa-money"></i> Metode bayar Cash on delivery /
                    bayar
                    ditempat
                    khusus
                    wilayah
                    purbalingga!</div>
                {{-- <div class="mt-4 bg-red-700 text-sm text-white">Pemesanan di online shop ini khusus wilayah
                  kabupaten
                  purbalingga!</div> --}}
            </div>

            <div class="mt-4 text-right">
                <span class="mt-4">Subtotal produk: Rp. <span
                        class="text-red-700">{{ number_format($total, 0, ',', '.') }}</span></span><br>

                <span class="mt-4">Biaya aplikasi: Rp. <span class="text-red-700">1.000</span></span><br>
                <span class="mt-4">Total pembayaran: Rp. <span
                        class="text-red-700">{{ number_format($total + 1000, 0, ',', '.') }}</span></span><br>
            </div>

        </div>
    </div>
@endsection

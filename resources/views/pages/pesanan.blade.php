@extends('layouts.layout-main')
@section('content')
    <div class="container">
        <div class="max-auto mb-4 justify-between border-b border-gray-200 text-center dark:border-gray-700">
            <ul class="-mb-px flex flex-wrap justify-center text-sm font-medium" id="myTab"
                data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block rounded-t-lg border-b-2 border-blue-600 p-4 text-blue-600 hover:text-blue-600 dark:border-blue-500 dark:text-blue-500 dark:hover:text-blue-500"
                        id="diproses-tab" data-tabs-target="#diproses" type="button" role="tab" aria-controls="diproses"
                        aria-selected="true">Diproses</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block rounded-t-lg border-b-2 border-blue-600 p-4 text-blue-600 hover:text-blue-600 dark:border-blue-500 dark:text-blue-500 dark:hover:text-blue-500"
                        id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="true">Dikemas</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block rounded-t-lg border-b-2 border-transparent border-gray-100 p-4 text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:border-transparent dark:border-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                        id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">Dikirim</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block rounded-t-lg border-b-2 border-transparent border-gray-100 p-4 text-gray-500 hover:border-gray-300 hover:text-gray-600 dark:border-transparent dark:border-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                        id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                        aria-controls="settings" aria-selected="false">Sampai</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="diproses" role="tabpanel"
            aria-labelledby="diproses-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{-- diproses status 1 --}}

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
                                    <thead
                                        class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
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
                                                <input type="hidden" value="{{ $b->id }}" name="id[]"
                                                    id="id[]">
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
                        <span class="mt-4">Subtotal prouk: Rp. <span
                                class="text-red-700">{{ number_format($total, 0, ',', '.') }}</span></span><br>

                        <span class="mt-4">Biaya aplikasi: Rp. <span class="text-red-700">1.000</span></span><br>
                        <span class="mt-4">Total pembayaran: Rp. <span
                                class="text-red-700">{{ number_format($total + 1000, 0, ',', '.') }}</span></span><br>
                    </div>

                </div>
            </div>

            </p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="profile" role="tabpanel"
            aria-labelledby="profile-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{-- dikemas status 2 --}}

                {{-- alamat pengirim --}}
            <div class="container rounded-lg border-t-4 bg-white py-5 shadow-lg">
                <div class="m-3">

                    <div class="text-red-700"><i class="fa fa-location-dot"></i> Alamat Pengiriman</div>

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2">
                        <div>{{ auth()->user()->namaUser }} ({{ auth()->user()->no_hp }}) </div>
                        <div>{{ auth()->user()->kabupaten }}, {{ auth()->user()->kecamatan }},
                            {{ auth()->user()->desa }},
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
                                    <thead
                                        class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
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
                                        @foreach ($brgKemas as $key => $b)
                                            <form action="{{ route('order.update', [$b->id]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" value="{{ $b->id }}" name="id[]"
                                                    id="id[]">
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
                        <span class="mt-4">Subtotal prouk: Rp. <span
                                class="text-red-700">{{ number_format($total, 0, ',', '.') }}</span></span><br>

                        <span class="mt-4">Biaya aplikasi: Rp. <span class="text-red-700">1.000</span></span><br>
                        <span class="mt-4">Total pembayaran: Rp. <span
                                class="text-red-700">{{ number_format($total + 1000, 0, ',', '.') }}</span></span><br>
                    </div>

                </div>
            </div>
            </p>
        </div>
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="dashboard" role="tabpanel"
            aria-labelledby="dashboard-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{-- dikirim status 3 --}}
            </p>
        </div>
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="settings" role="tabpanel"
            aria-labelledby="settings-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{-- selesai status 4 --}}
            </p>
        </div>
    </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            function produkDiproses() {
                $('tbody').html('');
                $.ajax({
                    url: "{{ route('dataBarang') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, item) {
                            $('tbody').append('')
                        })
                    }
                })
            }

        }); //end document
    </script>
@endpush

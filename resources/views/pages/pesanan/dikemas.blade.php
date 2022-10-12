@extends('layouts.layout-main')
@section('content')
    <div
        class="border-b border-gray-200 text-center text-sm font-medium text-gray-500 dark:border-gray-700 dark:text-gray-400">
        <ul class="-mb-px flex flex-wrap justify-center">
            <li class="mr-2">
                <a href="/pesanan/diproses"
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300">Diproses</a>
            </li>
            <li class="mr-2">
                <a href="/pesanan/dikemas"
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                    aria-current="page">Dikemas</a>
            </li>
            <li class="mr-2">
                <a href="/pesanan/dikirim"
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300">Dikirim</a>
            </li>
            <li class="mr-2">
                <a href="/pesanan/selesai"
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300">Selesai</a>
            </li>
        </ul>
    </div>

    @if ($brgKemas->count() == 0)
        <h1 class="m-5 text-center text-red-700">
            Tidak ada barang yang diproses
        </h1>
    @else
        {{-- diproses status 1 --}}

        {{-- form checkout --}}

        {{-- produk --}}
        <a href="/detail-pesanan/{{ $noFaktur }}">

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
                                                Gambar
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
                                                <input type="hidden" name="noFaktur" id="noFaktur"
                                                    value="{{ $noFaktur }}">
                                                <tr
                                                    class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                                    {{-- <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                        {{ $key + 1 }}
                                                    </td> --}}
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
            <p class="mt-3 text-center">Total: Rp.
                {{ number_format($brgKemas->sum('subtotal'), 0, ',', '.') }}</p>
        </a>
        {{-- @endforeach --}}
    @endif
@endsection

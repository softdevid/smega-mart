@extends('kasir.layouts.template')
@section('content')
    <h1 class="text-center text-3xl">Detail pesanan {{ $data->noFaktur }}</h1>
    <div class="mx-auto mt-2 h-[2px] w-[100px] bg-black"></div>

    {{-- alamat pengirim --}}
    <div class="container rounded-lg border-t-4 bg-white py-5 shadow-lg">
        <div class="m-3">

            <div class="text-red-700"><i class="fa fa-location-dot"></i> Alamat Pengiriman</div>

            <div class="mt-2 grid grid-cols-1 md:grid-cols-2">
                <div>{{ $data->user->namaUser }} ({{ $data->user->noHp }}) </div>
                <div>
                    {{ $data->alamat }}
                </div>
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
                                        Image
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
                                    <tr
                                        class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="w-32 p-4">
                                            @if ($b->barang->img_urls == null or $b->barang->img_urls == '')
                                                <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663833101/products/produk_fwzfro.jpg"
                                                    alt="Apple Watch" class="h-8 w-8">
                                            @else
                                                <img src="{{ $b->barang->img_urls }}" alt="Apple Watch" class="h-8 w-8">
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                            {{ $b->namaBarang }}
                                        </td>
                                        <td class="mx-auto items-center justify-between py-4 px-6">
                                            {{ $b->qty }}
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
                <div class="mt-4 text-sm text-red-700"><i class="fa-regular fa-money-bill"></i> Metode bayar hanya
                    Cash on delivery / bayar
                    ditempat
                    khusus
                    wilayah
                    purbalingga!</div>
            </div>

            <div class="mt-4 text-right">
                <span class="mt-4">Total pembayaran: Rp. <span
                        class="text-red-700">{{ number_format($data->subtotal, 0, ',', '.') }}</span></span><br>
                <div class="mt-3">
                    @if ($data->status == 0)
                        <a href="/orders" class="rounded-lg bg-gray-700 p-2 text-white hover:bg-gray-800 md:p-3">Kembali</a>
                    @elseif ($data->status == 1)
                        <a href="/orders/dikemas"
                            class="rounded-lg bg-gray-700 p-2 text-white hover:bg-gray-800 md:p-3">Kembali</a>
                    @elseif ($data->status == 2)
                        <a href="/orders/dikirim"
                            class="rounded-lg bg-gray-700 p-2 text-white hover:bg-gray-800 md:p-3">Kembali</a>
                    @elseif ($data->status == 3)
                        <a href="/orders/selesai"
                            class="rounded-lg bg-gray-700 p-2 text-white hover:bg-gray-800 md:p-3">Kembali</a>
                    @elseif ($data->status == 4)
                        <a href="/orders/dibatalkan"
                            class="rounded-lg bg-gray-700 p-2 text-white hover:bg-gray-800 md:p-3">Kembali</a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    </form>
@endsection

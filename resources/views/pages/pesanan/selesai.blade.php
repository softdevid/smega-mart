@extends('layouts.layout-main')
@section('content')

    @include('pages.pesanan.navtab')

    @if ($brgSelesai->count() == 0)
        <h1 class="m-5 text-center text-red-700">
            Tidak ada barang yang diproses
        </h1>
    @else
        {{-- diproses status 3 --}}

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
                                                Nama Penerima
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Alamat
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Barang dipesan
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Jumlah barang dipesan
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                SubTotal
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Status pengiriman
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brgSelesai as $key => $b)
                                            <input type="hidden" value="{{ $b->id }}" name="id[]" id="id[]">
                                            <input type="hidden" name="noFaktur" id="noFaktur"
                                                value="{{ $noFaktur }}">
                                            <tr
                                                class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                                {{-- <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                        {{ $key + 1 }}
                                                    </td> --}}
                                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                    {{ $b->user->namaUser }}
                                                </td>
                                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                    {{ $b->alamat }}
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
                                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                    @if ($b->status == 0)
                                                        <b>Sedang diproses</b>
                                                    @elseif ($b->status == 1)
                                                        <b>Sedang dikemas</b>
                                                    @elseif ($b->status == 2)
                                                        <b>Sedang dikirim</b>
                                                    @elseif ($b->status == 3)
                                                        <b>Sudah sampai</b>
                                                    @endif
                                                </td>
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
        </a>
        {{-- @endforeach --}}
    @endif
@endsection

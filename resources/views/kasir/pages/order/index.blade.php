@extends('kasir.layouts.template')
@section('content')
    <div
        class="border-b border-gray-200 text-center text-sm font-medium text-gray-500 dark:border-gray-700 dark:text-gray-400">
        <ul class="-mb-px flex flex-wrap justify-center">
            <li class="mr-2">
                <a href="/orders"
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

    @if ($brg->count() == 0)
        <h1 class="m-5 text-center text-red-700">
            Tidak ada barang yang diproses
        </h1>
    @else
        {{-- diproses status 0 --}}

        {{-- form checkout --}}

        {{-- produk --}}




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
                                    No Faktur
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Nama Pengirim
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Alamat Pengiriman
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    SubTotal
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brg as $key => $b)
                                <form action="/orders/{{ $b->noFaktur }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" value="{{ $b->id }}" name="id" id="id">
                                    <input type="hidden" name="noFaktur" id="noFaktur" value="{{ $b->noFaktur }}">
                                    <tr
                                        class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                            {{ $b->noFaktur }}
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                            {{ $b->user->namaUser }}
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                            {{ $b->user->kabupaten }}, {{ $b->user->kecamatan }}, {{ $b->user->desa }},
                                            {{ $b->user->alamat_lengkap }}
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                            Rp. {{ number_format($b->subtotal, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                            <button
                                                class="p-2 bg-green-400 text-white rounded-lg hover:bg-green-700">Detail</button>
                                            <button id="setuju" type="submit"
                                                class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-800">Setuju</button>
                                            <button
                                                class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-800">Batalkan</button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </a>
            {{-- @endforeach --}}
    @endif

    <script>
        // $(document).ready(function() {
        $(document).on("click", "#setuju", function(e) {
            e.preventDefault();

            var data = {
                'status': $('#status').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/orders/{id}",
                data: data,
                dataType: "json",
                success: function(response) {}
            })

        })
        // })
    </script>
@endsection

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
                <a href="/orders/dikemas"
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                    aria-current="page">Dikemas</a>
            </li>
            <li class="mr-2">
                <a href="/orders/dikirim"
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300">Dikirim</a>
            </li>
            <li class="mr-2">
                <a href="/orders/selesai"
                    class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300">Selesai</a>
            </li>
        </ul>
    </div>

    @if ($brgKirim->count() == 0)
        <h1 class="m-5 text-center text-red-700">
            Tidak ada barang yang dikemas
        </h1>
    @else
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
                            @foreach ($brgKirim as $key => $b)
                                <form action="{{ route('rinci.update', [$b->id]) }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" value="{{ $b->id }}" name="id" id="id">
                                    <input type="hidden" value="3" name="status" id="status">
                                    <input type="hidden" value="{{ $b->noFaktur }}" name="noFaktur" id="noFaktur">
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
                                                class="rounded-lg bg-green-400 p-2 text-white hover:bg-green-700">Detail</button>
                                            <button type="submit"
                                                class="rounded-lg bg-blue-600 p-2 text-white hover:bg-blue-800">Setuju</button>
                                            <button
                                                class="rounded-lg bg-red-600 p-2 text-white hover:bg-red-800">Batalkan</button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </a>
    @endif
@endsection

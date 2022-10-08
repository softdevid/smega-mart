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

    @if ($brgSelesai->count() == 0)
        <h1 class="m-5 text-center text-red-700">
            Tidak ada barang yang sudah diterima
        </h1>
    @else
        {{-- selesai status 4 --}}
    @endif
@endsection

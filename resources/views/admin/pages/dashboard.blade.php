@extends('admin.layouts.template')
@section('content')
    <div class="justify-beetwen grid grid-cols-1 items-center gap-8 md:grid-cols-2 lg:grid-cols-4">
        <div class="flex max-w-sm items-center whitespace-nowrap rounded-md border-b bg-red-600 py-3 px-6 shadow-lg">
            {{-- <img class="w-10 h-10 sm:w-20 sm:h-20" src="/PRODUK.png" alt="Jese image"> --}}
            <div class="h-10 w-10 rounded-full border-0 sm:h-20 sm:w-20 md:-ml-3 md:border-2">
                <i class="fa-solid fa-rupiah-sign items-center text-4xl text-white md:m-4 md:text-5xl"></i>
            </div>
            <div class="pl-3">
                <div class="text-base font-semibold text-white">Keuntungan Hari ini</div>
                <div class="block font-normal text-white">Rp. {{ number_format($today, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="flex max-w-sm items-center whitespace-nowrap rounded-md border-b bg-purple-600 py-3 px-6 shadow-lg">
            <div class="h-10 w-10 rounded-full border-0 sm:h-20 sm:w-20 md:-ml-3 md:border-2 md:border-white">
                <i class="fa-solid fa-rupiah-sign items-center text-4xl text-white md:m-4 md:text-5xl"></i>
            </div>
            <div class="pl-3">
                <div class="text-base font-semibold text-white">Keuntungan bulan ini</div>
                <div class="block font-normal text-white">Rp. {{ number_format($month, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="flex max-w-sm items-center whitespace-nowrap rounded-md border-b bg-blue-500 py-3 px-6 shadow-lg">
            <div class="h-10 w-10 rounded-full border-0 sm:h-20 sm:w-20 md:-ml-3 md:border-2">
                <i class="fa-solid fa-rupiah-sign items-center text-4xl text-white md:m-4 md:text-5xl"></i>
            </div>
            <div class="pl-3">
                <div class="text-base font-semibold text-white">Keuntungan Tahun ini</div>
                <div class="block font-normal text-white">Rp. {{ number_format($year, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="flex max-w-sm items-center whitespace-nowrap rounded-md border-b bg-green-500 py-3 px-6 shadow-lg">
            <div class="h-10 w-10 rounded-full border-0 sm:h-20 sm:w-20 md:-ml-3 md:border-2">
                <i class="fa-solid fa-box items-center text-4xl text-white md:m-4 md:text-5xl"></i>
            </div>
            <div class="pl-3">
                <div class="text-base font-semibold text-white">Total produk</div>
                <div class="block font-normal text-white">{{ $totalBarang }}</div>
            </div>
        </div>
    </div>
    <div class="mx-auto mt-5 grid gap-4 text-center sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3">
        <div class="items-center rounded-md bg-gray-100 text-black shadow-lg">
            <div class="text-1xl rounded-t-md bg-blue-500 text-white">
                <b class="my-3">Grafik mingguan</b>
            </div>
            <div>
                <canvas></canvas>
            </div>
        </div>
        <div class="items-center rounded-md bg-gray-100 text-black shadow-lg">
            <div class="text-1xl rounded-t-md bg-green-500 text-center text-white">
                <b class="mx-auto">Grafik bulanan</b>
            </div>
            <div>
                <canvas></canvas>
            </div>
        </div>
        <div class="items-center rounded-md bg-gray-100 text-white shadow-lg">
            <div class="text-1xl rounded-t-md bg-purple-600 text-center text-white">
                <b class="mx-auto">Grafik Tahunan</b>
            </div>
            <div>
                <canvas></canvas>
            </div>
        </div>
    @endsection

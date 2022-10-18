@extends('layouts.layout-main')
@section('content')
<div class="container">
  <div class="grid grid-cols-1 lg:grid-cols-12 lg:gap-8">
    <div class="col-span-3">
      <div class="bg-white p-7 mb-3 border border-gray-200 rounded">
        <div class="text-sm font-medium border-b border-gray-300 pb-3 mb-6">Cari Produk</div>
        <form method="GET" class="space-y-4">
          <div>
            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Pilih Kategori</label>
            <input type="search" name="search" id="product" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#c51826] focus:border-[#c51826]" placeholder="Cari produk..." autocomplete="off">
          </div>
          <div>
            <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Pilih Kategori</label>
            <select id="kategori" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
              <option value="all" selected="" >Semua</option>
              @foreach ($categories as $category)
              <option value="{{ $category->slug }}">{{ $category->namaKategori }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <button type="submit" class="w-full p-2.5 text-sm font-medium text-white bg-[#bb1724] rounded-lg border border-[#bb1724] hover:bg-[#ac1521] focus:ring-4 focus:outline-none focus:ring-red-300">
              Cari
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-span-9">
      <div class="bg-white px-5 py-4 border border-gray-200 rounded sm:flex sm:items-center sm:justify-center">
        <label for="sorting-product" class="inline-block text-sm font-light">Berdasarkan</label>
        <select name="sortBy" id="sorting-product" class="inline-block bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg mx-2 focus:ring-[#c51826] focus:border-[#c51826]">
          <option value="latest" selected>Terbaru</option>
          <option value="expensive">Mahal - Murah</option>
          <option value="cheap">Murah - Mahal</option>
        </select>
        <div class="mt-3 sm:mt-0 inline-block">
          <div class="text-sm font-light">
            Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} produk dari total {{ $products->total() }}
          </div>
        </div>
      </div>

      <div id="products-grid" class="py-3">
        @include('pages.product.products-grid')
      </div>
    </div>
  </div>
</div>
@endsection

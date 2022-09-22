@extends('layouts.layout-main')
@section('content')
<div class="container">
  <div class="grid grid-cols-1 lg:grid-cols-12 lg:gap-8">
    <div class="col-span-3">
      <div class="bg-white p-7 mb-3 border border-gray-200 rounded">
        <div class="text-sm font-medium border-b border-gray-300 pb-3 mb-6">Cari Produk</div>
        <form>
          <div class="relative w-full">
            <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg sm:rounded-l-none border border-gray-300 focus:ring-[#c51826] focus:border-[#c51826]" placeholder="Cari produk...">
            <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-[#bb1724] rounded-r-lg border border-[#bb1724] hover:bg-[#ac1521] focus:ring-4 focus:outline-none focus:ring-blue-300">
              <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
              <span class="sr-only">Cari</span>
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
  <script>
   let pagination = document.querySelectorAll('#pagination a');
    pagination.forEach((link) => {
      link.addEventListener('click', function(event) {
        event.preventDefault();

        let page = link.getAttribute('href').split("page=")[1];
        history.pushState(null, null, `?page=${page}`);
        fetch(`/products?page=${page}`, {
          method: 'GET',
        })
        .then(response => response.text())
        .then(html => {
          let parser = new DOMParser();

          let doc = parser.parseFromString(html, "text/html");
          doc.querySelector('#products-grid').innerHTML;
        })
        .catch(function(err) {
          console.log('Failed to fetch page: ', err);
        });
      });
    });
  </script>
</div>
@endsection

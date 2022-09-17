@extends('admin.layouts.template')
@section('content')
    @if (session()->has('success'))
        <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif
    <form action="{{ route('products.store') }}" method="POST" class="mb-6" enctype="multipart/form-data">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="barcode" class="block mb-2 text-sm font-medium">Barcode</label>
                <input type="text" id="barcode"
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="No. Barcode" name="barcode">
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium">Nama Barang</label>
                <input type="text" id="name"
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nama Produk" name="namaBarang">
            </div>
            <div>
                <label for="purchase_price" class="block mb-2 text-sm font-medium">Harga Beli</label>
                <input type="number" id="purchase_price"
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Harga Beli" name="hrgBeli">
            </div>
            <div>
                <label for="price" class="block mb-2 text-sm font-medium">Harga Jual</label>
                <input type="number" id="price"
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Harga Jual" name="hrgJual">
            </div>
            <div>
                <label for="stock_store" class="block mb-2 text-sm font-medium">Satuan</label>
                <select name="kdSatuan" id=""
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" class="hover:bg-blue-600 hover:text-white">Pilih Satuan</option>
                    @foreach ($satuan as $s)
                        <option value="{{ $s->kdSatuan }}">{{ $s->namaSatuan }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="stock_store" class="block mb-2 text-sm font-medium">Kategori</label>
                <select name="kdKategori" id=""
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Kategori</option>
                    <option value="1">comming soon</option>
                    {{-- @foreach ($kategori as $k)
                        <option value="{{ $k->kdKategori }}">{{ $k->kdKategori }}</option>
                    @endforeach --}}
                </select>
            </div>
            <div>
                <label for="stock_storage" class="block mb-2 text-sm font-medium">Stok Gudang</label>
                <input type="number" id="stock_storage"
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Stok Gudang" name="stok_gudang">
            </div>
            <div>
                <label for="stock_store" class="block mb-2 text-sm font-medium">Stok Toko</label>
                <input type="number" id="stock_store"
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Stok Toko" name="stok">
            </div>
            <div>
                <label for="weight" class="block mb-2 text-sm font-medium">Berat (gram)</label>
                <input type="number" id="weight"
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="1 KG = 100 gram" name="berat">
            </div>
            <div>
                <label for="stock_store" class="block mb-2 text-sm font-medium">Suplier</label>
                <select name="" id=""
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Suplier</option>
                    <option value="">PT Mayora Indah TBK</option>
                </select>
            </div>
        </div>

        <div>
            <label for="image_main" class="block mb-2 text-sm font-medium">Deskripsi</label>
            <textarea name="deskripsi" id=""
                class="w-full h-28 shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Deskripsi Produk"></textarea>
        </div>

        <div class="grid gap-6 md:grid-cols-2 mt-2">
            <div>
                <label for="image_main" class="block mb-3 text-sm font-medium">Gambar utama</label>
                <input type="file" id="image_main"
                    class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Image" name="cloud_img">
            </div>
        </div>

        <div class="mt-5">
            <label for="images" class="block mb-3 text-sm font-medium text-left md:text-center">Gambar lain (tidak
                wajib)</label>
            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <input type="file" id="images"
                        class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Images" name="images">
                </div>
                <div>
                    <input type="file" id="images"
                        class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Images" name="images">
                </div>
                <div>
                    <input type="file" id="images"
                        class="shadow-md border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Images" name="images">
                </div>
            </div>

        </div>
        <div class="mb-6">
            <button type="submit"
                class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
            <a href="/dashboard/products" type="button"
                class="mt-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Batal</a>
        </div>
    </form>
    {{-- jQuery Script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Check Slug --}}
    <script>
        $('#name').change(function(e) {
            $.get('{{ url('check_slug') }}', {
                    'name': $(this).val()
                    console.log(name.value)
                },
                function(data) {
                    $('#slug').val(data.slug);
                    console.log(data.slug);
                }
            );
        });
    </script>
@endsection

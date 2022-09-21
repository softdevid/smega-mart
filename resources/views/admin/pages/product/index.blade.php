@extends('admin.layouts.template')
@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="m-5">
            <table class="w-full rounded-lg bg-[#bb1724] text-left text-sm text-white" id="table-datatables">
                <thead class="bg-[#bb1724] text-xs uppercase text-white dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="py-2 px-6">
                            #
                        </th>
                        <th scope="col" class="py-2 px-6">
                            Gambar
                        </th>
                        <th scope="col" class="py-2 px-6">
                            Nama Produk / barcode
                        </th>
                        <th scope="col" class="py-2 px-6 text-center">
                            Harga beli
                        </th>
                        <th scope="col" class="py-2 px-6 text-center">
                            Harga jual
                        </th>
                        <th scope="col" class="py-2 px-6 text-center">
                            Stok toko
                        </th>
                        <th scope="col" class="py-2 px-6 text-center">
                            Stok gudang
                        </th>
                        <th scope="col" class="py-2 px-6 text-center">
                            Kategori
                        </th>
                        <th scope="col" class="py-2 px-6 text-center">
                            Satuan
                        </th>
                        <th scope="col" class="py-2 px-6 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr class="border-b bg-white text-black hover:bg-gray-50">
                            <th class="m-auto w-auto border text-center">
                                {{ $key + 1 }}
                            </th>
                            <td class="items-center py-3 px-6 dark:text-white">
                                <img class="h-10 w-10" src="{{ $product->img_urls }}" alt="Jese image">
                            </td>
                            <td scope="row"
                                class="flex max-w-sm items-center whitespace-nowrap py-2 px-6 text-gray-900 dark:text-white">
                                <div class="pl-3">
                                    <div class="text-base font-semibold text-black">{{ $product->namaBarang }}</div>
                                    <div class="block font-normal text-black">{{ $product->barcode }}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                {{ number_format($product->hrgBeli, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                {{ number_format($product->hrgJual, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                {{ $product->stok }}
                            </td>
                            <td class="text-center">
                                {{ $product->stok_gudang }}
                            </td>
                            <td class="text-center">
                                {{ $product->kategori->namaKategori }}
                            </td>
                            <td class="text-center">
                                {{ $product->satuan->namaSatuan }}
                            </td>
                            <td class="md:px-auto flex items-center py-2 px-1 text-center">
                                <a href="{{ route('products.show', [$product->barcode]) }}"
                                    class="mx-3 w-full rounded-lg bg-blue-700 p-2 text-sm font-bold text-white hover:bg-blue-800">Detail</a>
                                <a href="{{ route('products.edit', [$product->barcode]) }}"
                                    class="mx-3 w-full rounded-lg bg-yellow-300 p-2 text-sm font-bold text-black hover:bg-yellow-400">Edit</a>
                                <form action="{{ route('products.destroy', [$product->barcode]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Yakin dihapus?')"
                                        class="mx-3 w-full rounded-lg bg-red-600 p-2 text-sm text-white hover:bg-red-700">
                                        Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

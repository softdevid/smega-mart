@extends('admin.layouts.template')
@section('content')
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <div class="m-5">
            <table class="w-full text-sm text-left text-white bg-[#bb1724] rounded-lg" id="table-datatables">
                <thead class="text-xs uppercase text-white dark:bg-gray-700 bg-[#bb1724]">
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
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr class="bg-white border-b hover:bg-gray-50 text-black">
                            <th class="border m-auto text-center w-auto">
                                {{ $key + 1 }}
                            </th>
                            <td class="items-center py-3 px-6 dark:text-white">
                                <img class="w-10 h-10" src="{{ $product->img_urls }}" alt="Jese image">
                            </td>
                            <td scope="row"
                                class="flex items-center py-2 px-6 text-gray-900 whitespace-nowrap dark:text-white max-w-sm">
                                <div class="pl-3">
                                    <div class="text-base text-black font-semibold">{{ $product->namaBarang }}</div>
                                    <div class="block font-normal text-black">{{ $product->barcode }}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                Rp. {{ number_format($product->hrgBeli, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                Rp. {{ number_format($product->hrgJual, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                {{ $product->stok }}
                            </td>
                            <td class="text-center">
                                {{ $product->stok_gudang }}
                            </td>
                            <td class="text-center">
                                {{ $product->kategori->namaKategori }}
                                {{-- {{ $product->kdKategori }} --}}
                            </td>
                            <td class="flex py-2 px-1 items-center md:px-auto text-center">
                                <a href="{{ route('products.show', [$product->barcode]) }}"
                                    class="bg-blue-700 text-white font-bold p-2 rounded-lg hover:bg-blue-800 text-sm w-full mx-3">Detail</a>
                                <a href="{{ route('products.edit', [$product->barcode]) }}"
                                    class="bg-yellow-300 text-black font-bold hover:bg-yellow-400 p-2 rounded-lg text-sm w-full mx-3">Edit</a>
                                <form action="{{ route('products.destroy', [$product->barcode]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Yakin dihapus?')"
                                        class="bg-red-600 text-white hover:bg-red-700 p-2 rounded-lg text-sm w-full mx-3">
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

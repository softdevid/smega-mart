@extends('kasir.layouts.template')
@section('content')
    <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
        <div>
            <input type="number" class="w-full rounded-lg border p-2" placeholder="Barcode">
        </div>
        <div>
            <input type="number" class="w-full rounded-lg border p-2" placeholder="QTY" min="1">
        </div>
        <div>
            <input type="number" class="w-full rounded-lg border bg-gray-100 p-2" placeholder="Nama Produk" disabled>
        </div>
        <div>
            <input type="number" class="w-full rounded-lg border bg-gray-100 p-2" placeholder="Harga Jual" disabled>
        </div>
    </div>
    <button class="mx-auto mt-3 rounded-lg bg-green-400 p-2 text-sm text-white hover:bg-green-600"><i
            class="fa fa-plus"></i>
        Tambah</button>

    <div class="mx-auto mt-5 grid grid-cols-1 md:grid-cols-2">
        <div>
            <table class="w-full shadow-lg" id="table-datatables">
                <thead class="rounded-lg bg-[#bb1724] text-white">
                    <tr>
                        <th>#</th>
                        <th>Barcode</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>harga jual</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <th>1</th>
                        <td>928482842848</td>
                        <td>Barang 1</td>
                        <td>1</td>
                        <td>2.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="ml-5 border shadow-lg">
            <div class="m-3">
                <div class="grid w-full grid-cols-1">
                    <b class="ml-5">Bayar: <input type="text" class="p-2 md:ml-5"></b>
                    <b class="ml-5">Sub Total: 2.000</b>
                    <b class="ml-5">Kembali: 2.000</b>
                </div>
            </div>
        </div>
    </div>
@endsection

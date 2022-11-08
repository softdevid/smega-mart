{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cari Barang</title>

    <link href="/css/app.css" rel="stylesheet">
</head>

<body> --}}
@extends('kasir.layouts.template')
@section('content')
    <div class="relative mt-3 overflow-x-auto sm:rounded-lg">
        <table class="mx-auto h-auto justify-center" id="table-datatables">
            <thead class="rounded-lg bg-[#bb1724] text-white">
                <tr>
                    <th class="px-5">#</th>
                    <th class="px-5">Barcode</th>
                    <th class="px-8">Nama Barang</th>
                    <th class="px-5">Jumlah</th>
                    <th class="px-5">harga jual</th>
                    {{-- <th class="px-5">Sub Total</th> --}}
                    <th class="px-5">Aksi</th>
                </tr>
            </thead>
            <tbody id="brg">
                @foreach ($brg as $key => $p)
                    <tr class="w-full border-b bg-white text-center uppercase text-black hover:bg-gray-50">
                        <form action="{{ route('updateQty') }}" method="POST">
                            @csrf
                            <td class="items-center py-3 px-7 dark:text-white">{{ $key + 1 }}</td>
                            <td class="items-center py-3 px-7 dark:text-white">{{ $p->barcode }}</td>
                            <td class="items-center py-3 px-12 dark:text-white">{{ $p->namaBarang }}</td>
                            <td class="items-center py-3 px-7 dark:text-white">
                                <input type="number"
                                    class="block w-14 rounded-lg border border-gray-300 bg-gray-50 px-2.5 py-1 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                    placeholder="1" required="" min="1" value="1" name="jmlhJual"
                                    id="jmlhJual">
                            </td>
                            <td class="items-center py-3 px-7 dark:text-white">{{ $p->hrgJual }}</td>
                            <td>
                                <button type="submit"
                                    class="rounded-md bg-yellow-500 p-1 text-white hover:bg-yellow-700">Update</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $brg->links() }}
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    {{-- <script defer src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script> --}}

    <script>
        $(document).on("click", '#btnTambah', function(e) {
            e.preventDefault();

            var data = {
                'noFakturJualan': $('#noFakturJualan').val(),
                'barcode': $('#barcode').val(),
                'namaBarang': $('#namaBarang').val(),
                'jmlhJual': $('#jmlhJual').val(),
                'hrgJual': $('#hrgJual').val(),
                'hrgBeli': $('#hrgBeli').val()
            }
            var stok = {
                'stok': $('#stok').val(),
            }
            console.log(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.store') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    barcode.value = "";
                    barcodeHidden.value = "";
                    namaBarangHidden.value = "";
                    namaBarang.value = "";
                    hrgJual.value = "";
                    hrgJualHidden.value = "";
                    jmlhJual.value = "";
                    detail();
                    // total();
                    formTransaksi();
                    $('#barcode').focus();


                    setTimeout(function() { // wait for 5 secs(2)
                        location.reload(true); // then reload the page.(3)
                    }, 100);
                }
            })
        });
    </script>
    {{-- </body>

</html> --}}
@endsection

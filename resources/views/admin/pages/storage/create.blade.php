@extends('admin.layouts.template')
@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <div class="mb-4 flex rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-200 dark:text-red-800"
                role="alert">
                <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ $error }}</span>
                </div>
            </div>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-2 gap-6 md:grid-cols-3">
        <div>
            <input type="hidden" id="noFakturBeli" name="noFakturBeli" value="{{ $noFakturBeli }}">
            <input type="text" class="w-full rounded-lg border p-2" placeholder="Barcode" id="barcode" name="barcode"
                autofocus>
            <input type="hidden" id="barcodeHidden" name="barcodeHidden">
            <input type="hidden" id="namaBarang" name="namaBarang">
        </div>
        <div>
            <input type="number" class="w-full rounded-lg border p-2" placeholder="Jumlah stok Toko" min="1"
                id="jmlBeli" name="jmlBeli">
            <input type="hidden" id="jmlBeli" name="jmlBeli">
            <input type="hidden" id="hrgJual" name="hrgJual">
            <input type="hidden" id="hrgBeli" name="hrgBeli">
        </div>
        <div>
            <input type="number" class="w-full rounded-lg border p-2" placeholder="Jumlah Stok Gudang" min="0"
                id="jmlStokGudang" name="jmlStokGudang">
        </div>
        <div>
            <input type="text" class="w-full rounded-lg border bg-gray-100 p-2" placeholder="Nama Barang" disabled
                id="namaBarangHidden">
        </div>
        <div>
            <input type="number" class="w-full rounded-lg border bg-gray-100 p-2" placeholder="Harga Jual" disabled
                id="hrgJualHidden">
        </div>
    </div>
    <button type="submit" class="mx-auto mt-3 rounded-lg bg-green-400 p-2 text-sm text-white hover:bg-green-600"
        id="btnTambah"><i class="fa fa-plus"></i>
        Tambah</button>

    <div class="mx-auto mt-5 grid grid-cols-1 md:grid-cols-2">
        <div>
            <table class="w-full shadow-lg" id="tabelKasir">
                {{-- <input type="number" name="id_user" value="{{ user()->auth()->id }}"> --}}
                <thead class="rounded-lg bg-[#bb1724] text-white">
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Barcode</th>
                        <th>Jumlah</th>
                        <th>harga jual</th>
                        <th>Sub Total</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>

        </div>
        <div class="ml-5 items-center justify-center">
            <div id="formPembelian"></div>
            <input type="hidden" id="kdUser" name="kdUser" value="{{ auth()->user()->kdUser }}">

    {{-- <script src="/js/jquery-3.6.0.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        function numThousand(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        let barcode = document.querySelector("#barcode");
        let barcodelHidden = document.querySelector("#barcodeHidden");
        let jmlStokGudang = document.querySelector("#jmlStokGudang");
        let jmlBeli = document.querySelector("#jmlBeli");

        let namaBarang = document.querySelector("#namaBarang");
        let namaBarangHidden = document.querySelector("#namaBarangHidden");
        let hrgBeli = document.querySelector("#hrgBeli");
        let hrgJual = document.querySelector("#hrgJual");
        let hrgJualHidden = document.querySelector("#hrgJualHidden");

        let btnTambah = document.querySelector("#btnTambah");
        let btnSimpan = document.querySelector("#btnSimpan");
        let total = document.querySelector("#total");
        let kode = document.querySelector("#kode");
        let save = document.querySelector("#save");

        // let tabelKasir = document
        //     .querySelector("#tabelKasir")
        //     .getElementsByTagName("tbody")[0];

        barcode.addEventListener("input", function() {
            fetch(`/kasir-barcode-data?barcode=${barcode.value}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.barang !== null) {
                        barcodelHidden.value = data.barang.barcode;
                        namaBarang.value = data.barang.namaBarang;
                        hrgBeli.value = data.barang.hrgBeli;
                        hrgJual.value = data.barang.hrgJual;

                        // barcodelHidden.value = data.barang.barcode;
                        namaBarangHidden.value = data.barang.namaBarang;
                        hrgJualHidden.value = data.barang.hrgJual;
                        console.log(barcode.value, namaBarang.value, hrgBeli.value, hrgJual.value,
                            namaBarangHidden.value, hrgJualHidden.value);
                    } else {
                        // barcode.value = "";
                        barcodelHidden.value = "";
                        namaBarang.value = "";
                        namaBarangHidden.value = "";

                        hrgBeli.value = "";
                        hrgJual.value = "";
                    }
                })
        });

        $(document).ready(function() {
            detail();
            // total();
            formPembelian();
            // dataSimpan();
            // simpan();
            function detail() {
                $.ajax({
                    type: "GET",
                    url: "/admin/detail/{noFakturBeli}",
                    dataType: "json",
                    success: function(response) {

                        console.log(response.pembelian);
                        // console.log(response.total);

                        $('tbody').html('');
                        $.each(response.pembelian, function(key, item) {
                            $('tbody').append(
                                '<tr class= "border-b bg-white text-black hover:bg-gray-50 text-center w-full">\
                                  <td class="items-center py-3 px-7 dark:text-white">' +item.barcode +'</td>\
                                <td class="items-center py-3 px-7 dark:text-white">' +item.jmlBeli +
                                '</td>\
                                <td class="items-center py-3 px-7 dark:text-white">' +item.hrgJual +
                                '</td>\
                                <td class="items-center py-3 px-7 dark:text-white">' +item.jmlBeli *item.hrgBeli +'</td>\
                                </tr>')
                        });
                    }
                })
            }

            // function total() {
            //     $.ajax({
            //         type: "GET",
            //         url: "/admin/detail/{noFakturBeli}",
            //         dataType: "json",
            //         success: function(response) {

            //             // console.log(response.pembelian);
            //             // console.log(response.total);
            //             $('#total').html('');
            //             $('#total').append(
            //                 '<input type="number" id="total" class="w-full p-2" min="0" value="'+response.total + '" disabled>');
            //         }
            //     })
            // }


            function formPembelian() {
                $.ajax({
                    type: "GET",
                    url: "/admin/detail/{noFakturBeli}",
                    dataType: "json",
                    success: function(response) {
                        $('#formPembelian').html('');
                        $('#formPembelian').append('<div class="m-3">\
                            <div class="grid w-full grid-cols-1">\
                                <div class="my-3">\
                                <div class="grid grid-cols-2 gap-7">\
                                    <b class="text-center">Supplier:</b>\
                                    <select name="kdSupplier" id="kdSupplier" class="w-full rounded-lg border p-2">\
                                        <option value="">Pilih supplier</option>\
                                        @foreach ($supplier as $s)\
                                            <option value="{{ $s->kdSupplier }}">{{ $s->namaSupplier }}</option>\
                                        @endforeach\
                                    </select>\
                                </div>\
                            </div>\
                            <div class="my-3">\
                                <div class="grid grid-cols-2 gap-7">\
                                    <b class="text-center">Bayar:</b>\
                                    <input type="number" class="w-full p-2" id="bayar" name="bayar" required>\
                                </div>\
                            </div>\
                            <div class="my-3">\
                                <div class="grid grid-cols-2 gap-7">\
                                    <b class="text-center">Total:</b>\
                                    <div id="total">'+numThousand(response.total)+'</div>\
                                </div>\
                            </div>\
                            <div class="grid grid-cols-2 gap-7">\
                                <b class="text-center">Kembali:</b>\
                                <div id="kembali"></div>\
                                </div>\
                                </div>\
                                </div>\
                                <input type="hidden" id="kdUser" name="kdUser" value="{{ auth()->user()->kdUser }}">\
                                <div class="grid grid-cols-3 max-w-xs mb-4">\
                                    <input type="hidden" class="w-full p-2" id="tglBeli" min="0" name="tglBeli" value="{{ $tglBeli }}">\
                                <div></div>\
                                <button type="submit" id="btnSimpan" class="w-[150px] text-semibold rounded-lg bg-blue-600 p-2 text-center text-sm text-white">Simpan Transaksi</button>\
                                <div></div>\
                            </div>\
                            </div>\
                        </div>\
                    </div>')
                    }
                })

            }


            $(document).on("input", '#bayar', function(e) {
                e.preventDefault();
                var bayar = {
                    'bayar': $('#bayar').val(),
                }

                $.ajax({
                    type: "GET",
                    url: "/admin/detail/{noFakturBeli}",
                    data: bayar,
                    dataType: "json",
                    success: function(response) {
                        $('#kembali').html('');
                        $('#kembali').append(
                            '<div>' +
                            numThousand(response.kembali) + '</div>');
                    }
                })
            })

            // bayar.addEventListener('keyup', function() {
            //     document.querySelector("#bayar").innerHTML = numThousand(bayar.value);
            // });

            $(document).on("click", '#btnTambah', function(e) {
                e.preventDefault();

                var data = {
                    'noFakturBeli': $('#noFakturBeli').val(),
                    'barcode': $('#barcode').val(),
                    'jmlBeli': $('#jmlBeli').val(),
                    'hrgJual': $('#hrgJual').val(),
                    'hrgBeli': $('#hrgBeli').val(),
                    'jmlStokGudang': $('#jmlStokGudang').val(),
                }
                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('pembelian.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        barcode.value = "";
                        barcodeHidden.value = "";
                        namaBarangHidden.value = "";
                        namaBarang.value = "";
                        hrgJual.value = "";
                        hrgJualHidden.value = "";
                        jmlBeli.value = "";
                        jmlStokGudang.value = "";
                        detail();
                        // total();
                        formPembelian();
                        $('#barcode').attr('autofocus' , 'true');
                    },
                })
            });

            $(document).on("click", '#btnSimpan', function(e) {
                e.preventDefault();

                var data = {
                    'noFakturBeli': $('#noFakturBeli').val(),
                    'tglBeli': $('#tglBeli').val(),
                    'kdSupplier': $('#kdSupplier').val(),
                    'kdUser	': $('#kdUser').val()
                }
                console.log(data);
                if (data.kdSupplier == '') {
                  $('#error').html('');
                  $('#error').append('<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">\
                    <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.\
                    </div>')
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('pembelian.simpan') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        detail();
                        formPembelian();
                    }
                })
            });



        }); //Document stop
    </script>
@endsection

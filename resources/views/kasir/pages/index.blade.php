@extends('kasir.layouts.template')
@section('content')
    {{-- <form action="{{ route('transaksi.store') }}" method="post">
        @csrf --}}

    <div id="error"></div>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
        <div>
            <input type="hidden" id="noFakturJualan" name="noFakturJualan" value="{{ $noFaktur }}">
            <input type="text" class="w-full rounded-lg border p-2" placeholder="Barcode" id="barcode" name="barcode"
                autofocus>
            <input type="hidden" id="barcodeHidden" name="barcodeHidden">
            <input type="hidden" id="namaBarang" name="namaBarang">
        </div>
        <div>
            <input type="number" class="w-full rounded-lg border p-2" placeholder="QTY" min="1" id="jmlhJual"
                name="jmlhJual">
            <input type="hidden" id="qtyHidden" name="qtyHidden">
            <input type="hidden" id="hrgJual" name="hrgJual">
            <input type="hidden" id="hrgBeli" name="hrgBeli">
            <input type="hidden" id="stok" name="stok">
        </div>
        <div>
            <input type="text" class="uppercase w-full rounded-lg border bg-gray-100 p-2" placeholder="Nama Barang" disabled
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
    {{-- <button type="button" class="btnTambah mx-auto mt-3 rounded-lg bg-green-400 p-2 text-sm text-white hover:bg-green-600"
        id="btnTambah"><i class="fa fa-plus"></i>
        Tambah</button> --}}
    {{-- </form> --}}

    <div class="mx-auto mt-5 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2">
        <div class="relative overflow-x-auto sm:rounded-sm mt-5 w-full">
            <table class="shadow-md">
                <thead class="rounded-lg bg-[#bb1724] text-white">
                    <tr>
                        <th class="px-5">#</th>
                        <th class="px-5">Barcode</th>
                        <th class="px-5">Nama Barang</th>
                        <th class="px-5">Jumlah</th>
                        <th class="px-5">harga jual</th>
                        <th class="px-5">Sub Total</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>

        </div>
        <div class="items-center justify-center w-full">
            <div id="formTransaksi"></div>
        </div>
    </div>

    {{-- <script src="/js/jquery-3.6.0.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
    {{-- <script src="/js/kasir.js"></script> --}}

    <script>
        // const { js } = require("laravel-mix");

        // const { data } = require("autoprefixer");

        function numThousand(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        let barcode = document.querySelector("#barcode");
        let barcodeHidden = document.querySelector("#barcodeHidden");
        let qtyHidden = document.querySelector("#qtyHidden");
        let jmlhJual = document.querySelector("#jmlhJual");

        let namaBarang = document.querySelector("#namaBarang");
        let namaBarangHidden = document.querySelector("#namaBarangHidden");
        let hrgBeli = document.querySelector("#hrgBeli");
        let hrgJual = document.querySelector("#hrgJual");
        let hrgJualHidden = document.querySelector("#hrgJualHidden");

        let stok = document.querySelector("#stok");

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
                        barcodeHidden.value = data.barang.barcode;
                        namaBarang.value = data.barang.namaBarang;
                        hrgBeli.value = data.barang.hrgBeli;
                        hrgJual.value = data.barang.hrgJual;
                        stok.value = data.barang.stok;

                        // barcode.value = data.barang.barcode;
                        namaBarangHidden.value = data.barang.namaBarang;
                        hrgJualHidden.value = data.barang.hrgJual;
                        console.log(barcode.value, namaBarang.value, hrgBeli.value, hrgJual.value,
                            namaBarangHidden.value, hrgJualHidden.value, stok.value);
                    } else {
                        barcodeHidden.value = "";
                        namaBarang.value = "";
                        namaBarangHidden.value = "";

                        hrgBeli.value = "";
                        hrgJual.value = "";
                    }
                })
        });

        $(document).ready(function() {
            detail();
            total();
            formTransaksi();
            // dataSimpan();
            // simpan();
            function detail() {
                $.ajax({
                    type: "GET",
                    url: "/kasir/detail/{noFakturJualan}",
                    dataType: "json",
                    success: function(response) {
                        $('tbody').html('');
                        $.each(response.penjualan, function(key, item) {
                            $('tbody').append(
                                '<tr class= "uppercase border-b bg-white text-black hover:bg-gray-50 text-center w-full">\
                                              <td class="items-center py-3 px-7 dark:text-white">' + parseInt(key + 1) + '</td>\
                                              <td class="items-center py-3 px-7 dark:text-white">' + item.barcode + '</td>\
                                              <td class="items-center py-3 px-7 dark:text-white">' + item.namaBarang + '</td>\
                                              <td class="items-center py-3 px-7 dark:text-white">' + item.jmlhJual + '</td>\
                                              <td class="items-center py-3 px-7 dark:text-white">' + item.hrgJual + '</td>\
                                              <td class="items-center py-3 px-7 dark:text-white">' + item.jmlhJual * item
                                .hrgJual + '</td>\
                                              </tr>')
                        })
                    }
                })
            }

            function total() {
                $.ajax({
                    type: "GET",
                    url: "/kasir/detail/{noFakturJualan}",
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.penjualan);
                        $('#total').html('');
                        $('#total').append(
                            '<div name="total" id="Total">'+ numThousand(response.total) +'</div>\
                            <input type="hidden" class="w-full p-2" id="total" name="Total" value="' + response.total +'" disabled>');
                    }
                })
            }


            function formTransaksi() {
                $.ajax({
                    type: "GET",
                    url: "/kasir/detail/{noFakturJualan}",
                    dataType: "json",
                    success: function(response) {
                      console.log(response.poin);

                        $('#formTransaksi').html('');
                        $('#formTransaksi').append(
                            '<form action="{{ route('transaksi.simpan') }}" method="POST">\
                              @csrf\
                                  <div class="m-3">\
                                        <div class="grid w-full grid-cols-1">\
                                            <div class="my-3">\
                                                <div class="grid grid-cols-2 gap-7">\
                                                    <b class="text-center">Pelanggan ?</b>\
                                                    <select name="Kd_Pelanggan" id="Kd_Pelanggan">\
                                                  <option value="">Pilih Pelanggan ?</option>\
                                                  @foreach ($pelanggan as $p)\
                                                      <option value="{{ $p->kdPelanggan }}">{{ $p->namaPelanggan }}</option>\
                                                  @endforeach\
                                              </select>\
                                                </div>\
                                            </div>\
                                            <div class="my-3">\
                                                <div class="grid grid-cols-2 gap-7">\
                                                    <b class="text-center">Bayar:</b>\
                                                    <input type="number" class="w-full p-2" id="bayar" name="Bayar">\
                                                </div>\
                                            </div>\
                                            <div class="my-3">\
                                                <div class="grid grid-cols-2 gap-7">\
                                                    <b class="text-center">Total:</b>\
                                                    <div id="total">'+ numThousand(response.total) +'</div>\
                                                    <input type="hidden" class="w-full p-2" id="total" name="Total" value="' + response.total +'">\
                                                </div>\
                                            </div>\
                                            <div class="my-3">\
                                                <div class="grid grid-cols-2 gap-7">\
                                                  <b class="text-center">Kembali:</b>\
                                                  <div id="kembali"></div>\
                                                    {{-- <input type="hidden" class="w-full p-2" name="Kd_Pelanggan" id="Kd_Pelanggan" value="1" min="0" disabled>\ --}}\
                                                    <div id="total"></div>\
                                                </div>\
                                            </div>\
                                            </div>\
                                            <input type="hidden" id="noFakturJualan" name="No_Faktur_Jual" value="{{ $noFaktur }}">\
                                          <input type="hidden" id="Kd_User" name="Kd_User" value="{{ auth()->user()->kdUser }}">\
                                          <input type="hidden" id="poin" name="poin" value="'+response.poin+'">\
                                          <input type="hidden" class="w-full p-2" id="Tgl_Jual" min="0" name="Tgl_Jual" value="{{ $Tgl_Jual }}">\
                                          <div class="grid grid-cols-2 gap-7">\
                                            <div></div>\
                                            <button type="submit" href="/kasir/show" id="btnSimpan"class="text-semibold rounded-lg bg-blue-600 p-2 text-center text-sm text-white">Simpan Transaksi</button>\
                                            <div></div>\
                                          </div>\
                                        </form>')
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
                    url: "/kasir/detail/{noFakturJualan}",
                    data: bayar,
                    dataType: "json",
                    success: function(response) {
                        $('#kembali').html('');
                        $('#kembali').append(
                            '<div>'+ numThousand(response.kembali) +'</div>');
                    }
                })
            })

            // bayar.addEventListener('keyup', function() {
            //     document.querySelector("#bayar").innerHTML = numThousand(bayar.value);
            // });

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

                // if (stok.stok == '0') {
                //   $('#error').html('');
                //   $('#error').append('<div id="alert-2" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">\
                //     <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>\
                //     <span class="sr-only">Info</span>\
                //     <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">\
                //      Stok kosong tidak bisa di tambahkan\
                //     </div>\
                //     <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-dismiss-target="#alert-2" aria-label="Close">\
                //       <span class="sr-only">Close</span>\
                //       <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>\
                //     </button>\
                //   </div>');
                // }

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
                    }
                })
            });

            // $(document).on("click", '#btnSimpan', function(e) {
            //     e.preventDefault();

            //     var data = {
            //         'No_Faktur_Jual': $('#noFakturJualan').val(),
            //         'Tgl_Jual': $('#Tgl_Jual').val(),
            //         'Kd_Pelanggan': $('#Kd_Pelanggan').val(),
            //         'Total': $('#total').val(),
            //         'Bayar': $('#bayar').val(),
            //         'Kd_User': $('#Kd_User').val(),
            //         'poin': $('#poin').val()
            //     }
            //     console.log(data);

            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });

            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('transaksi.simpan') }}",
            //         data: data,
            //         dataType: "json",
            //         success: function(response) {
            //             detail();
            //             formTransaksi();
            //             window.location.href = '/selesai';
            //         }
            //     })
            // });

            // $(document).on("click", '#btnSimpan', function(e) {
            //     e.preventDefault();

            // });

        }); //Document stop
    </script>
@endsection

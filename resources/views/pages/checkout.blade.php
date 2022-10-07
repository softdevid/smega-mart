@extends('layouts.layout-main')
@section('content')
    <h1 class="text-center text-3xl">Checkout</h1>
    <div class="mx-auto mt-2 h-[2px] w-[100px] bg-black"></div>

    {{-- alamat pengirim --}}
    <div class="container rounded-lg border-t-4 bg-white py-5 shadow-lg">
        <div class="m-3">

            <div class="text-red-700"><i class="fa fa-location-dot"></i> Alamat Pengiriman</div>

            <div class="mt-2 grid grid-cols-1 md:grid-cols-2">
                <div>{{ auth()->user()->namaUser }} ({{ auth()->user()->no_hp }}) </div>
                <div>{{ auth()->user()->kabupaten }}, {{ auth()->user()->kecamatan }}, {{ auth()->user()->desa }},
                    {{ auth()->user()->alamat_lengkap }}</div>
            </div>


        </div>
    </div>

    {{-- form checkout --}}

    {{-- produk --}}
    <div class="container mt-3 rounded-lg border-t-4 bg-white py-5 shadow-lg">
        <div class="m-3">

            <div class="text-red-700"><i class="fa fa-box"></i> Produk dipesan</div>

            <div class="mt-2 grid grid-cols-1">
                <div class="container">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        #
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Image</span>
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Product
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Qty
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Price
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        SubTotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brg as $key => $b)
                                    <form action="{{ route('order.update', [$b->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" value="{{ $b->id }}" name="id[]" id="id[]">
                                        <tr
                                            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                            <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="w-32 p-4">
                                                @if ($b->barang->img_urls == null)
                                                    <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663833101/products/produk_fwzfro.jpg"
                                                        alt="Apple Watch" class="h-8 w-8">
                                                @else
                                                    <img src="{{ $b->barang->img_urls }}" alt="Apple Watch" class="h-8 w-8">
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                {{ $b->namaBarang }}
                                            </td>
                                            <td class="mx-auto items-center justify-between py-4 px-6">
                                                <div>
                                                    <input type="number" id="first_product"
                                                        class="block w-14 rounded-lg border border-gray-300 bg-gray-50 px-2.5 py-1 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                                        placeholder="1" required="" min="1"
                                                        value="{{ $b->qty }}">
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                Rp. {{ number_format($b->hrgJual, 0, ',', '.') }}
                                            </td>
                                            <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                                Rp. {{ number_format($b->qty * $b->hrgJual, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- <input type="hidden" value="{{ $noFaktur }}" id="No_Faktur_Jualan" name="No_Faktur_Jualan">
                <input type="hidden" value="{{ $Tgl_Jual }}" id="Tgl_Jual" name="Tgl_Jual">
                <input type="hidden" value="0" id="Kd_Pelanggan" name="Kd_Pelanggan">
                <input type="hidden" value="{{ $total }}" id="total" name="total">
                <input type="hidden" value="0" id="Bayar" name="Bayar">
                <input type="hidden" value="{{ auth()->user()->kdUser }}" id="Kd_User" name="Kd_User">
                <input type="hidden" value="0" id="poin" name="poin">
                <input type="hidden" value="1" id="metode_bayar" name="metode_bayar">
                <input type="hidden" value="1" id="status" name="status"> --}}


        </div>
    </div>

    {{-- total bayar --}}

    <div class="container mt-3 rounded-lg border-t-4 bg-white py-5 shadow-lg">
        <div class="m-3">

            <div class="text-center">
                <div class="mt-4 text-sm text-red-700"><i class="fa fa-money"></i> Metode bayar Cash on delivery / bayar
                    ditempat
                    khusus
                    wilayah
                    purbalingga!</div>
                {{-- <div class="mt-4 bg-red-700 text-sm text-white">Pemesanan di online shop ini khusus wilayah
                    kabupaten
                    purbalingga!</div> --}}
            </div>

            <div class="mt-4 text-right">
                <span class="mt-4">Subtotal prouk: Rp. <span
                        class="text-red-700">{{ number_format($total, 0, ',', '.') }}</span></span><br>

                <span class="mt-4">Biaya aplikasi: Rp. <span class="text-red-700">1.000</span></span><br>
                <span class="mt-4">Total pembayaran: Rp. <span
                        class="text-red-700">{{ number_format($total + 1000, 0, ',', '.') }}</span></span><br>

                <a href="/cart" class="rounded-lg bg-gray-700 p-2 text-white hover:bg-gray-800 md:p-3">Batal
                    Checkout</a>
                <button type="submit" class="mt-3 rounded-lg bg-red-600 p-2 text-white hover:bg-red-800 md:p-3"
                    onclick="return confirm('barang yang sudah dipesan tidak dapat dibatalkan!')">Pesan</button>
            </div>

        </div>
    </div>

    </form>
@endsection

@push('script')
    <script>
        $(document).ready(function() {


            $(document).on("click", '#btnSimpan', function(e) {
                e.preventDefault();

                var status = {
                    'status': $('#status').val(),
                }

                var data = {
                    'No_Faktur_Jual': $('#noFakturJualan').val(),
                    'Tgl_Jual': $('#Tgl_Jual').val(),
                    'Kd_Pelanggan': $('#Kd_Pelanggan').val(),
                    'Total': $('#Total').val(),
                    'Bayar': $('#Bayar').val(),
                    'Kd_User': $('#Kd_User').val(),
                    'poin': $('#poin').val(),
                    'metode_bayar': $('#metode_bayar').val(),
                    'status': $('#status').val(),
                }
                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/pesan",
                    data: status,
                    dataType: "json",
                    success: function(response) {
                        $('#success').html('');
                        $('#success').append('<div id="alert-3" class="mb-4 flex rounded-lg bg-green-100 p-4 dark:bg-green-200" role="alert">\
                                                                                  <svg aria-hidden="true" class="h-5 w-5 flex-shrink-0 text-green-700 dark:text-green-800" fill="currentColor"\
                                                                                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">\
                                                                                      <path fill-rule="evenodd"\
                                                                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"\
                                                                                            clip rule="evenodd"></path>\
                                                                                            </svg> \
                                                                                            span class = "sr-only" > Info < /span>\
                                                                                            <div class ="ml-3 text-sm font-medium text-green-700 dark:text-green-800" >\
                                                                                            Pesanan sedang diproses, menunggu konfirmasi!\
                                                                                            </div>\
                                                                                            <div>')
                    }
                })
            });


        }); //end document ready
    </script>
@endpush

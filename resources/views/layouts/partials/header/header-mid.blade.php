<div class="bg-white pt-2 lg:pt-0">
    <div class="container">
        <nav class="px-3 py-2 lg:py-3">
            <div class="container relative mx-auto flex flex-wrap items-center justify-between">
                <a href="/" class="px-2">
                    <span class="self-center whitespace-nowrap font-oswald text-3xl font-semibold">SMEGA MART</span>
                </a>
                {{-- <div class="px-2 md:basis-8/12">
                    <button type="button"
                        class="tex-gray-500 mr-1 rounded-lg p-2.5 text-sm hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 md:hidden"
                        data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false">
                        <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Cari</span>
                    </button>
                    <div class="relative hidden items-center md:block">
                        <div class="relative mt-3 md:mt-0">
                            <form>
                                <div class="flex">
                                    <select id="countries"
                                        class="z-10 hidden flex-shrink-0 items-center rounded-l-lg border border-gray-300 bg-gray-100 py-2.5 pl-1 pr-3 text-center text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 sm:inline-flex sm:border-r-0">
                                        <option selected="">Kategori</option>
                                        @foreach (App\Models\Kategori::select('namaKategori', 'slug')->get() as $kategori)
                                            <option value="{{ $kategori->slug }}">{{ $kategori->namaKategori }}</option>
                                        @endforeach
                                    </select>
                                    <div class="relative w-full">
                                        <input type="search" id="search-dropdown"
                                            class="z-20 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-[#c51826] focus:ring-[#c51826] sm:rounded-l-none"
                                            placeholder="Cari produk...">
                                        <button type="submit"
                                            class="absolute top-0 right-0 rounded-r-lg border border-[#bb1724] bg-[#bb1724] p-2.5 text-sm font-medium text-white hover:bg-[#ac1521] focus:outline-none focus:ring-4 focus:ring-red-300">
                                            <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                            <span class="sr-only">Cari</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="navbar-search"
                    class="absolute top-9 left-0 z-10 hidden w-full items-center justify-between md:hidden">
                    <div class="relative mt-3">
                        <form>
                            <div class="flex">
                                <select id="countries"
                                    class="z-10 hidden flex-shrink-0 items-center rounded-l-lg border border-gray-300 bg-gray-100 py-2.5 pl-1 pr-3 text-center text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 sm:inline-flex sm:border-r-0">
                                    <option selected="">Kategori</option>
                                    @foreach (App\Models\Kategori::select('namaKategori', 'slug')->get() as $kategori)
                                        <option value="{{ $kategori->slug }}">{{ $kategori->namaKategori }}</option>
                                    @endforeach
                                </select>
                                <div class="relative w-full">
                                    <input type="search" id="search-dropdown"
                                        class="z-20 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-lg focus:border-[#c51826] focus:ring-[#c51826] sm:rounded-l-none"
                                        placeholder="Cari produk...">
                                    <button type="submit"
                                        class="absolute top-0 right-0 rounded-r-lg border border-[#bb1724] bg-[#bb1724] p-2.5 text-sm font-medium text-white hover:bg-[#ac1521] focus:outline-none focus:ring-4 focus:ring-red-300">
                                        <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <span class="sr-only">Cari</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <div id="cartsum"></div>
            </div>
        </nav>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    function numThousand(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    let addCart = document.querySelector("#addCart");

    $(document).ready(function() {

        cartsum();
        stok();

        // $(document).on("click", "#addCart", function(e) {
        //     e.preventDefault();

        //     var data = {
        //         'noFaktur': $('#noFaktur').val(),
        //         'barcode': $('#barcode').val(),
        //         'namaBarang': $('#namaBarang').val(),
        //         'hrgJual': $('#hrgJual').val(),
        //         'qty': $('#qty').val(),
        //         'status': $('#status').val(),
        //         'kdUser': $('#kdUser').val()
        //     }
        //     console.log(data);

        //     if (data.kdUser == '') {
        //         $('#message').html('');
        //         $('#message').append('<div class="mb-4 flex rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-200 dark:text-red-800" role="alert">\
        //     <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"\
        //                                                                           xmlns="http://www.w3.org/2000/svg">\
        //     <path fill-rule="evenodd"\
        //     d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"\
        //                                                                               clip-rule="evenodd"></path>\
        // </svg>\
        // <span class="sr-only">Info</span>\
        // <div>\
        //   <ul>\
        //     Login terlebih dahulu\
        //   </ul>\
        // </div>\
        // </div > ');
        //     }

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('order.store') }}",
        //         data: data,
        //         dataType: "json",
        //         success: function(response) {
        //             cartsum();
        //             stok();
        //             if (response) {
        //                 $('#success').html('');
        //                 $('#success').append('<div id="alert-3" class="mb-4 flex rounded-lg bg-green-100 p-4 dark:bg-green-200" role="alert">\
        //           <svg aria-hidden="true" class="h-5 w-5 flex-shrink-0 text-green-700 dark:text-green-800" fill="currentColor"\
        //               viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">\
        //               <path fill-rule="evenodd"\
        //                   d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"\
        //                   clip-rule="evenodd"></path>\
        //           </svg>\
        //           <span class="sr-only">Info</span>\
        //           <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">\
        //               Barang berhasil ditambah ke keranjang\
        //           </div>\
        //           </div>')
        //             }
        //         }
        //     })

        // });

        function cartsum() {
            $.ajax({
                type: "GET",
                url: "/cartsum",
                dataType: "json",
                success: function(response) {
                    $('#cartsum').html('');
                    $('#cartsum').append('<a href="/cart" class="flex">\
                                                <i class="fa-solid fa-cart-shopping"></i>\
                                                <span class="order-1 text-blue-600" id="cartsum">' +
                        response
                        .cartsum + '</span>\
                                            </a>')
                },
            })
        }

        $(document).on("input", "#qty", function(e) {
            $.ajax({
                type: "GET",
                url: "/cartsum/{kdUser}",
                dataType: "json",
                success: function(response) {
                    $('#cartsum').html('');
                    $('#cartsum').append('<a href="/cart" class="flex">\
                                                <i class="fa-solid fa-cart-shopping"></i>\
                                                <span class="z-10 order-1 text-blue-600" id="cartsum">' +
                        response
                        .cartsum + '</span>\
                                            </a>')
                },
            })
        })

    }); //end document
</script>

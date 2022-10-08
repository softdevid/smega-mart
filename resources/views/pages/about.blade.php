@extends('layouts.layout-main')
@section('content')
    <div
        class="mx-auto h-[200px] w-full max-w-screen-xl rounded-lg bg-black/[0.5] bg-[url('/assets/img/tampak-depan.jpg')] bg-cover bg-center bg-blend-multiply">
        <div class="flex items-start md:justify-center">
            <div class="my-[45%] ml-3 text-sm font-bold text-white xs:my-[30%] sm:my-[25%] md:my-3 md:ml-0 md:text-4xl">
                Smega Mart
            </div>
        </div>
    </div>
    <div class="container mx-auto mt-5 w-full max-w-screen-xl">
        <article
            class="rounded-lg text-center text-black hover:border-r-8 hover:border-b-8 hover:border-[#bb1724] hover:bg-white hover:shadow-md">
            <div class="container items-center text-center">
                <i class="fa fa-quote-left"></i> <b>Smega Mart</b> adalah toko retail yang berada di
                lingkungan
                SMK N 1
                Purbalingga. Smega Mart menyediakan
                berbagai macam kebutuhan sehari-hari. Disini bukan hanya makanan saja yang diperjual belikan ada juga yang
                lain
                seperti sepatu dan alat tulis ada juga layanan pembelian pulsa. Smega Mart bekerja sama dengan Alfamart
                untuk membangun trafik ekonomi yang
                menjanjikan. Memberi kemudahan bagi masyarakat terdekat dan juga siswa siswi SMK N 1 Purbalingga. <i
                    class="fa fa-quote-right"></i><br>

            </div>
        </article>
    </div>

    <div class="container mx-auto mt-5 w-full max-w-screen-xl">
        <div class="m-3">
            <h1 class="m-5 mt-10 text-center text-2xl text-[#bb1724]">Area Pelayanan</h1>
            <div class="mx-auto -mt-4 h-[2px] w-[100px] bg-black"></div>
            <article class="mt-3">
                Kami menyediakan produk sehari-hari seperti makanan ringan, minuman, alat tulis dan lainnya.
                Kami melayani warga SMK N 1 PURBALINGGA dan masyarakat sekitar dan juga melayani secara online
                untuk wilayah Kabupaten Purbalingga khususnya kecamatan Kalimanah.
            </article>
        </div>
    </div>

    <h1 class="m-5 mt-10 text-center text-2xl text-[#bb1724]">Beberapa foto produk dari kami</h1>
    <div class="mx-auto -mt-4 h-[2px] w-[100px] bg-black"></div>
    <div
        class="container mx-auto mt-5 grid w-full max-w-screen-xl grid-cols-1 items-center gap-6 rounded-lg md:grid-cols-3">
        <div class="w-ful mx-auto h-auto items-center justify-center rounded-lg bg-white shadow-lg">
          <a class="glightbox" href="https://res.cloudinary.com/smegamart-softdev/image/upload/v1665195570/layer%20utama/IMG_20220926_103841_hxqhgl.jpg">
            <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1665195570/layer%20utama/IMG_20220926_103841_hxqhgl.jpg"
                  alt="pd1"
                  class="h-auto w-[300px] rounded-lg border-4 border-[#bb1724] shadow-lg hover:border-gray-400">
          </a>
        </div>
        <div class="w-ful mx-auto h-auto items-center justify-center rounded-lg bg-white shadow-lg">
          <a class="glightbox" href="https://res.cloudinary.com/smegamart-softdev/image/upload/v1665045845/layer%20utama/IMG_20220926_111516_wb2lnk.jpg">
              <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1665045845/layer%20utama/IMG_20220926_111516_wb2lnk.jpg"
                  alt="pd2"
                  class="h-auto w-[300px] rounded-lg border-4 border-[#bb1724] shadow-lg hover:border-gray-400">
          </a>
        </div>
        <div class="w-ful mx-auto h-auto items-center justify-center rounded-lg bg-white shadow-lg">
          <a class="glightbox" href="https://res.cloudinary.com/smegamart-softdev/image/upload/v1665045845/layer%20utama/IMG_20220926_102024_tq8xwk.jpg">
              <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1665045845/layer%20utama/IMG_20220926_102024_tq8xwk.jpg"
                  alt="pd3"
                  class="h-auto w-[300px] rounded-lg border-4 border-[#bb1724] shadow-lg hover:border-gray-400">
          </a>
        </div>
    </div>

    <div class="border-b border-[#bb1724] bg-gray-100 mt-5 p-3">
        <h1 class="m-5 mt-10 text-center text-2xl text-[#bb1724]">Mitra kami</h1>
        <div class="mx-auto -mt-4 h-[2px] w-[100px] bg-black"></div>
        <div class="grid grid-cols-3">
            <div class="flex justify-center items-center mx-auto my-5">
                <a target="_blank" href="https://alfamart.co.id/">
                    {{-- <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663380858/layer%20utama/alfamart_v1bsvp.png"
                        alt="" class="h-auto w-20 md:w-40"> --}}
                    <img src="{{ asset('assets/img/alfamart.png') }}"
                      alt="alfamart" class="h-auto w-20 md:w-40">
                </a>
            </div>
            <div class="mx-auto my-5">
                <a target="_blank" href="https://smkn1purbalingga.sch.id/">
                    {{-- <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1663380856/layer%20utama/smk_wgvroa.png"
                        alt="" class="h-auto w-20 md:w-40"> --}}
                    <img src="{{ asset('assets/img/smk.png') }}"
                      alt="smega" class="h-auto w-20 md:w-40">
                </a>
            </div>
            <div class="mx-auto my-5">
                <a target="_blank" href="https://softdev.akriliklasercutting.com">
                  {{-- <img src="https://res.cloudinary.com/smegamart-softdev/image/upload/v1664866996/layer%20utama/softdev_rbrfzu.png"
                      alt="" class="mt-3 h-auto w-20 md:w-40"> --}}
                    <img src="{{ asset('assets/img/softdev.png') }}"
                    alt="sofdevcom" class="mt-3 h-auto w-20 md:w-40">
                </a>
            </div>
        </div>
    </div>
@endsection

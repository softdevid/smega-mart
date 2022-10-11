<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gambar;
use App\Models\Keranjang;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Penjualan;
// use App\Models\RinciOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

  public function index()
  {
    return view('pages.home', [
      "title" => "Beranda",
    ]);
  }

  public function product()
  {
    $title = "Produk";

    if (request()->ajax()) {
      return view('pages.product.products-grid', [
        "products" => Barang::latest()->paginate(8)->withQueryString(),
      ])->render();
    }

    return view('pages.product.products', [
      "title" => $title,
      "products" => Barang::latest()->paginate(8)->withQueryString(),
    ]);
  }

  public function cartSum()
  {
    $cartsum = Keranjang::where(['kdUser' => auth()->user()->kdUser ?? ''])->sum('qty');
    return response()->json([
      'cartsum' => $cartsum,
    ]);
  }

  public function productDetail(Barang $product)
  {
    $images = Gambar::where('barcode', $product->barcode)->get();

    return view('pages.product.product-detail', [
      "title" => $product->namaBarang,
      "product" => $product,
      "images" => $images,
      // "noFaktur" => $noFaktur,
    ]);
  }

  public function about()
  {
    return view('pages.about', [
      "title" => "Tentang Kami",
    ]);
  }

  public function contact()
  {
    return view('pages.contact', [
      "title" => "Kontak Kami",
    ]);
  }

  public function gallery()
  {

    $galleryImg = \File::allFiles(public_path('assets/img/gallery'));

    return view('pages.gallery', [
      "title" => "Galeri",
      "images" => $galleryImg,
    ]);
  }

  public function cart()
  {
    $brg = Keranjang::where(['kdUser' => auth()->user()->kdUser ?? ''])->orderBy('id')->get();
    $total = $brg->sum('subtotal');
    return view('pages.cart', [
      'title' => 'Keranjang',
      'brg' => $brg,
      'total' => $total,
    ]);
  }

  public function profil()
  {
    return view('pages.profile', [
      'title' => 'Profil saya',
    ]);
  }
}

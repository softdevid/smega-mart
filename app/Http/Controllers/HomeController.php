<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gambar;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\RinciOrder;
use Illuminate\Http\Request;

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
    $cartsum = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 0])->sum('qty');
    return response()->json([
      'cartsum' => $cartsum,
    ]);
  }

  public function productDetail(Barang $product)
  {
    $date = date('Y-m-d', strtotime(Carbon::now()));
    $no = RinciOrder::count() + 1;
    $noFaktur = "SM-" . $date . $no;
    $images = Gambar::where('barcode', $product->barcode)->get();

    // if (request('kdUser')) {
    //   $cartsum = Order::where(['kdUser' => $kdUser, 'status' => 0])->count(),
    // }

    return view('pages.product.product-detail', [
      "title" => $product->namaBarang,
      "product" => $product,
      "images" => $images,
      "noFaktur" => $noFaktur,
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
}

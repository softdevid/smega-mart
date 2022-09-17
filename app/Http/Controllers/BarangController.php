<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Kategori;
use App\Models\Gambar;
use App\Models\Suplier;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin.pages.product.index', [
      'title' => 'Produk',
      'products' => Barang::all(),
    ]);
  }

  public function list()
  {
    return Barang::all();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.pages.product.create', [
      'title' => 'Tambah Produk',
      'satuan' => Satuan::all(),
      'kategori' => Kategori::all(),
      'supplier' => Suplier::all(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Validator::make($request->all(), [
    //   'nama' => 'required|unique:databarang|max:255',
    //   'cloud_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    //   'img_urls' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //   'barcode' => 'max:18|unique:databarang',
    // ])->validate();
    // dd($request->all());

    if ($request->hasFile("cloud_img")) {
      $file = $request->file('cloud_img');
      $image = Cloudinary::upload($file->getRealPath(), ['folder' => 'products']);
      $public_id = $image->getPublicId();
      $url = $image->getSecurePath();

      // dd($url, $public_id);
      $barang = Barang::create([
        'barcode' => $request->barcode,
        'namaBarang' => $request->namaBarang,
        'slug' => Str::slug($request->namaBarang),
        'kdKategori' => $request->kdKategori ?? '-',
        'kdSatuan' => $request->kdSatuan ?? '-',
        'kdSupplier' => $request->kdSupplier ?? '-',
        'hrgBeli' => $request->hrgBeli,
        'hrgJual' => $request->hrgJual,
        'stok' => $request->stok,
        'stok_gudang' => $request->stok_gudang,
        'deskripsi' => $request->deskripsi ?? '-',
        'cloud_img' => $public_id,
        'img_urls' => $url,
      ]);
    }
    if ($request->hasFile("images")) {
      $file = $request->file('images');
      foreach ($file as $key => $file) {
        $images = Cloudinary::upload($file->getRealPath(), ['folder' => 'products']);
        $public_id = $images->getPublicId();
        $url = $images->getSecurePath();
        Gambar::create([
          'cloud_img' => $public_id,
          'img_urls' => $url,
          'barcode' => $request->barcode,
        ]);
      }
    }
    return back()->with('success', 'Berhasil ditambah');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $barang =  Barang::findOrFail($id);
    return view('admin.pages.product.detail', [
      'title' => 'Detail',
      'product' => $barang,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($barcode)
  {
    $supplier = Suplier::all();
    $kategori = Kategori::all();
    $satuan = Satuan::all();
    $barang = Barang::findOrFail($barcode);
    // dd($barang);
    return view('admin.pages.product.edit', [
      'title' => 'Edit Produk',
      'barang' => $barang,
      'satuan' => $satuan,
      'kategori' => $kategori,
      'supplier' => $supplier,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($barcode)
  {
    $barang = Barang::findOrFail($barcode);

    $images = Gambar::where("barcode", $barang->barcode)->get();
    // dd($images);
    foreach ($images as $image) {
      Cloudinary::destroy($image->cloud_img);
    }
    Gambar::where("barcode", $barang->barcode)->delete();

    $cloud_img = $barang->cloud_img;
    Cloudinary::destroy($cloud_img);

    Barang::destroy($barcode);
    return back()->with('success', 'Berhasil dihapus!!');
  }

  public function deletecover($barcode)
  {
    $product = Barang::findOrFail($barcode);
    // dd($product);

    Cloudinary::destroy($product->cloud_img);

    $a = [
      'cloud_img' => "",
      'img_urls' => "",
    ];

    $product->where('barcode', $product->barcode)
      ->update($a);
    // $product->where('id', $product->id)
    //         ->update($url);

    return back()->with('success', 'Gambar Utama Berhasil dihapus!!');
  }
}

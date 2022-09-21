<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class StorageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin.pages.storage.index', [
      'title' => 'Gudang',
      'products' => Barang::all(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // update stok toko

    $product = Barang::findOrFail($id);
    return view('admin.pages.storage.stock_toko', [
      'title' => 'Tambah stok ke toko',
      'product' => $product,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //update stok Gudang

    return view('admin.pages.storage.stock_gudang', [
      'title' => 'Tambah stok ke gudang',
      'product' => Barang::findOrFail($id),
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
    $product = Barang::findOrFail($id);
    if ($request->stock_toko) {
      $product->update([
        'stok' => $request->stock_toko + $product->stok,
        'stok_gudang' => $product->stok_gudang - $request->stock_toko,
      ]);
    }

    if ($request->stock_gudang) {
      $product->update([
        'stok_gudang' => $product->stok_gudang + $request->stock_gudang,
      ]);
    }

    return back();
    // return redirect()->to('storage')->with('success', 'Stok berhasil diupdate');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}

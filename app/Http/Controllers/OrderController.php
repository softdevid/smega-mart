<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Penjualan;
use Carbon\Carbon;

class OrderController extends Controller
{
  public function index()
  {
    return view('kasir.pages.order.index', [
      'title' => 'Pesanan',
    ]);
  }

  public function store(Request $request)
  {
    $brg = Barang::find($request->barcode);

    if ($request->stok <= 0) {
      return back()->with('error', 'Stok barang kosong tidak bisa ditambahkan');
    }

    $request->validate(
      [
        'noFaktur' => 'required',
        'barcode' => 'required',
        'namaBarang' => 'required',
        'hrgJual' => 'required',
        'qty' => 'required',
        'status' => 'required',
        'kdUser' => 'required',
        'subtotal' => 'required',
      ],
      [
        'kdUser.required' => 'Login terlebih dahulu',
      ]
    );
    // dd($request->all());

    // $validated = $request->validate($request->all());
    Order::create([
      'noFaktur' => $request->noFaktur,
      'barcode' => $request->barcode,
      'namaBarang' => $request->namaBarang,
      'hrgJual' => $request->hrgJual,
      'qty' => $request->qty,
      'status' => $request->status,
      'kdUser' => $request->kdUser,
      'subtotal' => $request->qty * $request->hrgJual,
    ]);

    // return response()->json('succes', 200);
    return back()->with('success', 'Berhasil di tambah ke keranjang!');
  }

  public function detailProduct(Request $request)
  {
    $barcode = $request->barcode;
    $brg = Barang::where('barcode', $barcode)->get();
    return response()->json([
      'stok' => $brg->stok,
      'brg' => $brg,
    ]);
  }

  public function destroy($id)
  {
    Order::destroy($id);
    return back()->with('success', 'Barang berhasil dihapus dari keranjang!');
  }

  public function checkout()
  {
    $Tgl_Jual = date('Y-m-d', strtotime(Carbon::now()));
    $brg = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 0])->orderBy('id')->get();
    foreach ($brg as $key => $b) {
      $noFaktur = $b->noFaktur;
    }
    // dd($brg);
    $date = date('Y-m-d', strtotime(Carbon::now()));
    // $noFaktur = $brg->noFaktur;
    // dd($noFaktur);
    return view('pages.checkout', [
      'title' => 'Checkout',
      'brg' => $brg,
      'total' => $brg->sum('subtotal'),
      'noFaktur' => $noFaktur,
      'Tgl_Jual' => $Tgl_Jual,
    ]);
  }

  public function update(Request $request)
  {
    $id = $request->id;

    Order::where('id', $id)
      ->update(['status' => 1]);

    return redirect()->to('/pesanan')->with('success', 'Pesanan sedang diproses!');
  }

  public function pesanan() //ini diproses
  {
    $brg = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 1])->orderBy('id')->get();
    $brgKemas = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 2])->orderBy('id')->get();
    return view('pages.pesanan', [
      'title' => 'Pesanan',
      'brg' => $brg,
      'brgKemas' => $brgKemas,
      'total' => $brg->sum('subtotal'),
    ]);
  }

  public function dikemas()
  {
    $brgKemas = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 2])->orderBy('id')->get();
    return view('pages.pesanan', [
      'title' => 'Pesanan',
      'brg' => $brgKemas,
      'total' => $brgKemas->sum('subtotal'),
    ]);
  }
}

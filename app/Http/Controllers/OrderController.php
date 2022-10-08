<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Penjualan;
use App\Models\RinciOrder;
use Carbon\Carbon;

class OrderController extends Controller
{
  public function index()
  {
    $brg = Order::where(['status' => 1])->get();
    return view('kasir.pages.order.index', [
      'title' => 'Pesanan',
      'brg' => $brg,
    ]);
  }

  public function store(Request $request)
  {
    // dd($request->all());
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
    $order = Order::create([
      'noFaktur' => $request->noFaktur,
      'barcode' => $request->barcode,
      'namaBarang' => $request->namaBarang,
      'hrgJual' => $request->hrgJual,
      'qty' => $request->qty,
      'kdUser' => $request->kdUser,
      'subtotal' => $request->qty * $request->hrgJual,
    ]);

    RinciOrder::create([
      'noFaktur' => $order->noFaktur,
      'qty' => $order->qty,
      'status' => $request->status,
      'status_bayar' => $request->status_bayar,
      'kdUser' => $order->kdUser,
      'subtotal' => $order->sum('subtotal'),
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
    $brg = Order::where('id', $id)->get();
    foreach ($brg as $key => $b) {
      $noFaktur = $b->noFaktur;
    }

    Order::where('id', $id)
      ->update(['status' => 1, 'noFaktur' => $noFaktur]);


    return redirect()->to('/pesanan/diproses')->with('success', 'Pesanan sedang diproses!');
  }

  public function detailPesanan($noFaktur)
  {
    // $noFaktur = $request->noFaktur;
    $brg = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'noFaktur' => $noFaktur])->orderBy('id')->get();
    return view('pages.pesanan.detail-pesanan', [
      'title' => 'Detail pesanan',
      'brg' => $brg,
      'total' => $brg->sum('subtotal'),
    ]);
  }

  public function diproses() //ini diproses
  {
    $brg = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 1])->orderBy('id')->get();
    foreach ($brg as $key => $b) {
      $noFaktur = $b->noFaktur;
    }
    return view('pages.pesanan.diproses', [
      'title' => 'Pesanan',
      'brg' => $brg,
      'total' => $brg->sum('subtotal'),
      'noFaktur' => $noFaktur,
    ]);
  }

  public function dikemas() //ini dikemas
  {
    $brgKemas = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 2])->orderBy('id')->get();
    return view('pages.pesanan.dikemas', [
      'title' => 'Pesanan',
      'brgKemas' => $brgKemas,
      'total' => $brgKemas->sum('subtotal'),
    ]);
  }

  public function dikirim() //ini dikirim
  {
    $brgKirim = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 3])->orderBy('id')->get();
    return view('pages.pesanan.dikirim', [
      'title' => 'Pesanan',
      'brgKirim' => $brgKirim,
      'total' => $brgKirim->sum('subtotal'),
    ]);
  }

  public function selesai() //ini selesai
  {
    $brgSelesai = Order::where(['kdUser' => auth()->user()->kdUser ?? '', 'status' => 4])->orderBy('id')->get();
    return view('pages.pesanan.selesai', [
      'title' => 'Pesanan',
      'brgSelesai' => $brgSelesai,
      'total' => $brgSelesai->sum('subtotal'),
    ]);
  }
}

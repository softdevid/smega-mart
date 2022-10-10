<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
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
    $brg = Barang::find($request->barcode);


    // if ($request->stok <= 0) {
    //   return back()->with('error', 'Stok barang kosong tidak bisa ditambahkan');
    // }

    // $request->validate(
    //   [
    //     'noFaktur' => 'required',
    //     'barcode' => 'required',
    //     'qty' => 'required',
    //     'status' => 'required',
    //     'statusBayar' => 'required',
    //     'kdUser' => 'required',
    //     'subtotal' => 'required',
    //   ],
    //   [
    //     'kdUser.required' => 'Login terlebih dahulu',
    //   ]
    // );
    $data = [
      'noFaktur[]'  => $request->noFaktur,
      'barcode[]'    => $request->barcode,
      'qty[]'       => $request->qty,
      'status[]'       => $request->status,
      'statusBayar[]'       => $request->statusBayar,
      'kdUser[]'       => auth()->user()->kdUser ?? '',
    ];

    // dd($dataSet);
    $order = Order::create([
      'noFaktur' => $data,
      'qty' => $data,
      'status' => $data,
      'statusBayar' => $data,
      'kdUser' => $data,
    ]);

    // RinciOrder::create([
    //   'noFaktur' => $request->noFaktur,
    //   'qty' => $order->sum('qty'),
    //   'kdUser' => auth()->user()->kdUser ?? '',
    //   'subtotal' => $order->sum('subtotal'),
    // ]);

    // return response()->json('succes', 200);
    return redirect()->to('/pesanan/diproses')->with('success', 'Berhasil di tambah ke keranjang!');
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
    $date = date('Y-m-d', strtotime(Carbon::now()));
    $a = 0604 + Penjualan::count();
    $noFaktur = "SM-" . $date . Penjualan::count() . $a;
    $Tgl_Jual = date('Y-m-d', strtotime(Carbon::now()));
    $brg = Keranjang::where(['kdUser' => auth()->user()->kdUser ?? ''])->orderBy('id')->get();

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
    // $id = $request->id;
    // $brg = Order::where('id', $id)->get();
    // foreach ($brg as $key => $b) {
    //   $noFaktur = $b->noFaktur;
    // }

    // Order::where('id', $id)
    //   ->update(['status' => 1, 'noFaktur' => $noFaktur]);


    // return redirect()->to('/pesanan/diproses')->with('success', 'Pesanan sedang diproses!');
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
      'noFaktur' => $noFaktur ?? '',
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

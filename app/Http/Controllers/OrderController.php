<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

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
    $request->validate(
      [
        'noFaktur' => 'required',
        'barcode' => 'required',
        'namaBarang' => 'required',
        'hrgJual' => 'required',
        'qty' => 'required',
        'status' => 'required',
        'kdUser' => 'required',
      ],
      [
        'kdUser.required' => 'Login terlebih dahulu',
      ]
    );
    // $validated = $request->validate($request->all());
    Order::create($request->all());

    return response()->json('succes', 200);
    // return back()->with('success', 'Berhasil di tambah ke keranjang!');
  }
}

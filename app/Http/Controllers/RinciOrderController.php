<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Models\RinciOrder;
use App\Models\Penjualan;
use Illuminate\Support\Carbon;
use App\Models\Kasir;

class RinciOrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
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
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
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
    $data = RinciOrder::where('noFaktur', $request->noFaktur)->get();
    $data2 = Order::where('noFaktur', $request->noFaktur)->get();
    // dd($data2);
    $subtotal = $data->sum('subtotal');

    $poin1 = Point::sum('kelipatan');

    $poin = doubleval($subtotal) / $poin1;
    // dd($poin);

    if ($request->status == 4) {
      RinciOrder::where('id', $id)
        ->update(['status' => $request->status]);
      Order::where('noFaktur', $request->noFaktur)
        ->update(['status' => $request->status]);
      return back()->with('success', 'Barang dibatalkan oleh penjual');
    } elseif ($request->status == 1) {
      RinciOrder::where('id', $id)
        ->update(['status' => $request->status]);
      Order::where('noFaktur', $request->noFaktur)
        ->update(['status' => $request->status]);

      // return redirect()->to('/orders/dikemas')->with('success', 'Barang segera dikemas');
      return back()->with('success', 'Barang segera dikemas');
    } elseif ($request->status == 2) {
      RinciOrder::where('id', $id)
        ->update(['status' => $request->status]);

      Order::where('noFaktur', $request->noFaktur)
        ->update(['status' => $request->status]);

      // return redirect()->to('/orders/dikirim')->with('success', 'Barang segera dikirim');
      return back()->with('success', 'Barang segera dikirim');
    } elseif ($request->status == 3) {
      RinciOrder::where('id', $id)
        ->update(['status' => $request->status]);

      RinciOrder::where('id', $id)
        ->update(['statusBayar' => 1]);

      Order::where('noFaktur', $request->noFaktur)
        ->update(['status' => $request->status]);

      Order::where('noFaktur', $request->noFaktur)
        ->update(['statusBayar' => 1]);

      for ($i = 0; $i < count($data); $i++) {
        $data = [
          'noFakturJualan' =>  $request->noFaktur,
          'barcode' =>  $request->barcode,
          'namaBarang' =>  $request->namaBarang,
          'jmlhJual' =>  $request->jmlhJual,
          'hrgJual' =>  $request->hrgJual,
          'hrgBeli' =>  $request->hrgBeli,
        ];
        Kasir::create($data);
      }

      Penjualan::create([
        'No_Faktur_Jual' => $request->noFaktur,
        'Tgl_Jual' => date('Y-m-d', strtotime(Carbon::now())),
        'Kd_Pelanggan' => '',
        'Total' => $subtotal,
        'Bayar' => $subtotal,
        'Kd_User' => auth()->user()->kdUser,
        'poin' => $poin,
      ]);

      // return redirect()->to('/orders/selesai')->with('success', 'Barang telah sampai');
      return back()->with('success', 'Barang telah sampai');
    }
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

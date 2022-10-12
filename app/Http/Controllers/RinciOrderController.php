<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Models\RinciOrder;
use App\Models\Penjualan;
use Illuminate\Support\Carbon;

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
    if ($request->status == 1) {
      RinciOrder::where('id', $id)
        ->update(['status' => $request->status]);
      Order::where('noFaktur', $request->noFaktur)
        ->update(['status' => $request->status]);

      return redirect()->to('/orders/dikemas');
    } elseif ($request->status == 2) {
      RinciOrder::where('id', $id)
        ->update(['status' => $request->status]);

      Order::where('noFaktur', $request->noFaktur)
        ->update(['status' => $request->status]);

      return redirect()->to('/orders/dikirim');
    } elseif ($request->status == 3) {
      RinciOrder::where('id', $id)
        ->update(['status' => $request->status]);

      Order::where('noFaktur', $request->noFaktur)
        ->update(['status' => $request->status]);

      // Penjualan::create([
      //   'No_Faktur_Jualan' => $request->noFaktur,
      //   'Tgl_Jual' => date('Y-m-d', strtotime(Carbon::now())),
      //   'Kd_Pelanggan' => $request->Kd_Pelanggan,
      //   'Total' => $request->Total,
      //   'Bayar' => $request->Bayar,
      //   'Kd_User' => $request->Kd_User,
      //   'poin' => doubleval($request->Total) / Point::select('kelipatan'),
      // ]);

      Penjualan::create([
        'No_Faktur_Jual' => $request->noFaktur,
        'Tgl_Jual' => date('Y-m-d', strtotime(Carbon::now())),
        'Kd_Pelanggan' => '',
        'Total' => 3,
        'Bayar' => 3,
        'Kd_User' => 3,
        'poin' => 3 / Point::sum('kelipatan'),
      ]);

      return redirect()->to('/orders/selesai');
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

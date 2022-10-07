<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index()
  {
    $date = Carbon::now()->isoFormat('D-M-Y');
    $month = date('m', strtotime($date));
    $year = date('Y', strtotime($date));
    $totalBarang = Barang::count();

    $today = Penjualan::whereDay('Tgl_Jual', $date)->sum('total');
    $month = Penjualan::whereMonth('Tgl_Jual', [$month, $year])->sum('total');
    $year = Penjualan::whereYear('Tgl_Jual', $year)->sum('total');
    // dd($today);
    return view('admin.pages.dashboard', [
      'title' => 'Dashboard',
      'today' => $today,
      'month' => $month,
      'year' => $year,
      'totalBarang' => $totalBarang,
    ]);
  }
}

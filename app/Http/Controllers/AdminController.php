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
    $date = date('Y-m-d', strtotime(Carbon::now()));
    $month = date('Y-m', strtotime(Carbon::now()));
    $year = date('Y', strtotime(Carbon::now()));
    $totalBarang = Barang::count();

    $today = Penjualan::where('Tgl_Jual', $date)->sum('total');
    $month = Penjualan::whereMonth('Tgl_Jual', $month)->sum('total');
    $year = Penjualan::where('Tgl_Jual', $year)->sum('total');
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

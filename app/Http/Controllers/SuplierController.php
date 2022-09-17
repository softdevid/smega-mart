<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SuplierController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return View('admin.pages.suplier.index', [
      'title' => 'Suplier',
      'supliers' => Suplier::all(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.pages.suplier.create', [
      'title' => 'Tambah suplier'
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
    $suplier = Suplier::find($request->kdSupplier);
    if ($suplier == NULL) {
      Suplier::create([
        'kdSupplier' => $request->kdSupplier,
        'namaSupplier' => $request->namaSupplier,
        'slug' => Str::slug($request->namaSupplier),
      ]);
      return back()->with('success', 'Suplier berhasil ditambah!!');
    } elseif ($request->kdSupplier == $suplier->kdSupplier) {
      return back()->with('error', 'Kode supplier sudah ada, ganti dengan yang lain');
    }
  }
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Suplier  $suplier
   * @return \Illuminate\Http\Response
   */
  public function show(Suplier $suplier)
  {
    $suplier = Suplier::findOrFail($suplier->id);
    return view('admin.pages.suplier.detail', [
      'title' => 'Detail Suplier',
      'suplier' => $suplier,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Suplier  $suplier
   * @return \Illuminate\Http\Response
   */
  public function edit(Suplier $suplier)
  {
    // $suplier = Suplier::findOrFail($suplier->id);
    // return view('admin.pages.suplier.edit', [
    //   'title' => 'Edit',
    //   'suplier' => $suplier,
    // ]);

    $suplier = Suplier::find($suplier->kdSupplier);
    dd($suplier);
    if (!$suplier->kdSupplier == $suplier->kdSupplier) {
      $suplier->update([
        'kdSupplier' => $suplier->kdSupplier,
        'namaSupplier' => $suplier->namaSupplier,
        'slug' => Str::slug($suplier->namaSupplier),
      ]);
      return back()->with('success', 'Suplier berhasil diedit!!');
    } elseif ($suplier->kdSupplier == $suplier->kdSupplier) {
      return back()->with('error', 'Kode supplier sudah ada, ganti dengan yang lain');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Suplier  $suplier
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Suplier $suplier)
  {
    // $suplier = Suplier::findOrFail($suplier->kdSupplier);
    // if ($request->kdSupplier = $suplier->kdSupplier) {
    //   $rules['kdSupplier'] = 'required|datasupplier:unique';
    //   return back()->with('error', 'Kode Suplier sudah digunakan, buat kode lain');
    // }

    // $suplier->update([
    //   'kdSupplier' => $request->kdSupplier,
    //   'namaSupplier' => $request->namaSupplier,
    //   'slug' => $request->slug,
    // ]);
    // return redirect()->to('suplier')->with('success', 'Suplier berhasil di edit!!');

    $supplier = Suplier::find($suplier->kdSupplier);

    $rules = [
      'namaSupplier' => 'required|max:255',
      'slug' => 'required|max:18|unique:datasupplier'
    ];

    if ($request->kdSupplier != $supplier->kdSupplier) {
      $rules['kdSupplier'] = 'required|unique:datasupplier';
    }

    $data = [
      "kdSupplier" => $request->kdSupplier,
      "namaSupplier" => $request->namaSupplier,
      "slug" => $request->slug,
    ];

    $supplier->where('kdSupplier', $supplier->kdSupplier)
      ->update($data);

    return back()->with('success', 'Berhasil diedit!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Suplier  $suplier
   * @return \Illuminate\Http\Response
   */
  public function destroy(Suplier $suplier)
  {
    $suplier = Suplier::findOrFail($suplier->kdSupplier);
    $suplier->delete($suplier->kdSupplier);
    return back()->with('success', 'Suplier berhasil dihapus!!');
  }
}

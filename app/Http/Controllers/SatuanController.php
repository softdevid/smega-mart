<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;
use Illuminate\Support\Str;


class SatuanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin.pages.unit.index', [
      'title' => 'Satuan',
      'satuans' => Satuan::all(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.pages.unit.create', [
      'title' => 'Tambah Unit',
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
    // dd($request->all());
    $rules = [
      'slug' => 'required|units:unique',
    ];

    Satuan::create([
      'name' => $request->name,
      '$rules[slug]' => Str::slug($request->name),
    ]);
    return redirect()->to('unit')->with('success', 'Satuan berhasil ditambahkan!');
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
    $suplier = Satuan::findOrFail($id);
    if ($request->slug != $suplier->slug) {
      $rules['slug'] = 'required|supliers:unique';
    }

    $suplier->update([
      'name' => $request->name,
      'slug' => Str::slug($request->name),
    ]);
    return back()->with('success', 'Satuan berhasil di edit!!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $satuan = Satuan::findOrFail($id);
    $satuan->delete($satuan->id);
    return back()->with('success', 'Satuan berhasil dihapus!');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
  use HasFactory;

  protected $table = 'databarang';
  protected $primaryKey = 'barcode';
  protected $guarded = [];
  protected $with = ['kategori', 'supplier'];

  public function kategori()
  {
    return $this->belongsTo(Kategori::class, 'kdKategori');
    // return $this->belongsTo(Kategori::class);
  }

  public function satuan()
  {
    return $this->belongsTo(Satuan::class);
  }

  public function supplier()
  {
    return $this->belongsTo(Suplier::class, 'kdSupplier');
  }

  public function gambar()
  {
    return $this->hasMany(Gambar::class, 'kdGambar');
  }
}

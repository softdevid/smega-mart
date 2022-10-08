<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Barang extends Model
{
  use HasFactory;
  use Sluggable;

  protected $table = 'databarang';
  protected $primaryKey = 'barcode';
  protected $guarded = [];
  protected $with = ['kategori', 'supplier', 'keranjang'];

  public function kategori()
  {
    return $this->belongsTo(Kategori::class, 'kdKategori');
  }

  public function satuan()
  {
    return $this->belongsTo(Satuan::class, 'kdSatuan');
  }

  public function supplier()
  {
    return $this->belongsTo(Suplier::class, 'kdSupplier');
  }

  public function gambar()
  {
    return $this->hasMany(Gambar::class, 'kdGambar');
  }

  public function kasir()
  {
    return $this->belongsTo(Kasir::class, 'barcode');
  }

  public function order()
  {
    return $this->hasOne(Order::class, 'barcode');
  }

  public function keranjang()
  {
    return $this->hasOne(Keranjang::class, 'barcode');
  }


  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'namaBarang'
      ]
    ];
  }
}

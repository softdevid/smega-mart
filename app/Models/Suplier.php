<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Suplier extends Model
{
  use HasFactory;
  use Sluggable;

  protected $table = 'datasupplier';
  protected $primaryKey = 'kdSupplier';
  protected $guarded = [];
  public $timestamps = false;

  public function barang()
  {
    return $this->hasOne(Barang::class, 'barcode');
  }

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'namaSupplier'
      ]
    ];
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
  use HasFactory;
  protected $table = 'tabelrealpenjualan';
  protected $guarded = ['no'];

  public function barang()
  {
    return $this->hasOne(Barang::class, 'barcode');
  }
}

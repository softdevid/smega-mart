<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;
  protected $table = 'order';
  protected $guarded = ['id'];
  protected $with = 'barang';

  public function barang()
  {
    return $this->belongsTo(Barang::class, 'barcode');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'kdUser');
  }

  public function penjualan()
  {
    return $this->belongsTo(Penjualan::class, 'No_Faktur_Jual');
  }
}

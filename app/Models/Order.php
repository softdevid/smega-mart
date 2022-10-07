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
}

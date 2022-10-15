<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RinciOrder extends Model
{
  use HasFactory;
  protected $table = 'rinci_order';
  protected $guarded = ['id'];

  public function user()
  {
    return $this->belongsTo(User::class, 'kdUser');
  }

  public function barang()
  {
    return $this->belongsTo(Barang::class, 'barcode');
  }

  public function order()
  {
    return $this->belongsTo(Order::class, 'noFaktur');
  }
}

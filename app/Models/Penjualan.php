<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
  use HasFactory;
  protected $table = 'tabel_penjualan';
  protected $guarded = ['No'];
  protected $primaryKey = 'No';
  public $timestamps = false;

  public function tabelrealpenjualan()
  {
    return $this->belongsTo(Kasir::class, 'no');
  }
}

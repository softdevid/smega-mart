<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
  use HasFactory;
  protected $table = 'tabelrealpembelian';
  protected $guarded = ['id'];
  protected $primaryKey = 'id';
  public $timestamps = false;
}

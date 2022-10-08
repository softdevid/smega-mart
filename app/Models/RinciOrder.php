<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RinciOrder extends Model
{
  use HasFactory;
  protected $table = 'rinci_order';
  protected $guarded = ['id'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Satuan extends Model
{
  use HasFactory;
  use Sluggable;

  protected $table = 'tabelsatuan';
  protected $primaryKey = 'kdSatuan';
  protected $guarded = ['kdSatuan'];

  public function product()
  {
    return $this->hasOne(Product::class, 'kdSatuan');
  }

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Suplier extends Model
{
  use HasFactory;
  use Sluggable;
  protected $guarded = ['id'];

  public function product()
  {
    return $this->hasOne(Product::class);
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

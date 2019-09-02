<?php

namespace Tickets\Models\Sector;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
  protected $fillable = [
    'name',
    'active'
  ];

  protected $casts = [
    'active' => 'boolean'
  ];

  public function scopeActive($query)
  {
    return $query->whereActive($query);
  }
}

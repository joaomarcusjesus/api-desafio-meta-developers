<?php

namespace Tickets\Models\Responsible;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tickets\Models\Sector\Sector;

class Responsible extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'cpf',
    'sector_id',
    'active'
  ];

  protected $casts = [
    'active' => 'boolean'
  ];

  protected $dates = [
    'deleted_at'
  ];

  protected $appends = [
    'full_name'
  ];

  public function scopeActive($query)
  {
    return $query->whereActive($query);
  }

  public function sector()
  {
    return $this->belongsTo(Sector::class, 'sector_id');
  }

  public function setEmailAttribute($input)
  {
    if ($input)
      $this->attributes['email'] = mb_strtolower($input, 'UTF-8');
  }

  public function setCpfAttribute($value)
  {
    if ($value)
      $this->attributes['cpf'] = ($value != null) ? trim(preg_replace('#[^0-9]#', '', $value)) : null;
  }

  public function getFullNameAttribute()
  {
    return "{$this->first_name} {$this->last_name}";
  }
}

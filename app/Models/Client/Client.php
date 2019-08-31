<?php

namespace Tickets\Models\Client;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model implements AuditableInterface
{
  use AuditableTrait, SoftDeletes;

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'cpf',
    'phone',
    'active'
  ];

  protected $casts = [
    'active' => 'boolean'
  ];

  protected $dates = [
    'deleted_at'
  ];

  protected $auditInclude = [
    'first_name',
    'last_name',
    'email',
    'cpf',
    'phone',
    'active',
  ];

  public function scopeActive($query)
  {
    return $query->whereActive($query);
  }

  public function setEmailAttribute($input)
  {
    if ($input)
      $this->attributes['email'] = mb_strtolower($input, 'UTF-8');
  }

  public function setPhoneAttribute($input)
  {
    if ($input)
      $this->attributes['phone'] = trim(preg_replace('#[^0-9]#', '', $input));
  }

  public function setCpfAttribute($value)
  {
    if ($value)
      $this->attributes['cpf'] = ($value != null) ? trim(preg_replace('#[^0-9]#', '', $value)) : null;
  }
}

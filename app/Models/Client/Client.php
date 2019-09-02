<?php

namespace Tickets\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Tickets\Notifications\Calls\CallNotification;
use Tickets\Notifications\Calls\CallUpdateNotification;

class Client extends Model
{
  use SoftDeletes, Notifiable;

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

  protected $appends = [
    'full_name'
  ];

  public function sendCallNotification($client, $call)
  {
    $this->notify(new CallNotification($client, $call));
  }

  public function sendCallUpdateNotification($client, $call)
  {
    $this->notify(new CallUpdateNotification($client, $call));
  }

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

  public function getFullNameAttribute()
  {
    return "{$this->first_name} {$this->last_name}";
  }
}

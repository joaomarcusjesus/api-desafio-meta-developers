<?php

namespace Tickets\Models\Call;

use Illuminate\Database\Eloquent\Model;
use Tickets\Models\Responsible\Responsible;

class History extends Model
{
  protected $table = 'calls_histories';

  protected $fillable = [
    'code',
    'body',
    'call_id',
    'responsible_id',
    'status'
  ];

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model)
    {
      $model->configs();
    });
  }

  protected function configs()
  {
    $this->attributes['code'] = sha1(date('dmyhis') . $this->responsible->cpf);
  }

  public function scopeActive($query)
  {
    return $query->whereActive($query);
  }

  public function scopeResponsible($query, $responsible_id)
  {
    return $query->whereHas('responsible', function ($q) use ($responsible_id) {
      $q->whereId($responsible_id);
    });
  }

  public function scopeCall($query, $call_id)
  {
    return $query->whereHas('call', function ($q) use ($call_id) {
      $q->whereId($call_id);
    });
  }

  public function responsible()
  {
    return $this->belongsTo(Responsible::class, 'responsible_id');
  }

  public function call()
  {
    return $this->belongsTo(Call::class, 'call_id');
  }

  public function getStatusNameAttribute()
  {
    $status = '';

    switch ($this->status) {
      case 1:
        $status = 'Aberto';
        break;
      case 2:
        $status = 'Em andamento';
        break;
      case 3:
        $status = 'Fechado';
        break;
    }

    return $status;
  }
}

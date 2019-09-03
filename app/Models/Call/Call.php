<?php

namespace Tickets\Models\Call;

use Illuminate\Database\Eloquent\Model;
use Tickets\Models\Sector\Sector;
use Tickets\Models\Client\Client;

class Call extends Model
{
  protected $fillable = [
    'code',
    'body',
    'client_id',
    'sector_id',
    'status',
    'active'
  ];

  protected $casts = [
    'active' => 'boolean'
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
    $this->attributes['code'] = sha1(date('dmyhis') . $this->client->cpf);
    // $this->attributes['status'] = 1;
  }

  public function scopeActive($query)
  {
    return $query->whereActive($query);
  }

  public function scopeSector($query, $sector_id)
  {
    return $query->whereHas('sector', function ($q) use ($sector_id) {
      $q->whereId($sector_id);
    });
  }

  public function scopeClient($query, $client_id)
  {
    return $query->whereHas('client', function ($q) use ($client_id) {
      $q->whereId($client_id);
    });
  }

  public function sector()
  {
    return $this->belongsTo(Sector::class, 'sector_id');
  }

  public function client()
  {
    return $this->belongsTo(Client::class, 'client_id');
  }

  public function histories()
  {
    return $this->hasMany(History::class, 'call_id');
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

  public function getReferenceAttribute()
  {
    return "#" . str_pad($this->id, 5, '0', STR_PAD_LEFT);
  }
}

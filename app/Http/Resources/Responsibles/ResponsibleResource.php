<?php

namespace Tickets\Http\Resources\Responsibles;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponsibleResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => (string) $this->id,
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'email' => $this->email,
      'cpf' => $this->cpf,
      'sector' => $this->sector->name,
      'active' => $this->active
    ];
  }
}

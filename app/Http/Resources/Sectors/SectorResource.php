<?php

namespace Tickets\Http\Resources\Sectors;

use Illuminate\Http\Resources\Json\JsonResource;

class SectorResource extends JsonResource
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
      'name' => $this->name,
      'active' => $this->active
    ];
  }
}

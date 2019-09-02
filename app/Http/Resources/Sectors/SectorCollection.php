<?php

namespace Tickets\Http\Resources\Sectors;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SectorCollection extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'data' => $this->collection->transform(function($sector) {
        return [
          'id' => $sector->id,
          'name' => $sector->name,
          'active' => $sector->active,
        ];
      }),
      'links' => [
        'self' => 'link-value',
      ],
    ];
  }
}

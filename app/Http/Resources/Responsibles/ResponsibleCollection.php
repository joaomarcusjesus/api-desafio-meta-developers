<?php

namespace Tickets\Http\Resources\Responsibles;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ResponsibleCollection extends ResourceCollection
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
      'data' => $this->collection->transform(function($responsible) {
        return [
          'id' => $responsible->id,
          'first_name' => $responsible->first_name,
          'last_name' => $responsible->last_name,
          'full_name' => $responsible->full_name,
          'email' => $responsible->email,
          'cpf' => $responsible->cpf,
          'sector' => $responsible->sector->name,
          'active' => $responsible->active,
        ];
      }),
      'links' => [
        'self' => 'link-value',
      ],
    ];
  }
}

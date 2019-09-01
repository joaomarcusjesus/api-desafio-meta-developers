<?php

namespace Tickets\Http\Resources\Clients;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientCollection extends ResourceCollection
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
      'data' => $this->collection->transform(function($client) {
        return [
          'id' => $client->id,
          'first_name' => $client->first_name,
          'last_name' => $client->last_name,
          'full_name' => $client->full_name,
          'email' => $client->email,
          'cpf' => $client->cpf,
          'phone' => $client->phone,
          'active' => $client->active,
        ];
      }),
      'links' => [
        'self' => 'link-value',
      ],
    ];
  }
}

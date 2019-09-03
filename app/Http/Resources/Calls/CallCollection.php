<?php

namespace Tickets\Http\Resources\Calls;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Tickets\Http\Resources\Histories\HistoryCollection;

class CallCollection extends ResourceCollection
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
      'data' => $this->collection->transform(function($call) {
        return [
          'reference' => $call->reference,
          'body' => $call->body,
          'client' => $call->client->full_name,
          'sector' => $call->sector->name,
          'status' => $call->status_name,
          'active' => $call->active,
          'histories' => new HistoryCollection($call->histories),
        ];
      }),
      'links' => [
        'self' => 'link-value',
      ],
    ];
  }
}

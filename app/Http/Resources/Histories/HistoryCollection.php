<?php

namespace Tickets\Http\Resources\Histories;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Tickets\Http\Resources\Calls\CallResource;

class HistoryCollection extends ResourceCollection
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
      'data' => $this->collection->transform(function($history) {
        return [
          'code' => $history->code,
          'body' => $history->body,
          'call' => $history->call->code,
          // 'call' => new CallResource($history->call),
          'responsible' => $history->responsible->full_name,
          'status' => $history->status_name
        ];
      }),
      'links' => [
        'self' => 'link-value',
      ],
    ];
  }
}

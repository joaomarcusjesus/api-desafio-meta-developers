<?php

namespace Tickets\Http\Resources\Calls;

use Illuminate\Http\Resources\Json\JsonResource;
use Tickets\Http\Resources\Histories\HistoryCollection;

class CallResource extends JsonResource
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
      'reference' => str_limit($call->code, 5),
      'body' => $this->body,
      'client' => $this->client->full_name,
      'sector' => $this->sector->name,
      'status' => $this->status_name,
      'active' => $this->active,
      'histories' => new HistoryCollection($this->histories)
    ];
  }
}

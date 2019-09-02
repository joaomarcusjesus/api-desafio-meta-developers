<?php

namespace Tickets\Http\Controllers\Api\Calls;

use Tickets\Models\Call\History;
use Tickets\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tickets\Http\Resources\Histories\HistoryResource;
use Tickets\Http\Resources\Histories\HistoryCollection;

class HistoryController extends Controller
{
  private $histories;

  public function __construct(History $histories)
  {
    $this->histories = $histories;
  }

  public function index(Request $request)
  {
    $query = $this->histories->select('code', 'body', 'call_id', 'responsible_id', 'status');

    if ($request->filled('responsible_id')) {
      $query->with('responsible')->responsible($request->get('responsible_id'));
    }

    if ($request->filled('call_id')) {
      $query->with('call')->call($request->get('call_id'));
    }

    return new HistoryCollection($query->paginate(150));
  }

  public function show(History $history)
  {
    return new HistoryResource($history);
  }

  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'body' => 'required',
      'call_id' => 'required',
      'responsible_id' => 'required',
      'status' => 'required'
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $history = $this->histories->create($request->all());

    return response()->json(['data' => new HistoryResource($history)], 200);
  }

  public function update(Request $request, History $history)
  {
    $validate = validator($request->all(),[
      'body' => 'required',
      'call_id' => 'required',
      'responsible_id' => 'required',
      'status' => 'required'
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $history->fill($request->all());
    $history->save();

    return response()->json(['data' => new HistoryResource($history)], 200);
  }

  public function destroy(History $history)
  {
    $history->delete();

    return response()->json(['data' => new HistoryResource($history)], 200);
  }
}

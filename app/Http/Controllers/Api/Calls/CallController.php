<?php

namespace Tickets\Http\Controllers\Api\Calls;

use Tickets\Models\Call\Call;
use Tickets\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tickets\Http\Resources\Calls\CallResource;
use Tickets\Http\Resources\Calls\CallCollection;

class CallController extends Controller
{
  private $calls;

  public function __construct(Call $calls)
  {
    $this->calls = $calls;
  }

  public function index(Request $request)
  {
    $query = $this->calls->select('code', 'body', 'client_id', 'sector_id', 'status', 'active');

    if ($request->filled('sector_id')) {
      $query->with('sector')->sector($request->get('sector_id'));
    }

    if ($request->filled('client_id')) {
      $query->with('client')->client($request->get('client_id'));
    }

    return new CallCollection($query->paginate(150));
  }

  public function show(Call $call)
  {
    return new CallResource($call);
  }

  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'body' => 'required',
      'client_id' => 'required',
      'sector_id' => 'required'
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $call = $this->calls->create($request->all());

    return response()->json(['data' => new CallResource($call)], 200);
  }

  public function update(Request $request, Call $call)
  {
    $validate = validator($request->all(),[
      'body' => 'required',
      'client_id' => 'required',
      'sector_id' => 'required'
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $call->fill($request->all());
    $call->save();

    return response()->json(['data' => new CallResource($call)], 200);
  }

  public function destroy(Call $call)
  {
    $call->delete();

    return response()->json(['data' => new CallResource($call)], 200);
  }
}

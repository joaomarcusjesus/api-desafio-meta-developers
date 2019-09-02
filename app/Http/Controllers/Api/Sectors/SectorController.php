<?php

namespace Tickets\Http\Controllers\Api\Sectors;

use Tickets\Models\Sector\Sector;
use Tickets\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tickets\Http\Resources\Sectors\SectorResource;
use Tickets\Http\Resources\Sectors\SectorCollection;

class SectorController extends Controller
{
  private $sectors;

  public function __construct(Sector $sectors)
  {
    $this->sectors = $sectors;
  }

  public function index()
  {
    return new SectorCollection($this->sectors->paginate(25));
  }

  public function show(Sector $sector)
  {
    return new SectorResource($sector);
  }

  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'name' => 'required|max:255',
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $sector = $this->sectors->create($request->all());

    return response()->json(['data' => new SectorResource($sector)], 200);
  }

  public function update(Request $request, Sector $sector)
  {
    $validate = validator($request->all(),[
      'name' => 'required|max:255|unique:sectors,name,' . $sector->id,
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $sector->fill($request->all());
    $sector->save();

    return response()->json(['data' => new SectorResource($sector)], 200);
  }

  public function destroy(Sector $sector)
  {
    $sector->delete();

    return response()->json(['data' => new SectorResource($sector)], 200);
  }
}

<?php

namespace Tickets\Http\Controllers\Api\Responsibles;

use Tickets\Models\Responsible\Responsible;
use Tickets\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tickets\Http\Resources\Responsibles\ResponsibleResource;
use Tickets\Http\Resources\Responsibles\ResponsibleCollection;

class ResponsibleController extends Controller
{
  private $responsibles;

  public function __construct(Responsible $responsibles)
  {
    $this->responsibles = $responsibles;
  }

  public function index()
  {
    return new ResponsibleCollection($this->responsibles->paginate(25));
  }

  public function show(Responsible $responsible)
  {
    return new ResponsibleResource($responsible);
  }

  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:responsibles',
      'cpf' => 'required|max:40|unique:responsibles',
      'sector_id' => 'required'
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $responsible = $this->responsibles->create($request->all());

    return response()->json(['data' => new ResponsibleResource($responsible)], 200);
  }

  public function update(Request $request, Responsible $responsible)
  {
    $request->merge(['cpf' => trim(preg_replace('#[^0-9]#', '', $request->get('cpf')))]);

    $validate = validator($request->all(),[
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:responsibles,email,' . $responsible->id,
      'cpf' => 'required|max:40|unique:responsibles,cpf,' . $responsible->id,
      'sector_id' => 'required'
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $responsible->fill($request->all());
    $responsible->save();

    return response()->json(['data' => new ResponsibleResource($responsible)], 200);
  }

  public function destroy(Responsible $responsible)
  {
    $responsible->delete();

    return response()->json(['data' => new ResponsibleResource($responsible)], 200);
  }
}

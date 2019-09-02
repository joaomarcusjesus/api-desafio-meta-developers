<?php

namespace Tickets\Http\Controllers\Api\Clients;

use Tickets\Models\Client\Client;
use Tickets\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tickets\Http\Resources\Clients\ClientResource;
use Tickets\Http\Resources\Clients\ClientCollection;

class ClientController extends Controller
{
  private $clients;

  public function __construct(Client $clients)
  {
    $this->clients = $clients;
  }

  public function index()
  {
    return new ClientCollection($this->clients->paginate(25));
  }

  public function show(Client $client)
  {
    return new ClientResource($client);
  }

  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:clients',
      'phone' => 'nullable|max:40',
      'cpf' => 'required|max:40|unique:clients'
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $client = $this->clients->create($request->all());

    return response()->json(['data' => new ClientResource($client)], 200);
  }

  public function update(Request $request, Client $client)
  {
    $request->merge(['cpf' => trim(preg_replace('#[^0-9]#', '', $request->get('cpf')))]);

    $validate = validator($request->all(),[
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
      'phone' => 'nullable|max:40',
      'cpf' => 'required|max:40|unique:clients,cpf,' . $client->id
    ]);

    if($validate->fails()):
      return response()->json(['error' => $validate->getMessageBag()], 401);
    endif;

    $client->fill($request->all());
    $client->save();

    return response()->json(['data' => new ClientResource($client)], 200);
  }

  public function destroy(Client $client)
  {
    $client->delete();

    return response()->json(['data' => new ClientResource($client)], 200);
  }
}

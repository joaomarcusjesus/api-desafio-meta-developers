<?php

namespace Tickets\Http\Controllers\Api\Clients;


use Tickets\Models\Client\Client;
use Tickets\Http\Controllers\Controller;
use Tickets\Http\Requests\Clients\ClientStoreRequest;
use Tickets\Http\Requests\Clients\ClientUpdateRequest;
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

  public function store(ClientStoreRequest $request)
  {
    $validated = $request->validated();

    $client = $this->clients->create($request->all());

    return response()->json(['data' => new ClientResource($client)], 200);
  }

  public function update(ClientUpdateRequest $request, Client $client)
  {
    $request->merge(['cpf' => trim(preg_replace('#[^0-9]#', '', $request->get('cpf')))]);

    $validated = $request->validated();

    $client->fill($request->all());
    $client->save();

    return response()->json(['data' => new ClientResource($client)], 200);
  }

  public function delete(Client $client)
  {
    $client->delete();

    return response()->json(['data' => new ClientResource($client)], 200);
  }
}

<?php

namespace Tickers\Http\Controllers\Api\Clients;

use Tickers\Models\Client\Client;
use Tickers\Http\Controllers\Api\BaseController;
use Tickers\Http\Requests\Clients\ClientStoreRequest;
use Tickers\Http\Requests\Clients\ClientUpdateRequest;
use Tickers\Http\Resources\Clients\ClientResource;
use Tickers\Http\Resources\Clients\ClientCollection;

class ClientController extends BaseController
{
  private $clients;

  public function __construct(Client $clients)
  {
    $this->clients = $clients;
  }

  public function index()
  {
    return ClientCollection::collection($this->clients->paginate(25));
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
    $client->update($request->validated());

    return response()->json(['data' => new ClientResource($client)], 200);
  }

  public function delete(Client $client)
  {
    $client->delete();

    return response()->json(['data' => new ClientResource($client)], 200);
  }

  public function restore(Client $client)
  {
    $client->restore();

    return response()->json(['data' => new ClientResource($client)], 200);
  }
}

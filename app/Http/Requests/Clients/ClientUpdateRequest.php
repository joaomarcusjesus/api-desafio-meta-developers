<?php

namespace Tickets\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:clients,id,' . $this->client->id,
      'cpf' => 'required|max:40|unique:clients,id,' . $this->client->id,
      'phone' => 'nullable|max:40'
    ];
  }
}

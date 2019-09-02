@component('mail::message')
  # Olá, {{ $client->first_name }}

  Foi aberto um novo chamando para o setor <b>{{ $call->sector->name }}</b> com o código <b>{{ $call->code }}</b>

  Atenciosamente,<br>
  {{ config('app.name') }}
@endcomponent

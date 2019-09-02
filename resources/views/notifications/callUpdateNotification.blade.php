@component('mail::message')
  # Olá, {{ $client->first_name }}

  Chamando atualizado do setor <b>{{ $call->sector->name }}</b> com o código <b>{{ $call->code }}</b>

  Atenciosamente,<br>
  {{ config('app.name') }}
@endcomponent

@component('mail::message')
  # Olá, {{ $responsible->first_name }}

  Foi aberto um novo chamando para o seu setor <b>{{ $call->sector->name }}</b> com o código <b>{{ $call->code }}</b>

  Atenciosamente,<br>
  {{ config('app.name') }}
@endcomponent

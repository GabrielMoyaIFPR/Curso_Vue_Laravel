@component('mail::message')
# {{ $tarefa }}

Data Limite de Conclusão {{ $data_limite_conclusao }}

@component('mail::button', ['url' => $url])
Clique aqui para ver a Tarefa
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent


{{-- Tudo dentro da tag somente com usuário autenticado --}}
@auth

    <h1>Usuário autenticado</h1>
    <p>ID: {{Auth::user()->id}}</p>
    <p>Nome: {{Auth::user()->name}}</p>
    <p>E-mail: {{Auth::user()->email}}</p>

@endauth


{{-- Tudo dentro da tag para visitantes --}}
@guest
    <h1>Olá Visitante, tudo bem?? </h1>
@endguest
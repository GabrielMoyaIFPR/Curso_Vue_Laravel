<h3>Fornecedor</h3>

{{-- Fica o comentário descartado pelo interpretador do blade--}}

@php

@endphp

{{-- IF --}}

{{-- @if(count($fornecedores) > 0 && count($fornecedores) < 10)
    <h3>Existem alguns fornecedores aqui</h3>

@elseif(count($fornecedores) > 10)
   <h3>Existem vários fornecedores aqui</h3> 

@else
    <h3>Nenhum fornecedor aqui</h3>
@endif 
<br>--}}

{{-- ISSET --}}

{{-- @isset($fornecedores)
    Fornecedor: {{ $fornecedores[0] ['nome'] }}
    <br>
    Status: {{ $fornecedores[0] ['status'] }}
    <br>
    CNPJ: {{ $fornecedores[0] ['cnpj'] }}
@endisset    
<br>
@isset($fornecedores)
    Fornecedor: {{ $fornecedores[1] ['nome'] }}
    <br>
    Status: {{ $fornecedores[1] ['status'] }}
    <br>
    @isset($fornecedores[1]['cnpj'])
        CNPJ: {{ $fornecedores[1] ['cnpj'] }}
    @endisset
@endisset    --}}

{{-- EMPTY --}}

{{-- @isset($fornecedores)
    Fornecedor: {{ $fornecedores[0] ['nome'] }}
    <br>
    Status: {{ $fornecedores[0] ['status'] }}
    <br>
    @isset($fornecedores[0]['cnpj'])
        CNPJ: {{ $fornecedores[0] ['cnpj'] }}
        @empty($fornecedores[0]['cnpj'])
            -Vazio
        @endempty
    @endisset
@endisset    --}}

{{-- SWITCH --}}

{{-- @isset($fornecedores)
    Fornecedor: {{ $fornecedores[1] ['nome'] }}
    <br>
    Status: {{ $fornecedores[1] ['status'] }}
    <br>
    CNPJ: {{ $fornecedores[1] ['cnpj'] ?? 'Dado não preenchido' }} {{--- Definindo Default em caso de nulo ou vazio ---}}
    {{-- <br>
    Telefone: {{ $fornecedores[1] ['ddd'] ?? ''}} {{ $fornecedores[1]['telefone' ?? '']}}
    @switch($fornecedores[1]['ddd'])
        @case('11')
            São Paulo - SP
            @break
        @case('32')
            Juiz de Fora - MG
            @break
        @case('85')
            Fortaleza - CE
            @break
        @default
            Estado não identificado
    @endswitch
@endisset --}}

{{-- FOR --}}

{{-- @isset($fornecedores)
    @for($i = 0; isset($fornecedores[$i]); $i++)

        Fornecedor: {{ $fornecedores[$i] ['nome'] }}
        <br>
        Status: {{ $fornecedores[$i] ['status'] }}
        <br>
        CNPJ: {{ $fornecedores[$i] ['cnpj'] ?? 'Dado não preenchido' }}
        <br>
        Telefone: {{ $fornecedores[$i] ['ddd'] ?? ''}} {{ $fornecedores[1]['telefone' ?? '']}}
        <br>
        <br>
    @endfor
@endisset --}}

{{-- WHILE --}}

{{-- @isset($fornecedores)

    @php $i = 0 @endphp
    @while(isset($fornecedores[$i]))

        Fornecedor: {{ $fornecedores[$i] ['nome'] }}
        <br>
        Status: {{ $fornecedores[$i] ['status'] }}
        <br>
        CNPJ: {{ $fornecedores[$i] ['cnpj'] ?? 'Dado não preenchido' }}
        <br>
        Telefone: {{ $fornecedores[$i] ['ddd'] ?? ''}} {{ $fornecedores[1]['telefone' ?? '']}}
        <br>
        <br>
        @php $i++ @endphp
    @endwhile
@endisset --}}

{{-- FOREACH --}}

{{-- @isset($fornecedores)

   @foreach($fornecedores as $indice => $fornecedor)

        Fornecedor: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não preenchido' }}
        <br>
        Telefone: {{ $fornecedor['ddd'] ?? ''}} {{ $fornecedor['telefone' ?? '']}}
        <hr>
    @endforeach    
@endisset --}}

{{-- FORELSE --}}

@isset($fornecedores)

   @forelse($fornecedores as $indice => $fornecedor)

        Fornecedor: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não preenchido' }}
        <br>
        Telefone: {{ $fornecedor['ddd'] ?? ''}} {{ $fornecedor['telefone' ?? '']}}
        <hr>
        @empty
            Não existe fornecedores cadastrados!
    @endforelse    
@endisset
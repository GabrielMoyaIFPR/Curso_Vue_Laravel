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


@isset($fornecedores)
    Fornecedor: {{ $fornecedores[1] ['nome'] }}
    <br>
    Status: {{ $fornecedores[1] ['status'] }}
    <br>
    @isset($fornecedores[1]['cnpj'])
        CNPJ: {{ $fornecedores[1] ['cnpj'] }}
    @endisset
@endisset
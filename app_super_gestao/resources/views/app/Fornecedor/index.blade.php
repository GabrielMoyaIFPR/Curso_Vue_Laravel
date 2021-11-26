<h3>Fornecedor</h3>

{{-- Fica o comentário descartado pelo interpretador do blade--}}

@php

@endphp

@if(count($fornecedores) > 0 && count($fornecedores) < 10)
    <h3>Existem alguns fornecedores aqui</h3>

@elseif(count($fornecedores) > 10)
   <h3>Existem vários fornecedores aqui</h3> 

@else
    <h3>Nenhum fornecedor aqui</h3>
@endif
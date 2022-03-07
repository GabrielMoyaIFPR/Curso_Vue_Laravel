<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    //Filtrar os Detalhes do produto percorrendo todos os produtos direto no ELOQUENT ORM
    public function produtoDetalhe() {
        return $this->hasOne('App\ProdutoDetalhe');
    }
}

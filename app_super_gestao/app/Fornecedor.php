<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;

    // Definindo tabela padrão para o Eloquent
    protected $table = 'fornecedores';

    //Permite receber os dados através de um array
    protected $fillable = ['nome', 'site', 'uf', 'email'];

    public function produtos() {
        return $this->hasMany('App\Item', 'fornecedor_id', 'id');
    }

}

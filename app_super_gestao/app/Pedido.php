<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
   protected $fillable = ['cliente_id'];

   public function produtos() {
      // return $this->belongsToMany('App\Produto', 'pedidos_produtos');
      return $this->belongsToMany('App\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id','created_at');
      
      /* Parâmetros: 
         1- Modelo de relacionamento com relação ao que estamos implementando
         2- Tabela auxiliar que armazena os registros do relacionamento
         3- Fk da tabela mapeada pelo modelo na tabela de relacionamento
         4- Fk da tabela mapeada pelo model utilizado no relacionamento que está sendo implementado
      */
   }
}
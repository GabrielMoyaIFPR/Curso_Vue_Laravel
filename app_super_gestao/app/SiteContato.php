<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Como o Eloquent identifica a tabela no banco // 
// Site_Contato
// site_contato
// site_contatos

class SiteContato extends Model
{
    protected $fillable = ['nome', 'telefone', 'email', 'motivo_contato', 'mensagem'];
    
}

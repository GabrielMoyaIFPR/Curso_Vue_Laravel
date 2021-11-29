<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(){
        $fornecedores = [
            0=> [
                'nome'=>'Fornecedor 1',
                'status'=> 'N',
                'cnpj'=> '0000000000'
        
            ],
            1=> [
                'nome'=>'Fornecedor 2',
                'status'=> 'S', 
                'cnpj'=> ''   
            ]
        ];

        $msg = isset($fornecedores[1]['cnpj']) ? 'CNPJ informado' : 'CNPJ informado';
        echo $msg;
        
        return view('app.fornecedor.index', compact('fornecedores'));
    }
}

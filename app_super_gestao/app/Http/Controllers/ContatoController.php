<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request) {
        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'required|email|unique:site_contatos',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',
        ];
        $feedbacks = [
            'required' => 'O campo :attribute é obrigatório!',
            'nome.min' => 'O nome deve ter no mínimo 3 Caracteres!',
            'nome.max' => 'O nome deve ter no máximo 40 Caracteres!',
            'nome.unique' => 'O nome já está sendo utilizado!',
            'motivo_contatos_id.required' => 'O motivo do contato é obrigatório!',
            'email.email' => 'O e-mail deve ser válido!',
            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres'

        ];

        // Realizar validação dos dados do formulários
        $request->validate($regras, $feedbacks);
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}

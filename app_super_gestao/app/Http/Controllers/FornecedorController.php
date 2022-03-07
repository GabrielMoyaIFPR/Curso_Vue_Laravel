<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
class FornecedorController extends Controller
{
    //Página Inicial
    public function index() {
        return view('app.fornecedor.index');
    }

    //Listar Fornecedores
    public function listar(Request $request) {

        //Filtrar fornecedores de acordo com os dados preenchidos nos campos
        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
                                        ->where('site', 'like', '%'.$request->input('site').'%')
                                        ->where('uf', 'like', '%'.$request->input('uf').'%')
                                        ->where('email', 'like', '%'.$request->input('email').'%')
                                        ->paginate(5);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all() ]);
    }

    // Adicionar novo cadastro
    public function adicionar(Request $request) {

        $msg = '';

        // Verificar se o token não está preenchido e se o Id não está informado
        if($request->input('_token') != '' && $request->input('id') == '') {

            //Validação de regras dos campos e coleta de feedbacks
            $regras = [
                'nome'=> 'required|min:3|max:40',
                'site'=> 'required',
                'uf'=> 'required|min:2|max:2',
                'email'=> 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido!',
                'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O nome deve ter no máximo 3 caracteres',
                'uf.min' => 'UF deve ter no mínimo 2 caracteres',
                'uf.max' => 'UF nome deve ter no máximo 2 caracteres',
                'email.email' => 'O e-mail deve ser válido!'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            //Mensagem de sucesso
            $msg = 'Cadastro realizado com sucesso!';
        }

        //Edição
        if($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());
            
            if($update) {
                $msg = 'Atualização realizada com Sucesso';
            }
            else{
                $msg = 'Erro ao tentar atualizar';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    // Editar um cadastro
    public function editar($id, $msg = '' ) {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg ]);
    }

    //Excluir um cadastro 
    public function excluir($id) {
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}

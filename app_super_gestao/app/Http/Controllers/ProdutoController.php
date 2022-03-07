<?php

namespace App\Http\Controllers;

use App\Unidade;
use App\Produto;
use App\Item;
use App\ProdutoDetalhe;
use App\Fornecedor;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Filtrar produtos com EagerLoading
        //$produtos = Item::with(['itemDetalhe'])->paginate(10);

        //Filtrar produtos  com LazyLoading
        $produtos = Item::paginate(10);

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fornecedores = Fornecedor::all();
        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verificar se o token não está preenchido e se o Id não está informado
        if($request->input('_token') != '' && $request->input('id') == '') {

            //Validação de regras dos campos e coleta de feedbacks
            $regras = [
                'nome'=> 'required|min:3|max:40',
                'descricao'=> 'required|min:3|max:2000',
                'peso'=> 'required|integer',
                'unidade_id'=> 'exists:unidades,id',
                'fornecedor_id'=> 'exists:fornecedores,id',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido!',
                'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O nome deve ter no máximo 3 caracteres',
                'descricao.min' => 'A descrição deve ter no mínimo 3 caracteres',
                'descricao.max' => 'A descrição deve ter no máximo 3 caracteres',
                'peso.integer' => 'O peso deve ser um número inteiro',
                'unidade_id.exists' => 'A unidade de medida informada não existe!',
                'fornecedor_id.exists' => 'O fornecedor informado não existe!'
            ];

            $request->validate($regras, $feedback);

            Item::create($request->all());
            return redirect()->route('produto.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
        // return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $produto)
    {
        //Validação de regras dos campos e coleta de feedbacks
        $regras = [
            'nome'=> 'required|min:3|max:40',
            'descricao'=> 'required|min:3|max:2000',
            'peso'=> 'required|integer',
            'unidade_id'=> 'exists:unidades,id',
            'fornecedor_id'=> 'exists:fornecedores,id',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O nome deve ter no máximo 3 caracteres',
            'descricao.min' => 'A descrição deve ter no mínimo 3 caracteres',
            'descricao.max' => 'A descrição deve ter no máximo 3 caracteres',
            'peso.integer' => 'O peso deve ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe!',
            'fornecedor_id.exists' => 'O fornecedor informado não existe!'
        ];
        $request->validate($regras, $feedback);

        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}

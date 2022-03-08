<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home sem login
Route::get('/', 'PrincipalController@principal')->name('site.index');
        
// Sobre-Nós
Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');

// Contato
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');

// Login
Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

//Usuário Logado
Route::middleware('autenticacao:padrao, visitante')->prefix('/app')->group(function() {

    // Layout do Menu
    Route::get('/home', 'HomeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');

    // Fornecedores
    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');
    Route::post('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');

    // Produtos (Cadastro simplificado do Laravel)
    Route::resource('produto', 'ProdutoController');

    //Produtos Detalhes (Cadastro simplificado do Laravel)
    Route::resource('produto-detalhe', 'ProdutoDetalheController');

    //Clientes (Cadastro simplificado do Laravel)
    Route::resource('cliente', 'ClienteController');

    //Pedidos (Cadastro simplificado do Laravel)
    Route::resource('pedido', 'PedidoController');

    //Pedidos Produtos (Cadastro simplificado do Laravel)
    // Route::resource('pedido-produto', 'PedidoProdutoController');
    Route::get('pedido-produto/create/{pedido}', 'PedidoProdutoController@create')->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', 'PedidoProdutoController@store')->name('pedido-produto.store');
    // Route::delete('pedido-produto/destroy/{pedido}/{produto}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy'); 
    Route::delete('pedido-produto/destroy/{pedidoProduto}/{pedido_id}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
});

// Teste de rota
Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('site.teste');

// Em caso de página inexistente
Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para ir para página inicial';
});

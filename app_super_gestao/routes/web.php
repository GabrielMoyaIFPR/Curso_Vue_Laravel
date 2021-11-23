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

Route::get('/', 'PrincipalController@principal');
Route::get('/sobre-nos', 'SobreNosController@sobrenos');
Route::get('/contato', 'ContatoController@contato');

Route::get('/contato/{nome}/{categoria}/{assunto}/{mensagem?}', 
function(string $nome, string $categoria,string $assunto,string $mensagem = 'Mensagem não informada') {

    echo "Estamos aqui: $nome - $categoria - $assunto - $mensagem";
});


// Route::get('/', function () {
//     return 'Olá, seja bem vindo ao Curso!';
// });

// Route::get('/sobre-nos', function () {
//     return 'Sobre Nós';
// });

// Route::get('/contato', function () {
//     return 'Contato';
// });


/*

//Estrutura da rota//
Route::get($uri, $callback)

//Métodos://
get
post
put
patch
delete
options
*/
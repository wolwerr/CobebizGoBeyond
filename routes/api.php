<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//? Rota de Teste retornando um array.
Route::get('/message', 'APIController@showMessage')->middleware('iphone');

//? Rota de teste action.
Route::post('/action', 'APIController@showAction');

//? Rotas para o controller Pessoas.

Route::get('listagem-pessoa',
            'APIPessoasController@listagemDePessoas')->middleware('authenticate-api');

//? Rota para listagem de pessoa por id.
Route::get('listagem-pessoa/{id}',
            'APIPessoasController@listagemDePessoasById')->middleware('authenticate-api');

//? Rota para cadastrar.
Route::post('cadastro-pessoa', 'APIPessoasController@cadastraPessoa');

//? Rota para atualizar.
Route::put('atualizar-pessoa/{id}', 'APIPessoasController@atualizarPessoa');

//? Rota para deletar.
Route::delete('deletar-pessoa/{id}', 'APIPessoasController@deletePessoa');


Route::get('vtexService', 'ServicesAPIVtexController@listagemSearchVtex');


//? Rotas Chilli Beans
Route::get('chillibeans', 'ChilliBeansAPIController@listagemSearchVtex');
Route::get('pegarDadosApi', 'ServicesAPIVtexController@pegarDadosApi');

//? Rota para cadastrar.
Route::post('cadastrar-produtos', 'ChilliBeansAPIController@cadastraProdutos');

//? ListagemProdutos
Route::get('listagem-produtos', 'ChilliBeansAPIController@listagemDeProdutos');

//? Rota para listagem de produtos por id.
Route::get('listagem-produtos/{produtoId}',
            'ChilliBeansAPIController@listagemDeProdutosById');

//? Rota para atualizar.
Route::put('atualizar-produto/{produtoId}',
            'ChilliBeansAPIController@atualizarProdutos');

//? Rota para deletar.
Route::delete('deletar-produto/{produtoId}',
                'ChilliBeansAPIController@deleteProdutos');

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Rotas referênte a Pessoa
|--------------------------------------------------------------------------
*/

Route::get('pessoa/listar', 'PessoaController@getPessoas');
Route::get('pessoa/visualizar/{id}', 'PessoaController@getPessoa');
Route::post('pessoa/salvar', 'PessoaController@salvar');
Route::put('pessoa/excluir/{id}', 'PessoaController@excluir');


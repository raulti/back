<?php

/*
|--------------------------------------------------------------------------
| Rotas referênte a Pessoa
|--------------------------------------------------------------------------
*/

Route::get('contato/listar', 'PessoaController@getPessoas');
Route::get('contato/visualizar/{id}', 'PessoaController@getPessoa');
Route::post('contato/salvar', 'PessoaController@salvar');
Route::get('contato/excluir/{id}', 'PessoaController@excluir');


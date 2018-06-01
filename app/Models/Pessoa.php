<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Responsável por 'Pessoa'.
 */
class Pessoa extends Model
{

    protected $table = 'pessoa';

    public $fillable = [
        'cpf',
        'nome',
        'email',
        'celular',
        'st_ativo',
        'telefone',
        'sobrenome',
        'dt_nascimento'
    ];
}
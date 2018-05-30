<?php

namespace App\Repositories;

use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

/**
 * Repositório resonsável por implementar inteirações com o banco de dados referente ao 'Pessoa'.
 */
class PessoaRepository
{

    protected $pessoa;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * Insere ou altera registro na base de dados.
     *
     * @param Pessoa $pessoa
     */
    public function salvar(Pessoa $pessoa)
    {
        $data = (array) $pessoa;

        if (empty($pessoa->id)) {
            return $this->pessoa->create($data);
        } else {
            $this->pessoa::find($pessoa->id)->update($data);
        }
    }

    /**
     * Retorna lista de pessoas cadastrardas na base de dados.
     */
    public function getPessoas()
    {
        return $this->pessoa
               ->where('tipo', $tipo)
               ->where('st_ativo', true)
               ->get();
    }

    /**
     * Retorna pessoa por id informado.
     *
     * @param integer $id
     */
    public function getPessoaPorId($id)
    {
        return $this->pessoa->find($id);
    }

    /**
     * Inativa registro na base de dados.
     */
    public function inativar($id)
    {
        $this->pessoa
             ->find($id)
             ->update(['st_ativo' => false]);
    }
}

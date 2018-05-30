<?php

namespace App\BO;

use App\Model\Pessoa;
use Illuminate\Support\Facades\DB;
use App\Repositories\PessoaRepository;

/**
 * Resonsável por implementar as regras de negócio referênte a 'Pessoa'
 */
class PessoaBO
{
    protected $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepository = $pessoaRepository;
    }

    /**
     * Insere ou altera registro na base de dados.
     *
     * @param Pessoa $pessoa
     */
    public function salvar(Pessoa $pessoa)
    {
        try {
            return $this->pessoaRepository->salvar($pessoa);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Retorna dados de pessoa por parâmetro informado
     *
     * @param integer $id
     */
    public function getPessoaPorId($id)
    {
        return $this->pessoaRepository->getPessoaPorId($id);
    }

    /**
     * Inativa registro da base de dados
     */
    public function inativar($id)
    {
        return $this->pessoaRepository->inativar($id);
    }
}

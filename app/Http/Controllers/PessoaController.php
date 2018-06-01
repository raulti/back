<?php

namespace App\Http\Controllers;

use App\BO\PessoaBO;
use Illuminate\Http\Request;

class PessoaController extends Controller
{

    protected $pessoaBO;

    public function __construct(PessoaBO $pessoaBO)
    {
        $this->pessoaBO = $pessoaBO;
    }

    /**
     * Salva registro na base de dados
     *
     * @param Request $request
     */
    public function salvar(Request $request)
    {
        $pessoaTO = (object) $request->all();
 
        $pessoa = new \stdClass();
        $pessoa->st_ativo = true;
        $pessoa->cpf = $pessoaTO->cpf;
        $pessoa->nome = $pessoaTO->nome;
        $pessoa->email = $pessoaTO->email;
        $pessoa->celular = $pessoaTO->celular;
        $pessoa->sobrenome = $pessoaTO->sobrenome;
        $pessoa->dt_nascimento = $pessoaTO->dtNascimento;
        $pessoa->telefone = ! empty($pessoaTO->telefone) ? $pessoaTO->telefone : null;
        
        try {
            return $this->pessoaBO->salvar($pessoa);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Retorna lista de pessoas
     *
     * @param integer $tipo
     */
    public function getPessoas()
    {
         try {
            $pessoas = $this->pessoaBO->getPessoas();

            foreach ($pessoas as $pessoa) {
                $pessoa->cpf = $this->pessoaBO->getCpfFormatado($pessoa->cpf);
                $pessoa->celular = $this->pessoaBO->getTelefoneFormatado($pessoa->celular);
                $pessoa->telefone = $this->pessoaBO->getTelefoneFormatado($pessoa->telefone);
                $pessoa->dt_nascimento = $this->pessoaBO->getDataFormatoView($pessoa->dt_nascimento);
            }

            return $pessoas;

        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Retorna pessoa por id informado
     *
     * @param integer $id
     */
    public function getPessoaPorId($id)
    {
        try{
            return $this->pessoaBO->getPessoaPorId($id);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Inativa registro na base de dados
     *
     * @param $id
     */
    public function excluir($id)
    {
        try {
            $this->pessoaBO->inativar($id);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}

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
    public function salvar($request)
    {
        $pessoa = (object) $request->all();
        
        try {
            $pessoa->st_ativo = true;
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
    public function getPessoasPorTipo()
    {
         try {
            return $this->pessoaBO->getPessoas();
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

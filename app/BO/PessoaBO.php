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
    const FORMATO_TELEFONE_NOVE_DIGITOS = "#####-####";

    const FORMATO_TELEFONE_OITO_DIGITOS = "####-####";

    const FORMATO_CPF = "###.###.###-##";

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
    public function salvar($pessoa)
    {
        try {
            return $this->pessoaRepository->salvar($pessoa);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Retorna registro de pessoa por id informado.
     *
     * @param integer $id
     */
    public function getPessoaPorId($id)
    {
        return $this->pessoaRepository->getPessoaPorId($id);
    }

    /**
     * Retorna lista de pessoas.
     *
     * @param integer $id
     */
    public function getPessoas()
    {
        return $this->pessoaRepository->getPessoas();
    }

    /**
     * Inativa registro da base de dados.
     */
    public function inativar($id)
    {
        return $this->pessoaRepository->inativar($id);
    }

    /**
     * Retorna o 'cpf' informado formatado.
     *
     * @param string $cpf
     * @return string
     */
    public function getCpfFormatado($cpf)
    {
        $cpfFormatado = '';

        if (! empty($cpf)) {
            $cpfFormatado = $this->mask($cpf, static::FORMATO_CPF);
        }
        return $cpfFormatado;
    }

    /**
     * Formata o valor considerando o formato informado.
     *
     * @param string $value
     * @param string $pattern
     * @return string|unknown
     */
    private function mask($value, $pattern)
    {
        $count = 0;
        $formatted = '';

        for ($index = 0; $index <= strlen($pattern) - 1; $index ++) {
            if ($pattern[$index] == '#') {
                $formatted .= isset($value[$count]) ? $value[$count ++] : '';
            } else {
                $formatted .= isset($pattern[$index]) ? $pattern[$index] : '';
            }
        }
        return $formatted;
    }

    /**
     * Retorna o número de Telefone formatado considerando a existência de telefones com 8 e 9 dígitos.
     *
     * @param $numero
     * @return mixed|string|unknown
     */
    public function getTelefoneFormatado($numero)
    {
        if (!empty($numero)) {
            $numero = $this->getOnlyNumbers($numero);

            if (strlen($numero) == 8) {
                $numero = $this->mask($numero, static::FORMATO_TELEFONE_OITO_DIGITOS);
            }

            if (strlen($numero) == 9) {
                $numero = $this->mask($numero, static::FORMATO_TELEFONE_NOVE_DIGITOS);
            }
        }
        return $numero;
    }

    /**
     * Retorna os números conforme o valor informado.
     *
     * @param string $value
     * @return mixed
     */
    public function getOnlyNumbers($value)
    {
        $numbers = null;

        if (! empty($value)) {
            $numbers = preg_replace('/[^0-9]/', '', $value);
            $numbers = count($numbers) == 0 ? null : $numbers;
        }
        return $numbers;
    }

    /**
    *Retorna a data no formato na View
    */
    public function getDataFormatoView($data)
    {
      return empty($data) ? null : date('d/m/Y',  strtotime($data));
    }
}

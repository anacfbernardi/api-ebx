<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Api controller.
 */
class ApiController extends Controller
{
    /**
     * Criar resposta http com erros.
     *
     * @param $httpStatusCode
     * @param $erros
     * @return JsonResponse
     */
    protected function criarRespostaComErros($httpStatusCode, $erros)
    {
        $response['status'] = $httpStatusCode;
        $response['erros'] = $erros;

        return response()->json($response, $httpStatusCode);
    }

    /**
     * Criar resposta http.
     *
     * @param int $httpStatusCode
     * @param array $dados
     * @param string $mensagemErro
     * @param string $excecao
     * @return JsonResponse
     */
    protected function criarResposta($httpStatusCode, $dados = [], $mensagemErro = null, $excecao = null)
    {
        $response['status'] = $httpStatusCode;
        if ($dados) {
            foreach ($dados as $key => $value) {
                if (isset($value['paginacao'])) {
                    $response['paginacao'] = $value['paginacao'];
                    $response['dados'][$key] = $value['dados'];
                }
            }
            if (!isset($response['dados'])) {
                $response['dados'] = $dados;
            }
        }

        if ($mensagemErro) {
            $erro['mensagem'] = $mensagemErro;
            $response['erros'] = [
                $erro
            ];
        }

        return response()->json($response, $httpStatusCode,[], JSON_UNESCAPED_UNICODE);
    }

}

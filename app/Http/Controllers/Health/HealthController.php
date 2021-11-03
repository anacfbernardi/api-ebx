<?php

namespace App\Http\Controllers\Health;

use Symfony\Component\HttpFoundation\Response;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

/**
 * Controller responsavel por checar se a aplicação está rodando.
 */
class HealthController extends ApiController
{
    /**
     * Construtor padrão.
     */
    public function __construct()
    {
        
    }

    /**
     * Recuperar todas as empresas.
     *
     * @return Response
     */
    public function mostrar()
    {
        try {
            return $this->criarResposta(Response::HTTP_OK, null, null);
        } catch (\Exception $ex) {
            return $this->criarResposta(Response::HTTP_INTERNAL_SERVER_ERROR, null, null);
        }
    }
}

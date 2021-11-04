<?php

namespace App\Http\Controllers\Reset;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiController;

/**
 * Reset Controller
 */
class ResetController extends ApiController
{
    /**
     * Default constructor
     */
    public function __construct()
    {
    }

    /**
     * Delete accounts and balances
     *
     * @return Response
     */
    public function reset()
    {
        try {
            return $this->criarResposta(Response::HTTP_OK, null, null);
        } catch (\Exception $ex) {
            return $this->criarResposta(Response::HTTP_INTERNAL_SERVER_ERROR, null, null);
        }
    }
}

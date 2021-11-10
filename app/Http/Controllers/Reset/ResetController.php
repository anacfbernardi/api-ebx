<?php

namespace App\Http\Controllers\Reset;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiController;
use App\Business\Reset\ResetBiz;

/**
 * Reset Controller
 */
class ResetController extends ApiController
{

    private $resetBiz;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->resetBiz = new ResetBiz();
    }

    /**
     * Delete accounts and balances
     *
     * @return Response
     */
    public function reset()
    {
        try {
            $this->resetBiz->reset();
            return $this->createResponse(Response::HTTP_OK, 'OK');
        } catch (\Exception $ex) {
            return $this->createResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

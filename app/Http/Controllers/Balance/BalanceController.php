<?php

namespace App\Http\Controllers\Balance;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

/**
 * Balance Controller
 */
class BalanceController extends ApiController
{
    /**
     * Default constructor
     */
    public function __construct()
    {
    }

    /**
     * Get account balance.
     *
     * @return Response
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'account_id' => 'required|numeric'
        ]);

        try {
            return $this->criarResposta(Response::HTTP_OK, null, null);
        } catch (\Exception $ex) {
            return $this->criarResposta(Response::HTTP_INTERNAL_SERVER_ERROR, null, null);
        }
    }
}

<?php

namespace App\Http\Controllers\Balance;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Business\Balance\BalanceBiz;

/**
 * Event Controller
 */
class BalanceController extends ApiController
{

    private $balanceBiz;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->balanceBiz = new BalanceBiz();
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
            $balance = $this->balanceBiz->getBalance($request['account_id']);

            if (empty($balance)) {
                return $this->createResponse(Response::HTTP_NOT_FOUND, null, 'Not found');
            }
            return $this->createResponse(Response::HTTP_OK, $balance['balance'], null);
        } catch (\Exception $ex) {
            return $this->createResponse(Response::HTTP_INTERNAL_SERVER_ERROR, null, null);
        }
    }
}

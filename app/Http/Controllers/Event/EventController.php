<?php

namespace App\Http\Controllers\Event;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

/**
 * Event Controller
 */
class EventController extends ApiController
{
    /**
     * Default constructor
     */
    public function __construct()
    {
    }

    /**
     * Criar evento
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|in:deposit,withdraw,transfer',
            'destination' => 'required_if:type,deposit,transfer|numeric',
            'origin' => 'required_if:type,withdraw,transfer|numeric',
            'amount' => 'required|numeric'
        ]);

        try {
            return $this->criarResposta(Response::HTTP_CREATED, null, null);
        } catch (\Exception $ex) {
            return $this->criarResposta(Response::HTTP_INTERNAL_SERVER_ERROR, null, null);
        }
    }
}

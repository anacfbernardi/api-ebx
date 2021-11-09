<?php

namespace App\Http\Controllers\Event;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Business\Event\EventBiz;

/**
 * Event Controller
 */
class EventController extends ApiController
{
    private $eventBiz;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->eventBiz = new EventBiz();
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
            $event = $this->eventBiz->create($request->all());

            if (empty($event)) {
                return $this->createResponse(Response::HTTP_NOT_FOUND, 0);
            }

            return $this->createResponse(Response::HTTP_CREATED, $event);
        } catch (\Exception $ex) {
            return $this->createResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

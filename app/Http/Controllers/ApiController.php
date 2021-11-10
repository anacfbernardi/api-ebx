<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Api controller.
 */
class ApiController extends Controller
{
    /**
     * Create http response.
     *
     * @param int $httpStatusCode
     * @param array $data
     * @param string $errorMessage
     * @return JsonResponse
     */
    protected function createResponse($httpStatusCode, $data = [])
    {
        return response($data, $httpStatusCode);
    }
}

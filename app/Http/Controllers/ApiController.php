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
    protected function createResponse($httpStatusCode, $data = '')
    {
        $response = $data;

        return response()->json($response, $httpStatusCode, [], JSON_UNESCAPED_UNICODE);
    }
}

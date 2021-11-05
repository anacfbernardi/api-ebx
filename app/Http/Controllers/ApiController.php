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
    protected function createResponse($httpStatusCode, $data = [], $errorMessage = null)
    {
        $response['status'] = $httpStatusCode;
        if ($data) {
            foreach ($data as $key => $value) {
                $response['data'][$key] = $value['data'];
            }

            if (!isset($response['data'])) {
                $response['data'] = $data;
            }
        }

        if ($errorMessage) {
            $erro['message'] = $errorMessage;
            $response['erros'] = [
                $erro
            ];
        }

        return response()->json($response, $httpStatusCode, [], JSON_UNESCAPED_UNICODE);
    }
}

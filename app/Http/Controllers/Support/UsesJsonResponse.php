<?php

namespace App\Http\Controllers\Support;

use Illuminate\Http\Response;

trait UsesJsonResponse
{
    /**
     * Send prettified JSON response
     *
     * @param       $response
     * @param int   $status
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function sendJson($response, int $status = 200, array $headers = []) {
        return response()->json($response, $status, $headers, JSON_PRETTY_PRINT);
    }
}
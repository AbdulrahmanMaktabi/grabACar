<?php

namespace App\Helplers;

class ApiResponse
{
    static function sendResponse($code = 200, $msg = [], $data = [], $links = [], $meta = [])
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];

        if ($links) {
            $response['links'] = $links;
        }

        if ($meta) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $code);
    }
}

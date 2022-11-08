<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function returnResponse(array $response, string $message, $code)
    {
        $code = is_int($code) ? $code : 500;
        return Response::json([
            'success' =>  ($code == 200),
            'message' => $message,
            'response' => $response ?? []
        ], $code);
    }
}

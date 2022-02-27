<?php

namespace App\Responses;

use App\Services\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    public function sendResponse($data)
    {
        echo json_encode($data);
    }
}
<?php

namespace App\Helpers;

use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;

class ResponseHelper
{

    #[ArrayShape(['message' => "string", 'status' => "false", 'statusCode' => "int", 'data' => "array"])]
    public static function error(string $message, int $statusCode = Response::HTTP_BAD_REQUEST, array $data = []): array
    {
        return array('message' => $message, 'status' => false, 'statusCode' => $statusCode, 'data' => $data);
    }

    #[ArrayShape(['message' => "string", 'status' => "bool", 'statusCode' => "int", 'data' => "array"])]
    public static function success(string $message, int $statusCode = Response::HTTP_OK, array $data = []): array
    {
        return array('message' => $message, 'status' => true, 'statusCode' => $statusCode, 'data' => $data);
    }

    #[ArrayShape(['status' => "bool", 'message' => "string"])]
    public static function statusAction(string $message, bool $status): array
    {
        return ['status' => $status, 'message' => $message];
    }
}

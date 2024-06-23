<?php

use Core\Http\Response\Response;
use Core\Http\Response\ResponseFactory;
use Core\Http\Response\ResponseEnum;
use Core\Http\Response\ResponseJson;

if (!function_exists('response')) {

    /**
     * @param mixed $data
     * @param string $message
     * @param ResponseEnum $statusMessage
     * @param int $status
     * @param array $headers
     * @return ResponseFactory|Response|ResponseJson
     * @throws Exception
     */
    function response(mixed $data = '', string $message = '', int $status = 200, ResponseEnum $statusMessage = ResponseEnum::success, array $headers = []): ResponseFactory|Response|ResponseJson
    {
        $factory = new ResponseFactory();

        if (func_num_args() === 0) {
            return $factory;
        }

        if ($data instanceof Throwable) {
            return $factory->exception($data, $message);
        }

        if (is_array($data)) {
            return $factory->json([
                'status' => $statusMessage,
                'data' => $data,
                'message' => $message,
            ], $status, $headers);
        }

        return $factory->make($data, $status, $headers);
    }
}
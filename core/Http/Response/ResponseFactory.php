<?php
namespace Core\Http\Response;

class ResponseFactory{

    /**
     * @param mixed $content
     * @param int $status
     * @param array $headers
     * @return Response
     * @throws \Exception
     */
    public function make(mixed $content = '', int $status = 200, array $headers = []): Response
    {
        return new Response($content, $status, $headers);
    }

    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return ResponseJson
     * @throws \Exception
     */
    public function json(mixed $data = null, int $status = 200, array $headers = [])
    {
        return new ResponseJson($data , $status, $headers);
    }


    /**
     * @param \Exception|\Error|\Throwable $exception
     * @param null $message
     * @param int $code
     * @param ResponseEnum $status
     * @return ResponseJson
     * @throws \Exception
     */
    public function exception(\Exception|\Error|\Throwable $exception, $message = null, int $code = 401, ResponseEnum $status = ResponseEnum::fail): ResponseJson
    {
        return new ResponseJson([
            'status' => $status,
            'message' => $message ?? $exception->getMessage(),
        ], $code);
    }
}
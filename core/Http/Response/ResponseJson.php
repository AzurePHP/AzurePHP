<?php
namespace Core\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse as SymfonyResponse;

class ResponseJson extends SymfonyResponse{

    /**
     * @throws \Exception
     */
    public function __construct(mixed $data = null, int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($data, $status, $headers, $json);
    }
}
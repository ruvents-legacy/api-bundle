<?php

namespace Ruvents\ApiBundle\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    const DEFAULT_CONTENT_TYPE = 'application/json; charset=utf-8';
    const DEFAULT_ENCODING_OPTIONS = JsonResponse::DEFAULT_ENCODING_OPTIONS | JSON_UNESCAPED_UNICODE;

    /**
     * @param mixed $data
     * @param int   $statusCode
     * @param array $headers
     */
    public function __construct($data, int $statusCode = 200, array $headers = [])
    {
        $this->encodingOptions = self::DEFAULT_ENCODING_OPTIONS;

        parent::__construct($data, $statusCode, $headers);

        if (!$this->headers->has('Content-Type')) {
            $this->headers->set('Content-Type', self::DEFAULT_CONTENT_TYPE);
        }
    }
}

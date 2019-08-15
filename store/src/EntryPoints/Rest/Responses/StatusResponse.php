<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;

class StatusResponse extends JsonResponse
{
    const ERROR = 'error';
    const OK = 'ok';

    public static function createResponse(string $status, int $httpStatusCode): StatusResponse
    {
        return new StatusResponse(
            [
                'status' => $status
            ],
            $httpStatusCode
        );
    }
}

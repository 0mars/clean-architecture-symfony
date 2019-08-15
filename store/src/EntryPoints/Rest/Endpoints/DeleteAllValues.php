<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Endpoints;

use Example\Store\Domain\UseCases\DeleteAllValuesUseCase;
use Example\Store\EntryPoints\Rest\Endpoints\Core\AbstractEndpoint;
use Example\Store\EntryPoints\Rest\Responses\StatusResponse;

class DeleteAllValues extends AbstractEndpoint
{
    /**
     * @var DeleteAllValuesUseCase
     */
    private $useCase;

    public function __construct(
        DeleteAllValuesUseCase $useCase
    ) {
        $this->useCase = $useCase;
    }

    public function execute(): StatusResponse
    {
        $this->useCase->execute();

        return StatusResponse::createResponse(StatusResponse::OK, 200);
    }
}

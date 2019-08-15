<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Endpoints;

use Example\Store\Domain\UseCases\DeleteValueUseCase;
use Example\Store\EntryPoints\Rest\Endpoints\Core\AbstractEndpoint;
use Example\Store\EntryPoints\Rest\Responses\StatusResponse;

class DeleteValue extends AbstractEndpoint
{
    /**
     * @var DeleteValueUseCase
     */
    private $useCase;

    public function __construct(
        DeleteValueUseCase $useCase
    ) {
        $this->useCase = $useCase;
    }

    public function execute(): StatusResponse
    {
        $id = $this->getRequest()->attributes->get('id');

        $this->useCase->execute($id);

        return StatusResponse::createResponse(StatusResponse::OK, 200);
    }
}

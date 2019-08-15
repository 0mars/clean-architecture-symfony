<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Endpoints;

use Example\Store\Domain\UseCases\SetValueUseCase;
use Example\Store\EntryPoints\Rest\Assemblers\KeyAssembler;
use Example\Store\EntryPoints\Rest\Endpoints\Core\AbstractResourceAwareEndpoint;
use Example\Store\EntryPoints\Rest\Resources\Key;
use Example\Store\EntryPoints\Rest\Responses\StatusResponse;
use Symfony\Component\Serializer\SerializerInterface;

class SetValue extends AbstractResourceAwareEndpoint
{
    /**
     * @var SetValueUseCase
     */
    private $setValueUseCase;

    public function __construct(
        SetValueUseCase $useCase,
        KeyAssembler $assembler,
        SerializerInterface $serializer
    ) {
        parent::__construct($assembler, $serializer);
        $this->setValueUseCase = $useCase;
    }

    public function execute(): StatusResponse
    {
        $requestBody = $this->getRequestBody();
        $entryResource = $this->serializer->deserialize(
            $requestBody,
            Key::class,
            'json'
        );

        $expireIn = (int)$this->getRequest()->query->get('expire_in', 0);

        $entryEntity = $this->assembler->resourceToEntity($entryResource);
        $this->setValueUseCase->execute($entryEntity, $expireIn);
        return StatusResponse::createResponse(StatusResponse::OK, 200);
    }
}

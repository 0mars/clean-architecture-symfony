<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Endpoints;

use Example\Store\Domain\UseCases\GetValueUseCase;
use Example\Store\EntryPoints\Rest\Assemblers\KeyAssembler;
use Example\Store\EntryPoints\Rest\Endpoints\Core\AbstractResourceAwareEndpoint;
use Example\Store\EntryPoints\Rest\Resources\Key;
use Symfony\Component\Serializer\SerializerInterface;

class GetValue extends AbstractResourceAwareEndpoint
{
    /**
     * @var GetValueUseCase
     */
    private $useCase;

    public function __construct(
        GetValueUseCase $useCase,
        KeyAssembler $assembler,
        SerializerInterface $serializer
    ) {
        parent::__construct($assembler, $serializer);
        $this->useCase = $useCase;
    }

    public function execute(): Key
    {
        $id = $this->getRequest()->attributes->get('id');

        $key = $this->useCase->execute($id);

        return $this->assembler->entityToResource($key);
    }
}

<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Endpoints;

use Doctrine\Common\Collections\ArrayCollection;
use Example\Store\Domain\UseCases\GetAllValuesUseCase;
use Example\Store\EntryPoints\Rest\Assemblers\KeyAssembler;
use Example\Store\EntryPoints\Rest\Endpoints\Core\AbstractResourceAwareEndpoint;
use Symfony\Component\Serializer\SerializerInterface;

class GetAllValues extends AbstractResourceAwareEndpoint
{
    /**
     * @var GetAllValuesUseCase
     */
    private $useCase;

    public function __construct(
        GetAllValuesUseCase $useCase,
        KeyAssembler $assembler,
        SerializerInterface $serializer
    ) {
        parent::__construct($assembler, $serializer);
        $this->useCase = $useCase;
    }

    public function execute(): ArrayCollection
    {
        $keys = $this->useCase->execute();

        return $this->assembler->entitiesToResources($keys);
    }
}

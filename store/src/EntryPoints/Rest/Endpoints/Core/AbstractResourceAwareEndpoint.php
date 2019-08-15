<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Endpoints\Core;

use Example\Store\EntryPoints\Rest\Assemblers\KeyAssembler;
use Symfony\Component\Serializer\SerializerInterface;

class AbstractResourceAwareEndpoint extends AbstractEndpoint
{
    /**
     * @var KeyAssembler
     */
    protected $assembler;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    public function __construct(KeyAssembler $assembler, SerializerInterface $serializer)
    {
        $this->assembler = $assembler;
        $this->serializer = $serializer;
    }
}

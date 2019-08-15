<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Endpoints\Core;

use Example\Store\EntryPoints\Rest\Assemblers\KeyAssembler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class AbstractEndpoint extends AbstractController
{
    protected function getRequest(): Request
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }

    protected function getRequestBody(): string
    {
        return $this->getRequest()->getContent();
    }
}

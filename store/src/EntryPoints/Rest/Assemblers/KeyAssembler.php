<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\Assemblers;

use Doctrine\Common\Collections\ArrayCollection;
use Example\Store\Domain\Entities\Key;
use Example\Store\EntryPoints\Rest\Resources\Key as KeyResource;

class KeyAssembler
{
    public function resourceToEntity(KeyResource $entryResource): Key
    {
        return new Key($entryResource->getId(), $entryResource->getValue());
    }

    public function entityToResource(Key $key): KeyResource
    {
        $resource = new KeyResource();
        $resource->setId($key->getId());
        $resource->setValue($key->getValue());
        return $resource;
    }

    public function entitiesToResources(ArrayCollection $entities): ArrayCollection
    {
        $resources = $entities->map(static function (Key $key) {
            $resource = new KeyResource();
            $resource->setId($key->getId());
            $resource->setValue($key->getValue());
            return $resource;
        });
        return $resources;
    }
}

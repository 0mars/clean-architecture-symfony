<?php
declare(strict_types=1);


namespace Example\Store\EntryPoints\Rest\DataProviders;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use Example\Store\EntryPoints\Rest\Resources\Key;

/**
 * @SuppressWarnings(PHPMD)
 */
class KeyItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * Retrieves an item.
     *
     * @param array|int|string $id
     *
     * @return object|null
     * @throws ResourceClassNotSupportedException
     *
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $key = new Key();
        $key->setId($id);
        return $key;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Key::class === $resourceClass;
    }
}

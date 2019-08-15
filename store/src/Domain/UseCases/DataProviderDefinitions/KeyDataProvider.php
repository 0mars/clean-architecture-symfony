<?php
declare(strict_types=1);


namespace Example\Store\Domain\UseCases\DataProviderDefinitions;

use Doctrine\Common\Collections\ArrayCollection;
use Example\Store\Domain\Entities\Key;

interface KeyDataProvider
{
    public function save(Key $entry, int $expireIn): void;

    public function findById($id): ?Key;

    public function findAll(): ArrayCollection;

    public function deleteById($id): bool;

    public function deleteAll(): void;
}

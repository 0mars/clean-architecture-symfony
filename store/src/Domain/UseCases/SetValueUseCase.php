<?php
declare(strict_types=1);


namespace Example\Store\Domain\UseCases;

use Example\Store\Domain\Entities\Key;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;

class SetValueUseCase
{
    /**
     * @var KeyDataProvider
     */
    private $dataProvider;

    public function __construct(KeyDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function execute(Key $entry, int $expireIn): void
    {
        $this->dataProvider->save($entry, $expireIn);
    }
}

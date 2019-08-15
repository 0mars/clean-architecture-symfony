<?php
declare(strict_types=1);


namespace Example\Store\Domain\UseCases;

use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;

class DeleteAllValuesUseCase
{
    /**
     * @var KeyDataProvider
     */
    private $dataProvider;

    public function __construct(KeyDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function execute(): void
    {
        $this->dataProvider->deleteAll();
    }
}

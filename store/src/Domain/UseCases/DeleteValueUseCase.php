<?php
declare(strict_types=1);


namespace Example\Store\Domain\UseCases;

use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;
use Example\Store\Domain\UseCases\Exception\ValueNotFoundException;

class DeleteValueUseCase
{
    /**
     * @var KeyDataProvider
     */
    private $dataProvider;

    public function __construct(KeyDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param string $id
     *
     * @throws ValueNotFoundException
     */
    public function execute(string $id): void
    {
        $gotDeleted = $this->dataProvider->deleteById($id);
        if (!$gotDeleted) {
            throw new ValueNotFoundException(sprintf('Unable to find value with the id \'%s\'', $id));
        }
    }
}

<?php
declare(strict_types=1);


namespace Example\Store\Domain\UseCases;

use Example\Store\Domain\Entities\Key;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;
use Example\Store\Domain\UseCases\Exception\ValueNotFoundException;

class GetValueUseCase
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
     * @return Key
     *
     * @throws ValueNotFoundException
     */
    public function execute(string $id): Key
    {
        $key = $this->dataProvider->findById($id);
        if (!$key) {
            throw new ValueNotFoundException(sprintf('Unable to find value with the key \'%s\'', $key));
        }

        return $key;
    }
}

<?php
declare(strict_types=1);


namespace Example\Store\Domain\UseCases;

use Doctrine\Common\Collections\ArrayCollection;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;

class GetAllValuesUseCase
{
    /**
     * @var KeyDataProvider
     */
    private $dataProvider;

    public function __construct(KeyDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function execute(): ArrayCollection
    {
        $keys = $this->dataProvider->findAll();

        return $keys;
    }
}

<?php
declare(strict_types=1);


namespace Example\Store\Tests\Domain\UseCases;

use Doctrine\Common\Collections\ArrayCollection;
use Mockery as m;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;
use Example\Store\Domain\UseCases\GetAllValuesUseCase;
use Example\Store\Tests\MockeryTestCase;

class GetAllValuesUseCaseTest extends MockeryTestCase
{
    /**
     * @test
     *
     * @group unit
     */
    public function execute(): void
    {
        $collection = new ArrayCollection();
        $keysProvider = m::mock(KeyDataProvider::class)
            ->shouldReceive('findAll')
            ->once()
            ->andReturn($collection)
            ->getMock();

        $useCase = new GetAllValuesUseCase($keysProvider);

        $allKeys = $useCase->execute();

        $this->assertSame($collection, $allKeys);
    }
}

<?php
declare(strict_types=1);


namespace Example\Store\Tests\Domain\UseCases;

use Mockery as m;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;
use Example\Store\Domain\UseCases\DeleteAllValuesUseCase;
use Example\Store\Tests\MockeryTestCase;

class DeleteAllValuesUseCaseTest extends MockeryTestCase
{
    /**
     * @test
     *
     * @group unit
     */
    public function execute(): void
    {
        $keysProvider = m::mock(KeyDataProvider::class)
            ->shouldReceive('deleteAll')
            ->once()
            ->withNoArgs()
            ->getMock();

        $useCase = new DeleteAllValuesUseCase($keysProvider);

        $useCase->execute();
    }
}

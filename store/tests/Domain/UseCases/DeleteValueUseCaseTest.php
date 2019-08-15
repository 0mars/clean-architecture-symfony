<?php
declare(strict_types=1);


namespace Example\Store\Tests\Domain\UseCases;

use Mockery as m;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;
use Example\Store\Domain\UseCases\DeleteValueUseCase;
use Example\Store\Domain\UseCases\Exception\ValueNotFoundException;
use Example\Store\Tests\MockeryTestCase;

class DeleteValueUseCaseTest extends MockeryTestCase
{
    /**
     * @test
     *
     * @group unit
     */
    public function execute(): void
    {
        $id = 'xyz';
        $idsProvider = m::mock(KeyDataProvider::class)
            ->shouldReceive('deleteById')
            ->once()
            ->with($id)
            ->andReturn(true)
            ->getMock();

        $useCase = new DeleteValueUseCase($idsProvider);

        $useCase->execute($id);
    }

    /**
     * @test
     *
     * @group unit
     */
    public function deleteANonExistingKey(): void
    {
        $this->expectException(ValueNotFoundException::class);

        $id = 'xyz';
        $idsProvider = m::mock(KeyDataProvider::class)
            ->shouldReceive('deleteById')
            ->once()
            ->with($id)
            ->andReturn(false)
            ->getMock();

        $useCase = new DeleteValueUseCase($idsProvider);

        $useCase->execute($id);
    }
}

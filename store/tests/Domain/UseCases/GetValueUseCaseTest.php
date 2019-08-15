<?php


namespace Example\Store\Tests\Domain\UseCases;

use Mockery as m;
use Example\Store\Domain\Entities\Key;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;
use Example\Store\Domain\UseCases\GetValueUseCase;
use Example\Store\Tests\MockeryTestCase;

class GetValueUseCaseTest extends MockeryTestCase
{
    /**
     * @test
     *
     * @group unit
     */
    public function execute(): void
    {
        $key = 'xyz';
        $entry = new Key($key, '3r553');
        $keysProvider = m::mock(KeyDataProvider::class)
            ->shouldReceive('findById')
            ->once()
            ->with($key)
            ->andReturn($entry)
            ->getMock();

        $useCase = new GetValueUseCase($keysProvider);

        $returnedEntry = $useCase->execute($key);

        $this->assertSame($entry, $returnedEntry);
    }
}

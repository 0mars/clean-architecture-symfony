<?php
declare(strict_types=1);


namespace Example\Store\Tests\Domain\UseCases;

use Mockery as m;
use Example\Store\Domain\Entities\Key;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;
use Example\Store\Domain\UseCases\SetValueUseCase;
use Example\Store\Tests\MockeryTestCase;

class SetValueUseCaseTest extends MockeryTestCase
{
    /**
     * @test
     *
     * @group unit
     */
    public function execute(): void
    {
        $entry = m::mock(Key::class)->makePartial();
        $expireIn = 60;

        $keysProvider = m::mock(KeyDataProvider::class)
            ->shouldReceive('save')
            ->once()
            ->with($entry, $expireIn)
            ->getMock();

        $useCase = new SetValueUseCase($keysProvider);


        $useCase->execute($entry, $expireIn);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Unit\Inventory\Checker;

use Mockery;
use Nedac\SyliusTemporarilyOutOfStockPlugin\Inventory\Checker\AvailabilityChecker;
use PHPUnit\Framework\TestCase;
use Sylius\Component\Inventory\Checker\AvailabilityCheckerInterface as InternalAvailabilityCheckerInterface;
use Sylius\Component\Inventory\Model\StockableInterface;

final class AvailabilityCheckerTest extends TestCase
{
    private function getInternalAvailabilityCheckerMock(
        bool $isStockAvailable = false
    ): InternalAvailabilityCheckerInterface {
        $checker = Mockery::mock(InternalAvailabilityCheckerInterface::class);

        $checker
            ->shouldReceive('isStockAvailable')
            ->andReturn($isStockAvailable)
        ;

        return $checker;
    }

    public function testCanInstantiate(): void
    {
        self::expectNotToPerformAssertions();

        new AvailabilityChecker($this->getInternalAvailabilityCheckerMock());
    }

    public function testReturnsFalseWhenNoStockIsAvailable(): void
    {
        $mock = Mockery::mock(StockableInterface::class);

        $availabilityChecker = new AvailabilityChecker($this->getInternalAvailabilityCheckerMock(false));
        $result = $availabilityChecker->isStockAvailable([$mock]);

        self::assertFalse($result);
    }

    public function testReturnsTrueIfAtLeastOneHasStock(): void
    {
        $mock = Mockery::mock(StockableInterface::class);

        $availabilityChecker = new AvailabilityChecker($this->getInternalAvailabilityCheckerMock(true));
        $result = $availabilityChecker->isStockAvailable([$mock]);

        self::assertTrue($result);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }
}

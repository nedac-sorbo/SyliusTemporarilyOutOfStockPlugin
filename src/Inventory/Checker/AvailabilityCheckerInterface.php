<?php

declare(strict_types=1);

namespace Nedac\SyliusTemporarilyOutOfStockPlugin\Inventory\Checker;

use Sylius\Component\Inventory\Model\StockableInterface;

interface AvailabilityCheckerInterface
{
    /**
     * @param iterable<int, StockableInterface> $stockables
     * @return bool
     */
    public function isStockAvailable(iterable $stockables): bool;
}

<?php

declare(strict_types=1);

namespace Nedac\SyliusTemporarilyOutOfStockPlugin\Inventory\Checker;

use Sylius\Component\Inventory\Checker\AvailabilityCheckerInterface as InternalAvailabilityCheckerInterface;
use Sylius\Component\Inventory\Model\StockableInterface;

final class AvailabilityChecker implements AvailabilityCheckerInterface
{
    private InternalAvailabilityCheckerInterface $internalAvailabilityChecker;

    public function __construct(InternalAvailabilityCheckerInterface $internalAvailabilityChecker)
    {
        $this->internalAvailabilityChecker = $internalAvailabilityChecker;
    }

    /**
     * @param iterable<int, StockableInterface> $stockables
     * @return bool
     */
    public function isStockAvailable(iterable $stockables): bool
    {
        foreach ($stockables as $stockable) {
            if ($this->internalAvailabilityChecker->isStockAvailable($stockable)) {
                return true;
            }
        }

        return false;
    }
}

<?php

declare(strict_types=1);

namespace Nedac\SyliusTemporarilyOutOfStockPlugin\Twig;

use Nedac\SyliusTemporarilyOutOfStockPlugin\Inventory\Checker\AvailabilityCheckerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class AvailabilityExtension extends AbstractExtension
{
    private AvailabilityCheckerInterface $availabilityChecker;

    public function __construct(AvailabilityCheckerInterface $availabilityChecker)
    {
        $this->availabilityChecker = $availabilityChecker;
    }

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('nedac_inventory_is_available', [$this->availabilityChecker, 'isStockAvailable'])
        ];
    }
}

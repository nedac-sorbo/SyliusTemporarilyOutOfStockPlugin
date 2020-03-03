<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop;

interface ProductShowPageInterface extends ProductIndexPageInterface
{
    public function isRibbonDisplayed(string $ribbonText): bool;
}

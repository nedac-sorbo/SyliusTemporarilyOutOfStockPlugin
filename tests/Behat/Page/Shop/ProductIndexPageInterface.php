<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop;

interface ProductIndexPageInterface
{
    public function productCardHasRibbonWithText(string $productName, string $ribbonText): bool;
    public function productCardDoesNotHaveRibbonWithText(string $productName, string $ribbonText): bool;
}

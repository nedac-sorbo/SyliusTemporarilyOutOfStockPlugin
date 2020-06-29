<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

abstract class AbstractProductPage extends SymfonyPage
{
    public function productCardHasRibbonWithText(string $productName, string $ribbonText): bool
    {
        $ribbonElement = $this->getDocument()->find(
            'xpath',
            sprintf(
                "descendant::*[@data-test-product-name = '%s']/" .
                "ancestor::*[@data-test-product]/" .
                "descendant::*[@data-test-product-out-of-stock]",
                $productName
            )
        );

        return null !== $ribbonElement && $ribbonElement->getText() === $ribbonText;
    }

    public function productCardDoesNotHaveRibbonWithText(string $productName, string $ribbonText): bool
    {
        return ! $this->productCardHasRibbonWithText($productName, $ribbonText);
    }
}

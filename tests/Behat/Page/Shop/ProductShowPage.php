<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop;

final class ProductShowPage extends AbstractProductPage implements ProductShowPageInterface
{
    public function isRibbonDisplayed(string $ribbonText): bool
    {
        $ribbonElement = $this->getDocument()->find(
            'xpath',
            "descendant::*[@data-product-image]/" .
            "descendant::*[@data-test-product-out-of-stock]"
        );

        return null !== $ribbonElement && $ribbonElement->getText() === $ribbonText;
    }

    public function getRouteName(): string
    {
        return 'sylius_shop_product_show';
    }
}

<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop;

final class ProductShowPage extends AbstractProductPage implements ProductShowPageInterface
{
    public function isRibbonDisplayed(string $ribbonText): bool
    {
        $imageDiv = $this->getDocument()->find('css', '#nedac-out-of-stock-product-image');
        if (null !== $imageDiv) {
            $ribbon = $imageDiv->find('css', '#nedac-out-of-stock-ribbon');
            if (null !== $ribbon && $ribbon->getText() === $ribbonText) {
                return true;
            }
        }

        return false;
    }

    public function getRouteName(): string
    {
        return 'sylius_shop_product_show';
    }
}

<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop;

final class ProductIndexPage extends AbstractProductPage implements ProductIndexPageInterface
{
    public function getRouteName(): string
    {
        return 'sylius_shop_product_index';
    }
}

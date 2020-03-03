<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

abstract class AbstractProductPage extends SymfonyPage
{
    public function productCardHasRibbonWithText(string $productName, string $ribbonText): bool
    {
        $cards = $this->getDocument()->findAll('css', '.ui.fluid.card');
        foreach ($cards as $card) {
            $header = $card->find('css', '.header.sylius-product-name');
            if (null !== $header && $header->getText() === $productName) {
                $ribbon = $card->find('css', '.ui.ribbon.label');
                if (null !== $ribbon && $ribbon->getText() === $ribbonText) {
                    return true;
                }
            }
        }

        return false;
    }

    public function productCardDoesNotHaveRibbonWithText(string $productName, string $ribbonText): bool
    {
        return ! $this->productCardHasRibbonWithText($productName, $ribbonText);
    }
}

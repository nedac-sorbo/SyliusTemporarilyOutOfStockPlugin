<?php

declare(strict_types=1);

namespace Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop\ProductIndexPageInterface;
use Tests\Nedac\SyliusTemporarilyOutOfStockPlugin\Behat\Page\Shop\ProductShowPageInterface;
use Webmozart\Assert\Assert;

final class ProductContext implements Context
{
    private ProductIndexPageInterface $indexPage;
    private ProductShowPageInterface $showPage;

    public function __construct(
        ProductIndexPageInterface $indexPage,
        ProductShowPageInterface $showPage
    ) {
        $this->indexPage = $indexPage;
        $this->showPage = $showPage;
    }

    /**
     * @Then I should see the ribbon with text :ribbonText on the :productName product card on the index page
     * @param string $ribbonText
     * @param string $productName
     */
    public function iShouldSeeTheRibbonWithTextOnTheProductCardOnTheIndexPage(
        string $ribbonText,
        string $productName
    ): void {
        Assert::true($this->indexPage->productCardHasRibbonWithText($productName, $ribbonText));
    }

    /**
     * @Then I should not see the ribbon with text :ribbonText on the :productName product card on the index page
     * @param string $ribbonText
     * @param string $productName
     */
    public function iShouldNotSeeTheRibbonWithTextOnTheProductCardOnTheIndexPage(
        string $ribbonText,
        string $productName
    ): void {
        Assert::true($this->indexPage->productCardDoesNotHaveRibbonWithText($productName, $ribbonText));
    }

    /**
     * @Then I should see the ribbon with text :ribbonText on the :productName product card on the show page
     * @param string $ribbonText
     * @param string $productName
     */
    public function iShouldSeeTheRibbonWithTextOnTheProductCardOnTheShowPage(
        string $ribbonText,
        string $productName
    ): void {
        Assert::true($this->showPage->productCardHasRibbonWithText($productName, $ribbonText));
    }

    /**
     * @Then I should see the ribbon with text :ribbonText on the product image
     * @param string $ribbonText
     */
    public function iShouldSeeTheRibbonWithTextOnTheProductImage(string $ribbonText): void
    {
        Assert::true($this->showPage->isRibbonDisplayed($ribbonText));
    }

    /**
     * @Then I should not see the ribbon with text :ribbonText on the product image
     * @param string $ribbonText
     */
    public function iShouldNotSeeTheRibbonWithTextOnTheProductImage(string $ribbonText): void
    {
        Assert::false($this->showPage->isRibbonDisplayed($ribbonText));
    }
}

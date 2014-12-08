<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class WebBasketContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->catalogue = new FilesystemCatalogue();
    }

    /**
     * @Transform :aSku
     */
    public function transformStringToASku($string)
    {
        return new Sku($string);
    }

    /**
     * @Transform :aCost
     */
    public function transformStringToACost($string)
    {
        return new Cost($string);
    }

    /**
     * @Given there is a product with SKU :aSku and a cost of £:aCost in the catalogue
     */
    public function thereIsAProductWithSkuAndACostOfPsInTheCatalogue(Sku $aSku, Cost $aCost)
    {
        $aProduct = Product::withSkuAndCost($aSku, $aCost);
        $this->catalogue->addProduct($aProduct);
    }

    /**
     * @When I add the product with SKU :sku from the catalogue to my basket
     */
    public function iAddTheProductWithSkuFromTheCatalogueToMyBasket($sku)
    {
        // Visit the page
        $this->visitPath('/catalogue');

        // Check that product is on the page
        $this->assertSession()->elementExists('css', ".product:contains('$sku')");

        // Click "Add to basket" in the product area
        $productElement = $this->getSession()->getPage()->find('css', ".product:contains('$sku')");
        $productElement->clickLink('Add to basket');
    }
}

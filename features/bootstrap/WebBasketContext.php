<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class WebBasketContext implements Context, SnippetAcceptingContext
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
        $this->catalogue = new InMemoryCatalogue();
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
}

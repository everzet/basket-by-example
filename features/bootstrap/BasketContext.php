<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class BasketContext implements Context, SnippetAcceptingContext
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
    }

    /**
     * @Given there is a product with SKU :arg1 and a cost of £:arg2 in the catalogue
     */
    public function thereIsAProductWithSkuAndACostOfPsInTheCatalogue($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When I add the product with SKU :arg1 from the catalogue to my basket
     */
    public function iAddTheProductWithSkuFromTheCatalogueToMyBasket($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the total price of my basket should be £:arg1
     */
    public function theTotalPriceOfMyBasketShouldBePs($arg1)
    {
        throw new PendingException();
    }
}

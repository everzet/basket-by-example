<?php

use Basket\Basket;
use Basket\Cost;
use Basket\Product;
use Basket\Sku;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

class DomainBasketContext implements Context
{
    private $catalogue;
    private $basket;

    public function __construct()
    {
        $this->basket = new Basket();
        $this->catalogue = new InMemoryCatalogue();
    }

    /**
     * @Given a product with sku :sku and a cost of £:cost was added to the catalogue
     */
    public function aProductWithSkuAndACostOfPsWasAddedToTheCatalogue(string $sku, float $cost)
    {
        $aProduct = new Product(new Sku($sku), new Cost($cost));
        $this->catalogue->addProduct($aProduct);
    }

    /**
     * @When I add :sku to my basket
     */
    public function iAddToMyBasket(string $sku)
    {
        $aProduct = $this->catalogue->getProductBySku(new Sku($sku));
        $this->basket->addProduct($aProduct);
    }

    /**
     * @Then the total basket cost should be £:cost
     */
    public function theTotalBasketCostShouldBePs($cost)
    {
        PHPUnit_Framework_Assert::assertEquals(new Cost($cost), $this->basket->totalCost());
    }
}

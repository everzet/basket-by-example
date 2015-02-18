<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class WebBasketContext extends MinkContext implements Context, SnippetAcceptingContext
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
        $this->catalogue = new Database();
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
     * @AfterScenario
     */
    public function cleanupDatabase()
    {
        $this->catalogue->update('DELETE FROM catalogue');
    }

    /**
     * @Given there is a product with SKU :aSku and a cost of £:aCost in the catalogue
     */
    public function thereIsAProductWithSkuAndACostOfPsInTheCatalogue(Sku $aSku, Cost $aCost)
    {
        $aProduct = Product::withSkuAndCost($aSku, $aCost);
        $this->catalogue->update('INSERT INTO catalogue(sku, product) VALUES(:sku, :product)', [
            'sku'     => (string)$aSku,
            'product' => serialize($aProduct)
        ]);
    }

    /**
     * @When I click :link inside :css
     */
    public function iClickInside($link, $css)
    {
        $this->getSession()->getPage()->find('css', $css)->clickLink($link);
    }
}

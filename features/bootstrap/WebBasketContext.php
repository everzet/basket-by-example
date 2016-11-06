<?php

use Basket\Cost;
use Basket\Product;
use Basket\Sku;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Web\Database;

class WebBasketContext extends MinkContext implements Context
{
    private $db;

    public function __construct(string $env)
    {
        $this->db = new Database(__DIR__ . "/../../db_{$env}.sqlite");
    }

    /**
     * @Given a product with sku :sku and a cost of £:cost was added to the catalogue
     */
    public function productWasAddedToTheCatalogue(string $sku, float $cost)
    {
        $aProduct = new Product(new Sku($sku), new Cost($cost));

        $this->db->update('INSERT INTO catalogue(sku, product) VALUES(:sku, :product)', [
            'sku'     => $aProduct->sku(),
            'product' => $aProduct
        ]);
    }

    /**
     * @When I click :css
     */
    public function iClick($css)
    {
        $this->getSession()->getPage()->find('css', $css)->click();
    }

    /**
     * @AfterScenario
     */
    public function cleanup()
    {
        $this->db->update('DELETE FROM catalogue');
    }
}

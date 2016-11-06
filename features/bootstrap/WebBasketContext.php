<?php

use Basket\Cost;
use Basket\Product;
use Basket\Sku;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Web\Sqlite;

class WebBasketContext extends MinkContext implements Context
{
    private $db;

    public function __construct(string $env)
    {
        $this->db = new Sqlite(__DIR__ . "/../../db_{$env}.sqlite");
    }

    /**
     * @Given there is a catalogue item:
     */
    public function thereIsAProduct(TableNode $table)
    {
        $productHash = $table->getRowsHash();

        $aProduct = new Product(
            new Sku($productHash['sku']),
            new Cost(mb_substr($productHash['cost'], 1))
        );

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

<?php

use Basket\Cost;
use Basket\Product;
use Basket\Sku;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Money\Money;
use Web\Database;

class WebBasketContext extends MinkContext implements Context
{
    private $database;

    public function __construct(string $dbFile)
    {
        $this->database = new Database($dbFile);
    }

    /**
     * @AfterScenario
     */
    public function cleanup()
    {
        $this->database->update('DELETE FROM catalogue');
    }

    /**
     * @Given there is a catalogue item:
     */
    public function thereIsAProduct(TableNode $table)
    {
        $sku = $table->getRowsHash()['sku'];
        $cost = mb_substr($table->getRowsHash()['cost'], 1);

        $product = new Product(new Sku($sku), new Cost(Money::GBP($cost * 100)));

        $this->database->update('INSERT INTO catalogue(sku, product) VALUES(:sku, :product)', [
            'sku'     => $product->sku(),
            'product' => $product
        ]);
    }

    /**
     * @When I click :css
     */
    public function iClick($css)
    {
        $this->getSession()->getPage()->find('css', $css)->click();
    }
}

<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

class WebBasketContext extends MinkContext implements Context
{
    private $db;

    public function __construct()
    {
        $this->db = new Sqlite();
    }

    /**
     * @AfterScenario
     */
    public function cleanupDatabase()
    {
        $this->db->update('DELETE FROM catalogue');
    }

    /**
     * @Given there is a catalogue item:
     */
    public function thereIsAProduct(TableNode $table)
    {
        $productHash = $table->getRowsHash();

        $aProduct = new CatalogueRecord(
            new Sku($productHash['sku']),
            new Cost(mb_substr($productHash['cost'], 1))
        );

        $this->db->update('INSERT INTO catalogue(sku, product) VALUES(:sku, :product)', [
            'sku'     => $aProduct->sku(),
            'product' => $aProduct
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

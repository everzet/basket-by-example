<?php

class Basket
{
    private $totalPrice;

    public function __construct()
    {
        $this->totalPrice = new Cost(0.0);
    }

    public function addProductFromCatalogue(Sku $sku, Catalogue $catalogue)
    {
        // TODO: write logic here
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}

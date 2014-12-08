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
        $aProduct = $catalogue->getProduct($sku);
        $this->totalPrice = $this->totalPrice->add($aProduct->getCost());
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}


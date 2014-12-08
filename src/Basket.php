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
        if (0 == $this->totalPrice->toFloat()) {
            return $this->totalPrice;
        }

        return $this->totalPrice->addPercent(20)->add(new \Cost(3.0));
    }
}

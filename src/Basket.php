<?php

class Basket
{
    private $totalPrice;

    public function __construct()
    {
        $this->totalPrice = new Cost(0.0);
    }

    public function addProduct(Product $aProduct)
    {
        $this->totalPrice = $this->totalPrice->add($aProduct->getCost());
    }

    public function getTotalPrice()
    {
        $totalPrice = $this->totalPrice;

        if (0 == $totalPrice->toFloat()) {
            return $totalPrice;
        }

        $priceWithVat = $totalPrice->addPercent(20);
        $deliveryCost = $this->calculateDeliveryCost();

        return $priceWithVat->add($deliveryCost);
    }

    /**
     * @return Cost
     */
    private function calculateDeliveryCost()
    {
        if ($this->totalPrice->toFloat() > 10.0) {
            return new \Cost(2.0);
        }

        return new \Cost(3.0);
    }
}

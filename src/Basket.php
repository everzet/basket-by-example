<?php

class Basket
{
    private $total;

    public function __construct()
    {
        $this->total = new Cost();
    }

    public function addProduct(Product $aProduct)
    {
        $this->total = $this->total->add($aProduct->cost());
    }

    public function total() : Cost
    {
        if ($this->total->isFree()) {
            return $this->total;
        }

        return $this->totalWithVAT()->add($this->deliveryCost());
    }

    private function totalWithVAT() : Cost
    {
        return $this->total->addPercent(20);
    }

    private function deliveryCost() : Cost
    {
        if ($this->total->isGreaterThan($this->cheapDeliveryThreshold())) {
            return $this->cheapDeliveryCost();
        }

        return $this->normalDeliveryCost();
    }

    private function cheapDeliveryThreshold() : Cost
    {
        return new Cost(10);
    }

    private function cheapDeliveryCost() : Cost
    {
        return new Cost(2);
    }

    private function normalDeliveryCost() : Cost
    {
        return new Cost(3);
    }
}

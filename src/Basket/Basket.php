<?php

namespace Basket;

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

    public function productsCost() : Cost
    {
        return $this->total;
    }

    public function VAT() : Cost
    {
        return $this->total->percent(20);
    }

    public function deliveryCost() : Cost
    {
        if ($this->total->isGreaterThan($this->cheapDeliveryThreshold())) {
            return $this->cheapDeliveryCost();
        } else {
            return $this->normalDeliveryCost();
        }
    }

    public function totalCost() : Cost
    {
        if ($this->total->isFree()) {
            return $this->productsCost();
        }

        return $this->productsCost()
            ->add($this->VAT())
            ->add($this->deliveryCost());
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

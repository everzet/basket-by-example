<?php

namespace Basket;

use Money\Money;

class Basket
{
    private $productsCost;

    public function __construct()
    {
        $this->productsCost = new Cost(Money::GBP(0));
    }

    public function withProduct(Product $product) : Basket
    {
        $newBasket = new Basket();
        $newBasket->productsCost = $this->productsCost->plus($product->cost());

        return $newBasket;
    }

    public function productsCost() : Cost
    {
        return $this->productsCost;
    }

    public function VAT() : Cost
    {
        return $this->productsCost->percent(20);
    }

    public function deliveryCost() : Cost
    {
        if ($this->productsCost->isGreaterThan($this->cheapDeliveryThreshold())) {
            return $this->cheapDeliveryCost();
        } else {
            return $this->normalDeliveryCost();
        }
    }

    public function totalCost() : Cost
    {
        if ($this->productsCost->isZero()) {
            return $this->productsCost();
        }

        return $this->productsCost()
            ->plus($this->VAT())
            ->plus($this->deliveryCost());
    }

    private function cheapDeliveryThreshold() : Cost
    {
        return new Cost(Money::GBP(1000));
    }

    private function cheapDeliveryCost() : Cost
    {
        return new Cost(Money::GBP(200));
    }

    private function normalDeliveryCost() : Cost
    {
        return new Cost(Money::GBP(300));
    }
}

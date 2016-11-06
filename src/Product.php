<?php

class Product
{
    private $sku;
    private $cost;

    public static function withSkuAndCost(Sku $sku, Cost $cost) : self
    {
        $product = new Product();

        $product->sku = $sku;
        $product->cost = $cost;

        return $product;
    }

    public function sku() : Sku
    {
        return $this->sku;
    }

    public function cost() : Cost
    {
        return $this->cost;
    }
}

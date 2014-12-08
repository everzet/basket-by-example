<?php

class Product
{
    private $sku;
    private $cost;

    public static function withSkuAndCost(Sku $sku, Cost $cost)
    {
        $product = new Product();
        $product->sku = $sku;
        $product->cost = $cost;

        return $product;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getCost()
    {
        return $this->cost;
    }
}

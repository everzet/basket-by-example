<?php

class InMemoryCatalogue implements Catalogue
{
    private $product;

    public function addProduct(Product $product)
    {
        if (null !== $this->product) {
            throw new \LogicException('In memory catalogue can handle only a single product.');
        }

        $this->product = $product;
    }

    public function getProduct(Sku $sku)
    {
        return $this->product;
    }

    public function getAllProducts()
    {
        return [$this->product];
    }
}

<?php

class CatalogueRecord
{
    private $sku;
    private $cost;

    public function __construct(Sku $sku, Cost $cost)
    {
        $this->sku = $sku;
        $this->cost = $cost;
    }

    public function sku() : Sku
    {
        return $this->sku;
    }

    public function cost() : Cost
    {
        return $this->cost;
    }

    public function __toString()
    {
        return serialize($this);
    }
}

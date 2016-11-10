<?php

namespace Basket;

class Product
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
    public static function fromString(string $string = null)
    {
        $closure = function (string $string) {
            return unserialize($string);
        };

        if ($string) {
            return $closure($string);
        }

        return $closure;
    }
}

<?php

namespace Web;

use Basket\Basket;
use Basket\Product;
use Closure;

class Controller
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function showCatalogue() : string
    {
        $products = $this->db
            ->query('SELECT product FROM catalogue')
            ->map($this->intoProduct());

        return render_template('catalogue', ['products' => $products]);
    }

    public function addToBasket(string $sku) : string
    {
        $aProduct = $this->db
            ->query('SELECT product FROM catalogue WHERE sku = :sku', ['sku' => $sku])
            ->map($this->intoProduct())
            ->current();

        $basket = new Basket();
        $basket->addProduct($aProduct);

        return render_template('basket', ['basket' => $basket]);
    }

    private function intoProduct() : Closure
    {
        return function(string $productString) {
            return Product::fromString($productString);
        };
    }
}

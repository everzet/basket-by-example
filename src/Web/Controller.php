<?php

namespace Web;

use Basket\Basket;
use Basket\Product;

class Controller
{
    private $db;

    public function __construct(Sqlite $db)
    {
        $this->db = $db;
    }

    public function showCatalogue()
    {
        $productStrings = $this->db->query('SELECT product FROM catalogue');
        $products = array_map([Product::class, 'fromString'], $productStrings);

        return render_template('catalogue', ['products' => $products]);
    }

    public function addToBasket(string $sku)
    {
        $productStrings = $this->db->query('SELECT product FROM catalogue WHERE sku = :sku', ['sku' => $sku]);
        $aProduct = Product::fromString($productStrings[0]);

        $basket = new Basket();
        $basket->addProduct($aProduct);

        return render_template('basket', ['basket' => $basket]);
    }
}

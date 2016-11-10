<?php

namespace Web;

use Basket\Basket;
use Basket\Product;

class Controller
{
    private $basket;
    private $database;

    public function __construct(Basket $basket, Database $database)
    {
        $this->basket = $basket;
        $this->database = $database;
    }

    public function showCatalogue() : string
    {
        $products = $this->database
            ->query('SELECT product FROM catalogue')
            ->map(Product::fromString());

        return $this->render('catalogue', ['products' => $products]);
    }

    public function addToBasket(string $sku) : string
    {
        $product = $this->database
            ->query('SELECT product FROM catalogue WHERE sku = :sku', ['sku' => $sku])
            ->map(Product::fromString())
            ->current();

        return $this->render('basket', ['basket' => $this->basket->withProduct($product)]);
    }

    private function render(string $template, array $parameters) : string
    {
        extract($parameters);

        ob_start();
        include(__DIR__ . '/../../templates/' . $template . '.html.php');

        return ob_get_clean();
    }
}

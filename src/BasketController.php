<?php

class BasketController
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

        $html = implode('', array_map(function (Product $product) {
            return "
                <li class='product'>
                    <span>{$product->sku()}</span>
                    <a href='/catalogue/{$product->sku()}/add-to-basket'>Add to basket</a>
                </li>
            ";
        }, $products));

        return "<ul>{$html}</ul>";
    }

    public function addToBasket(string $sku)
    {
        $productStrings = $this->db->query('SELECT product FROM catalogue WHERE sku = :sku', ['sku' => $sku]);
        $aProduct = Product::fromString($productStrings[0]);

        $basket = new Basket();
        $basket->addProduct($aProduct);

        return "<span>Total cost: £{$basket->total()->toFloat()}</span>";
    }
}

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

        return $this->renderTemplate('catalogue', ['products' => $products]);
    }

    public function addToBasket(string $sku)
    {
        $productStrings = $this->db->query('SELECT product FROM catalogue WHERE sku = :sku', ['sku' => $sku]);
        $aProduct = Product::fromString($productStrings[0]);

        $basket = new Basket();
        $basket->addProduct($aProduct);

        return $this->renderTemplate('basket', ['basket' => $basket]);
    }

    private function renderTemplate(string $template, array $parameters) : string
    {
        ob_start();

        extract($parameters);
        include(__DIR__ . '/../templates/' . $template . '.html.php');

        return ob_get_clean();
    }
}

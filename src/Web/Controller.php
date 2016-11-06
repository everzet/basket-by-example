<?php

namespace Web;

use Basket\Basket;
use Basket\Catalogue;
use Basket\Sku;

class Controller
{
    private $catalogue;

    public function __construct(Catalogue $catalogue)
    {
        $this->catalogue = $catalogue;
    }

    public function showCatalogue() : string
    {
        return $this->render('catalogue', ['products' => $this->catalogue->getAllProducts()]);
    }

    public function addToBasket(string $sku) : string
    {
        $aProduct = $this->catalogue->getProductBySku(new Sku($sku));

        $basket = new Basket();
        $basket->addProduct($aProduct);

        return $this->render('basket', ['basket' => $basket]);
    }

    private function render(string $template, array $parameters) : string
    {
        extract($parameters);

        ob_start();
        include(__DIR__ . '/../../templates/' . $template . '.html.php');

        return ob_get_clean();
    }
}

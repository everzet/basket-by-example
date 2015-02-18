<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$catalogue = new Database();

$app->get(
    '/catalogue',
    function () use ($catalogue) {
        $products = array_map(
            function ($data) {
                return unserialize($data['product']);
            }, iterator_to_array($catalogue->query('SELECT product FROM catalogue'))
        );

        $page = "<ul>";
        foreach ($products as $product) {
            $page .= <<<HTML
<li class='product'>
    {$product->getSku()}
    <a href='/catalogue/{$product->getSku()}/add-to-basket'>
        Add to basket
    </a>
</li>
HTML;
        }
        $page .= "</ul>";

        return $page;
    }
);

$app->get(
    '/catalogue/{sku}/add-to-basket',
    function ($sku) use ($catalogue) {
        $sku = new Sku($sku);

        $productData = $catalogue->query('SELECT product FROM catalogue WHERE sku = :sku', ['sku' => (string)$sku]);
        $product = unserialize($productData->fetch()['product']);

        $basket = new Basket();
        $basket->addProduct($product);

        return "Total price of basket: £{$basket->getTotalPrice()->toFloat()}";
    }
);

$app->run();

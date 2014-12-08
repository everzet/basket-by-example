<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$cat = new InMemoryCatalogue();

$app->get(
    '/catalogue',
    function () use ($cat) {
        $page = "<ul>";
        foreach ($cat->getAllProducts() as $product) {
            $page .= "<li class='product'>{$product->getSku()}<a
            href='/catalogue/{$product->getSku()}/add-to-basket'>Add to basket</a></li>";
        }
        $page .= "</ul>";

        return $page;
    }
);

$app->get(
    '/catalogue/{sku}/add-to-basket',
    function ($sku) use ($cat) {
        $basket = new Basket();
        $basket->addProductFromCatalogue(new Sku($sku), $cat);

        return "Total price of basket: £{$basket->getTotalPrice()->toFloat()}";
    }
);

$app->run();

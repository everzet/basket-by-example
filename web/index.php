<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$db = new Sqlite();

$app->get(
    '/catalogue',
    function () use ($db) {
        $products = array_map(
            function ($data) {
                return unserialize($data['product']);
            }, iterator_to_array($db->query('SELECT product FROM catalogue'))
        );

        $page = "<ul>";
        foreach ($products as $product) {
            $page .= <<<HTML
<li class='product'>
    {$product->sku()}
    <a href='/catalogue/{$product->sku()}/add-to-basket'>
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
    function ($sku) use ($db) {
        $sku = new Sku($sku);

        $productData = $db->query('SELECT product FROM catalogue WHERE sku = :sku', ['sku' => (string)$sku]);
        $product = unserialize($productData->fetch()['product']);

        $basket = new Basket();
        $basket->addProduct($product);

        return "Total cost: £{$basket->total()->toFloat()}";
    }
);

$app->run();

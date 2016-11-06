<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$controller = new BasketController(new Sqlite());

$app->get('/catalogue', [$controller, 'showCatalogue']);
$app->get('/catalogue/{sku}/add-to-basket', [$controller, 'addToBasket']);

$app->run();

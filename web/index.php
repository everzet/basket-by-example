<?php

use Basket\Basket;
use Web\Controller;
use Web\Database;
use Web\DatabaseCatalogue;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

if (!defined('ROOT_CONTROLLER')) {
    define('ROOT_CONTROLLER', '');
}
if (!defined('DATABASE')) {
    define('DATABASE', __DIR__ . "/../db_prod.sqlite");
}

$basket = new Basket();
$catalogue = class_exists(DatabaseCatalogue::class) ? new DatabaseCatalogue($database) : null;
$database = new Database(DATABASE);

$reflection = new ReflectionClass(Controller::class);
if (DatabaseCatalogue::class == $reflection->getConstructor()->getParameters()[1]->getClass()->getName()) {
    $controller = $reflection->newInstance($basket, $catalogue);
} else {
    $controller = $reflection->newInstance($basket, $database, $catalogue);
}

$app->get('/', function () use ($app) {
    return $app->redirect(ROOT_CONTROLLER . "/catalogue");
});
$app->get('/catalogue', [$controller, 'showCatalogue']);
$app->get('/catalogue/{sku}/add-to-basket', [$controller, 'addToBasket']);

$app->run();

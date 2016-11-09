<?php

use Web\Controller;
use Web\Database;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

if (!defined('ROOT_CONTROLLER')) {
    define('ROOT_CONTROLLER', '');
}
if (!defined('DATABASE')) {
    define('DATABASE', __DIR__ . "/../db_prod.sqlite");
}

$controller = new Controller(new Database(DATABASE));

$app->get('/', function () use ($app) {
    return $app->redirect(ROOT_CONTROLLER . "/catalogue");
});
$app->get('/catalogue', [$controller, 'showCatalogue']);
$app->get('/catalogue/{sku}/add-to-basket', [$controller, 'addToBasket']);

$app->run();

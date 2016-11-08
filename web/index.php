<?php

use Web\Controller;
use Web\Sqlite;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app['env'] = 'test';

function render_template(string $template, array $parameters) : string
{
    ob_start();

    extract($parameters);
    include(__DIR__ . '/../templates/' . $template . '.html.php');

    return ob_get_clean();
}

$controller = new Controller(new Sqlite(__DIR__ . "/../db_{$app['env']}.sqlite"));

$app->get('/', function () use ($app) {
    return $app->redirect('/catalogue');
});
$app->get('/catalogue', [$controller, 'showCatalogue']);
$app->get('/catalogue/{sku}/add-to-basket', [$controller, 'addToBasket']);

$app->run();

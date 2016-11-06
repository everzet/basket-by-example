<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Basket</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" crossorigin="anonymous">
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/catalogue">Catalogue</a></li>
                <li class="breadcrumb-item active">Basket</li>
            </ol>

            <div class="jumbotron">
                <h1 class="display-3">Basket</h1>
                <hr class="my-2">
                <p class="lead">Products raw cost: <strong>£<?= $basket->productsCost() ?></strong></p>
                <p class="lead">VAT: <strong>£<?= $basket->VAT() ?></strong></p>
                <p class="lead">Delivery cost: <strong>£<?= $basket->deliveryCost() ?></strong></p>
                <p class="lead">Total cost: <strong>£<?= $basket->totalCost() ?></strong></p>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
</body>

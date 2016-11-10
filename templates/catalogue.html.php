<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catalogue</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" crossorigin="anonymous">
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Catalogue</li>
            </ol>

            <h1>Catalogue</h1>

            <div class="list-group">
                <?php foreach ($products as $product): ?>
                    <a class="list-group-item list-group-item-action product" href="<?= ROOT_CONTROLLER ?>/catalogue/<?= $product->sku() ?>/add-to-basket">
                        <span class="tag tag-default tag-pill float-xs-right"><?= $product->cost() ?></span>
                        Add <strong><?= $product->sku() ?></strong> to basket
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
</body>

<?php

namespace Basket;

use Doctrine\Common\Collections\Collection;

interface Catalogue
{
    public function addProduct(Product $product);
    public function getAllProducts() : Collection;
    public function getProductBySku(Sku $sku) : Product;
    public function deleteProducts();
}

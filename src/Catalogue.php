<?php

interface Catalogue
{
    public function getProduct(Sku $sku);
    public function getAllProducts();
}

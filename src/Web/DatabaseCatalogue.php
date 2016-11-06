<?php

namespace Web;

use Basket\Catalogue;
use Basket\Product;
use Basket\Sku;
use Closure;
use Doctrine\Common\Collections\Collection;

class DatabaseCatalogue implements Catalogue
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function addProduct(Product $product)
    {
        $this->db->update('INSERT INTO catalogue(sku, product) VALUES(:sku, :product)', [
            'sku'     => $product->sku(),
            'product' => $product
        ]);
    }

    public function getAllProducts() : Collection
    {
        return $this->db
            ->query('SELECT product FROM catalogue')
            ->map($this->intoProduct());
    }

    public function getProductBySku(Sku $sku) : Product
    {
        return $this->db
            ->query('SELECT product FROM catalogue WHERE sku = :sku', ['sku' => $sku])
            ->map($this->intoProduct())
            ->current();
    }

    public function deleteProducts()
    {
        $this->db->update('DELETE FROM catalogue');
    }

    private function intoProduct() : Closure
    {
        return function(string $productString) {
            return Product::fromString($productString);
        };
    }
}

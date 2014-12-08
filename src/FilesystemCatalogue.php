<?php

class FilesystemCatalogue implements Catalogue
{
    private $filename;
    private $products = [];

    public function __construct()
    {
        $this->filename = sys_get_temp_dir() . '/products.ser';
        if (file_exists($this->filename)) {
            $this->products = unserialize(file_get_contents($this->filename));
        }
    }

    public function addProduct(Product $product)
    {
        $this->products[(string) $product->getSku()] = $product;
        file_put_contents($this->filename, serialize($this->products));
    }

    public function getProduct(Sku $sku)
    {
        return $this->products[(string) $sku];
    }

    public function getAllProducts()
    {
        return $this->products;
    }
}

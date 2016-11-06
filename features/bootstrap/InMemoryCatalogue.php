<?php

use Basket\Catalogue;
use Basket\Product;
use Basket\Sku;
use Everzet\PersistedObjects\InMemoryRepository;
use Everzet\PersistedObjects\ObjectIdentifier;

class InMemoryCatalogue implements Catalogue, ObjectIdentifier
{
    private $storage;

    public function __construct()
    {
        $this->storage = new InMemoryRepository($this);
    }

    public function addProduct(Product $product)
    {
        $this->storage->save($product);
    }

    public function getAllProducts() : array
    {
        return $this->storage->getAll();
    }

    public function getProductBySku(Sku $sku) : Product
    {
        return $this->storage->findById($sku);
    }

    public function deleteProducts()
    {
        $this->storage->clear();
    }

    public function getIdentity($object)
    {
        return $object->sku();
    }
}

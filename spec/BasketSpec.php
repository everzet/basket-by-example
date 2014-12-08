<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasketSpec extends ObjectBehavior
{
    function it_has_a_zero_price_by_default()
    {
        $this->getTotalPrice()->shouldBeLike(new \Cost(0.0));
    }

    function it_calculates_the_price_based_on_the_cheap_products_cost(\Catalogue $catalogue)
    {
        $aSku = new \Sku('PSR1');
        $aCost = new \Cost(5.0);
        $catalogue->getProduct($aSku)->willReturn(\Product::withSkuAndCost($aSku, $aCost));

        $this->addProductFromCatalogue($aSku, $catalogue);

        $this->getTotalPrice()->shouldBeLike(new \Cost(9.0));
    }

    function it_calculates_the_price_based_on_the_expensive_products_cost(\Catalogue $catalogue)
    {
        $aSku = new \Sku('PSR2');
        $aCost = new \Cost(15.0);
        $catalogue->getProduct($aSku)->willReturn(\Product::withSkuAndCost($aSku, $aCost));

        $this->addProductFromCatalogue($aSku, $catalogue);

        $this->getTotalPrice()->shouldBeLike(new \Cost(20.0));
    }
}

<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasketSpec extends ObjectBehavior
{
    function it_can_add_products_from_the_catalogue(\Catalogue $catalogue)
    {
        $this->addProductFromCatalogue(new \Sku('PR1'), $catalogue);
    }
}

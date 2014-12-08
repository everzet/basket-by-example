<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SkuSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sku');
    }
}

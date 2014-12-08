<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CostSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(2.3);
    }

    function it_can_be_converted_to_float()
    {
        $this->toFloat()->shouldReturn(2.3);
    }
}

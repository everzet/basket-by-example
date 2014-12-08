<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CostSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(2.0);
    }

    function it_can_be_converted_to_float()
    {
        $this->toFloat()->shouldReturn(2.0);
    }

    function it_can_be_summed_with_another_cost()
    {
        $this->add(new \Cost(3.2))->shouldBeLike(new \Cost(5.2));
    }

    function it_can_be_summed_with_specified_percentage()
    {
        $this->addPercent(20)->shouldBeLike(new \Cost(2.4));
    }
}

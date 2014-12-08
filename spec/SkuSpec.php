<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SkuSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('PSR1');
    }

    function it_can_be_converted_to_string()
    {
        $this->__toString()->shouldBeLike('PSR1');
    }
}

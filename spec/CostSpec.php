<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CostSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Cost');
    }
}

<?php

namespace Basket;

class Cost
{
    private $float;

    public function __construct(float $float = 0.0)
    {
        $this->float = $float;
    }

    public function add(Cost $anotherCost) : self
    {
        return new Cost($this->float + $anotherCost->float);
    }

    public function percent(int $percent) : self
    {
        return new Cost(($this->float / 100) * $percent);
    }

    public function isFree() : bool
    {
        return 0 == $this->float;
    }

    public function isGreaterThan(Cost $threshold) : bool
    {
        return $this->float > $threshold->float;
    }

    public function __toString()
    {
        return (string)$this->float;
    }
}

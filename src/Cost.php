<?php

class Cost
{
    private $float;

    public function __construct($string)
    {
        $this->float = floatval($string);
    }

    public function toFloat()
    {
        return $this->float;
    }

    public function add(Cost $anotherCost)
    {
        return new Cost($this->float + $anotherCost->float);
    }
}

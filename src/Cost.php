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
}

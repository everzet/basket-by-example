<?php

namespace Basket;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

class Cost
{
    private $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function plus(Cost $anotherCost) : Cost
    {
        return new Cost($this->money->add($anotherCost->money));
    }

    public function percent(int $percent) : Cost
    {
        return new Cost($this->money->allocate([$percent, 100 - $percent])[0]);
    }

    public function isZero() : bool
    {
        return $this->money->isZero();
    }

    public function isGreaterThan(Cost $anotherCost) : bool
    {
        return $this->money->greaterThan($anotherCost->money);
    }

    public function __toString()
    {
        $currencies = new ISOCurrencies();
        $numberFormatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($this->money);
    }
}

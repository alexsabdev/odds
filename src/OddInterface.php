<?php

namespace Alexsabdev\Odds;

/**
 * Interface OddInterface
 * @package Alexsabdev\Odds
 */
interface OddInterface
{
    /**
     * @return mixed
     */
    public function value();

    /**
     * @return DecimalOdd
     */
    public function toDecimal() : DecimalOdd;

    /**
     * @return FractionalOdd
     */
    public function toFractional() : FractionalOdd;

    /**
     * @return MoneylineOdd
     */
    public function toMoneyline() : MoneylineOdd;
}

<?php

namespace Alexsabdev\Odds;

/**
 * Class MoneylineOdd
 * @package Alexsabdev\Odds
 */
final class MoneylineOdd extends Odd
{
    private const PLUS_SIGN = '+';

    /**
     * @var float
     */
    private $value;

    /**
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value() : string
    {
        $sign = '';

        if ($this->value > 0) {
            $sign = self::PLUS_SIGN;
        }

        return $sign . $this->value;
    }

    /**
     * @return DecimalOdd
     * @throws \InvalidArgumentException
     */
    public function toDecimal(): DecimalOdd
    {
        $value = 1;

        if ($this->value > 0) {
            $value = $this->value / 100 + 1;
        } elseif ($this->value < 0) {
            $value = -100 / $this->value + 1;
        }

        $value = round($value, self::DECIMAL_PRECISION);

        return new DecimalOdd($value);
    }

    /**
     * @param float $tolerance
     * @return FractionalOdd
     * @throws \InvalidArgumentException
     */
    public function toFractional(float $tolerance = 1.e-6): FractionalOdd
    {
        if ($this->value === 0.0) {
            return new FractionalOdd(0, 1);
        }

        if ($this->value > 0) {
            $v = $this->value / 100;
        } elseif ($this->value < 0) {
            $v = -100 / $this->value;
        }

        $n = 1;
        $n2 = 0;
        $d = 0;
        $d2 = 1;
        $b = 1 / $v;

        do {
            $b = 1 / $b;
            $a = \floor($b);
            $aux = $n;
            $n = $a * $n + $n2;
            $n2 = $aux;
            $aux = $d;
            $d = $a * $d + $d2;
            $d2 = $aux;
            $b -= $a;
        } while (\abs($v - $n / $d) > $v * $tolerance);

        return new FractionalOdd($n, $d);
    }

    /**
     * @return MoneylineOdd
     */
    public function toMoneyline(): MoneylineOdd
    {
        return $this;
    }
}

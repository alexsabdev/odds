<?php

namespace Alexsabdev\Odds;

/**
 * Class DecimalOdd
 * @package Alexsabdev\Odds
 */
final class DecimalOdd extends Odd
{
    private const MIN_VALUE = 1.0;

    /**
     * @var float
     */
    private $value;

    /**
     * @param float $value
     * @throws \InvalidArgumentException
     */
    public function __construct(float $value)
    {
        if ($value < self::MIN_VALUE) {
            throw new \InvalidArgumentException('Invalid value provided');
        }

        $value = round($value, self::DECIMAL_PRECISION);

        $this->value = $value;
    }

    /**
     * @return float
     */
    public function value() : float
    {
        return $this->value;
    }

    /**
     * @return DecimalOdd
     */
    public function toDecimal(): DecimalOdd
    {
        return $this;
    }

    /**
     * @param float $tolerance
     * @return FractionalOdd
     * @throws \InvalidArgumentException
     */
    public function toFractional(float $tolerance = 1.e-6): FractionalOdd
    {
        if ($this->value === 1.0) {
            return new FractionalOdd(0, 1);
        }

        $v = $this->value - 1;
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
        if ($this->value === 1.0) {
            $value = 0;
        } elseif ($this->value >= 2) {
            $value = 100 * ($this->value - 1);
        } else {
            $value = -100 / ($this->value - 1);
        }

        $value = round($value, self::DECIMAL_PRECISION);

        return new MoneylineOdd($value);
    }
}

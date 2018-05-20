<?php

namespace Alexsabdev\Odds\Tests;

use Alexsabdev\Odds\MoneylineOdd;
use PHPUnit\Framework\TestCase;

/**
 * Class MoneylineOddTest
 * @package Alexsabdev\Odds\Tests
 */
class MoneylineOddTest extends TestCase
{
    public function testValue() : void
    {
        $odd = new MoneylineOdd(-150.5);
        $this->assertEquals('-150.5', $odd->value());

        $odd = new MoneylineOdd(150.5);
        $this->assertEquals('+150.5', $odd->value());
    }

    public function testToDecimal() : void
    {
        $oddMoneyline = new MoneylineOdd(0.0);
        $oddDecimal = $oddMoneyline->toDecimal();
        $this->assertEquals(1.0, $oddDecimal->value());

        $oddMoneyline = new MoneylineOdd(100.0);
        $oddDecimal = $oddMoneyline->toDecimal();
        $this->assertEquals(2.0, $oddDecimal->value());

        $oddMoneyline = new MoneylineOdd(250.0);
        $oddDecimal = $oddMoneyline->toDecimal();
        $this->assertEquals(3.5, $oddDecimal->value());

        $oddMoneyline = new MoneylineOdd(-200.0);
        $oddDecimal = $oddMoneyline->toDecimal();
        $this->assertEquals(1.5, $oddDecimal->value());
    }

    public function testToFractional() : void
    {
        $oddMoneyline = new MoneylineOdd(0.0);
        $oddFractional = $oddMoneyline->toFractional();
        $this->assertEquals('0/1', $oddFractional->value());

        $oddMoneyline = new MoneylineOdd(-200.0);
        $oddFractional = $oddMoneyline->toFractional();
        $this->assertEquals('1/2', $oddFractional->value());

        $oddMoneyline = new MoneylineOdd(200.0);
        $oddFractional = $oddMoneyline->toFractional();
        $this->assertEquals('2/1', $oddFractional->value());
    }

    public function testToMoneyline() : void
    {
        $odd = new MoneylineOdd(200);
        $odd2 = $odd->toMoneyline();
        $this->assertEquals('+200', $odd2->value());
    }
}

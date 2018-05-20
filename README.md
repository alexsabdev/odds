# odds [![Build Status](https://travis-ci.org/alexsabdev/odds.svg?branch=master)](https://travis-ci.org/alexsabdev/odds)
PHP package for dealing with different formats of betting odds: decimal (European), fractional (British), and moneyline (American)

## Features
* Use classes of Decimal/fractional/moneyline odds
* Convert values of odds (all directions)

## Requirements
* PHP 7.1+
* Composer

## Usage

* Create an instance of any odd
```php
require 'vendor/autoload.php';

use Alexsabdev\Odds\DecimalOdd;
...

$odd = new DecimalOdd(3.5);
```

* Show the value
```php
/**
* Prints '3.5'
*/
$decimal = $odd->value();
print_r($decimal);
```

* Convert to other odds
```php
/**
* Prints '5/2'
*/
$fractional = $odd->toFractional()->value();
print_r($fractional);

/**
* Prints '+250'
*/
$moneyline = $odd->toMoneyline()->value();
print_r($moneyline);
```

## License

This is an open-sourced software licensed under the [MIT license](https://github.com/alexsabdev/convrtr/blob/master/LICENSE).

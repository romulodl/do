# Donchian Oscillator

Calculate the DO of giving values.

![Do](https://github.com/romulodl/do/workflows/Do/badge.svg)

## Instalation

```
composer require romulodl/do
```

or add `romulodl/do` to your `composer.json`. Please check the latest version in releases.

## Usage

```php
$do = new Romulodl\DonchianOscillator();
$do->calculate(array $hlc_values, int $period = 30, int $signal_period = 9) : array;
// return array [Donchian Oscillator value, Signal Line Value]
```

For example:
```php
$do = new Romulodl\DonchianOscillator();
$do->calculate(
  [
    [9950.00,9250.66,9786.80],
    [9843.50,9100.00,9310.73],
    [9585.00,9210.03,9374.99],
    [9880.00,9317.16,9678.57],
    [9958.67,9450.00,9731.10],
    [9900.00,9462.00,9773.64],
    [9838.00,9281.42,9508.11],
    [9573.00,8812.20,9060.00],
    [9259.38,8920.00,9166.40],
    [9300.00,9076.90,9176.41],
    [9294.44,8674.00,8711.37],
    [8977.00,8623.38,8895.65],
    [9011.82,8693.18,8837.05],
    [9230.00,8811.00,9197.32],
  ],
  14,
  9
);
```
Although I recommend using more values to have a better signal line result.


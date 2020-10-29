<?php

namespace Romulodl;

class DonchianOscillator
{

  private $ema;

	public function __construct($ema = null) {
		$this->ema = $ema ?: new Ema();
	}

	/**
	 * Calculate the Do based on this formula from RafaelZioni tradingview indicator
	 * https://www.tradingview.com/script/2e841T9U-Donchian-Oscillator/
	 */
  public function calculate(
    array $hlc_values,
    int $period = 30,
    int $signal_period = 9
  ) : array
	{
		if (empty($hlc_values) || count($hlc_values) < $period) {
			throw new \Exception('[' . __METHOD__ . '] $values parameters is invalid');
		}

    $averages = [];
    $acc_values = [];
		foreach ($hlc_values as $key => $value) {
			if (!$this->isValidHLCValue($value)) {
				throw new \Exception('[' . __METHOD__ . '] invalid HLC value');
			}

      $acc_values[] = $value;
      if ($key + 1 < $period) {
        continue;
      }

      $avg_period = array_slice($acc_values, -1 * $period);
      $highs = $this->getHighs($avg_period);
      $lows  = $this->getLows($avg_period);
      $averages[] = $value[2] - (min($lows) + max($highs)) / 2;
		}

    return [
      array_slice($averages, -1)[0],
      $this->ema->calculate($averages, 9)
    ];
	}

  private function getHighs(array $hlc_values) : array {
    return $this->filterValues($hlc_values, 0);
  }

  private function getLows(array $hlc_values) : array {
    return $this->filterValues($hlc_values, 1);
  }

  private function filterValues(array $hlc_values, int $position) : array {
    $val = [];
    foreach($hlc_values as $value) {
      $val[] = $value[$position];
    }

    return $val;
  }

	private function isValidHLCValue($values) : bool
	{
		return is_array($values) &&
			count($values) === 3 &&
			is_numeric($values[0]) &&
			is_numeric($values[1]) &&
			is_numeric($values[2]);
	}
}

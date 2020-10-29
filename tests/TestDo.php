<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Romulodl\DonchianOscillator;

final class DoTest extends TestCase
{
	public function testCalculateWithMorePreviousValues(): void
	{
		$values = require(__DIR__ . '/values.php');

		$obj = new DonchianOscillator();
    $return = $obj->calculate($values);
		$this->assertSame(326.08, round($return[0], 2));
		$this->assertSame(422.31, round($return[1], 2));
	}

	public function testCalculateWithEmptyArray(): void
	{
		$this->expectException(Exception::class);

		$obj = new DonchianOscillator();
		$obj->calculate([]);
	}

	public function testCalculateWithInvalidArray(): void
	{
		$values = [
			9148.27,
			9995,
			9807.49,
			'hahah',
			8719.53,
			8561.09,
			8808.71,
			9305.91,
			9786.80,
		];

		$this->expectException(Exception::class);

		$obj = new DonchianOscillator();
		$obj->calculate($values);
	}
}

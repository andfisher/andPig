<?php

namespace Player;

use \Player;
use \DieInterface;

class Factory
{
	public static function build(int $count, DieInterface $die): array
	{
		$players = [];
		for ($i = 0; $i < $count; $i++) {
			$players[] = new Player(($i + 1), $die);
		}
		return $players;
	}
}
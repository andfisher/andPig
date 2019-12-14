<?php

class Die6 implements DieInterface
{
	protected $min = 1;
	protected $max = 6;

	private $rolls;

	public function __construct(int $rolls = 1)
	{
		$this->rolls = $rolls;
	}

	public function roll(): array
	{
		$rolls = [];
		for ($i = 0; $i < $this->rolls; $i++) {
			$rolls[] = rand($this->min, $this->max);
		}
		return $rolls;
	}
}
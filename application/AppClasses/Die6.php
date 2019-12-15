<?php

class Die6 implements DieInterface
{
	protected $min = 1;
	protected $max = 6;

	private $rolls;
    private $lastRolls;

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

        $this->lastRolls = $rolls;

		return $rolls;
	}

    public function lastRolls(): array
    {
        return $this->lastRolls;
    }
}
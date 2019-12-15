<?php

class Player implements \Player\PlayerInterface
{
	private $active;
	private $dice;

	private $roundScores = [];
	private $activeRound;

	public function __construct(int $id, DieInterface $dice, int $activeRound = 0)
	{
		$this->id = $id;
		$this->dice = $dice;
        $this->activeRound = $activeRound;
	}

    public function getId(): int
    {
        return $this->id;
    }

	public function setActive(bool $yes): void
	{
		$this->active = $yes;
	}

    public function getScore(): int
    {
        $score = 0;
        for ($i = 0; $i <= $this->activeRound; $i++) {
            if (isset($this->roundScores[$i])) {
                $score += $this->roundScores[$i];
            }
        }
        return $score;
    }

	public function takeTurn(): void
	{
        # Initialise the scores this round
        if (! isset($this->roundScores[$this->activeRound])) {
            $this->roundScores[$this->activeRound] = 0;
        }

		$results = $this->dice->roll();

		if (count(array_unique($results)) === 1 && end($results) === 1) {
			# All points are lost!
			$this->roundScores = [];
			$this->activeRound = 0;

            throw new Player\TurnEndException();
		}
		else if (in_array(1, $results)) {
			# Player loses all points from this round
			$this->roundScores[$this->activeRound] = 0;

            throw new Player\TurnEndException();
		}
		else {
			# Add the sum of the $results to the current Round
			$this->roundScores[$this->activeRound] += array_sum($results);
		}
	}

    public function getDice()
    {
        return $this->dice;
    }

    public function reset(): void
    {
        $this->roundScores = [];
        $this->activeRound = 0;
    }
}
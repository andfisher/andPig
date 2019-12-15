<?php

interface DieInterface {

	public function roll(): array;

    public function lastRolls(): array;
}
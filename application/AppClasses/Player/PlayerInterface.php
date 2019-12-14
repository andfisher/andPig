<?php

namespace Player;

/**
 * @author Andrew Fisher
 */
interface PlayerInterface
{
    public function setActive(bool $yes): void;

	public function takeTurn(): void;

    public function getScore(): int;

    public function reset(): void;

    public function getId(): int;
}

<?php

namespace Game;

use Player\TurnEndException;

/**
 * @author Andrew Fisher
 */
final class Manager
{
    const GAME_STATE_PENDING = 0;
    const GAME_STATE_PLAYING = 1;
    const GAME_STATE_WON = 2;

    const SCORE_TARGET = 100;

    private $players;
    private $activePlayer;
    private $currentState;

    public function __construct(array $players, int $currentState = self::GAME_STATE_PENDING)
    {
        $this->players = $players;
        $this->activePlayer = 0;

        $this->currentState = $currentState;
    }

    public function addPlayer(PlayerInterface $player): void
    {
        $this->players[] = $player;
    }

    public function getActivePlayer()
    {
        return $this->players[$this->activePlayer];
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @param int $i
     * @return \Player\PlayerInterface
     * @throws Exception
     */
    public function getPlayer(int $i)
    {
        if ($i >= count($this->players)) {
            throw new Exception('Index out of bounds');
        }
        return $this->players[$i];
    }

    public function roll()
    {
        try {
            $this->getActivePlayer()->takeTurn();
        } catch (TurnEndException $pte) {
            $this->pass();
        }
    }

    public function pass()
    {
        $this->getActivePlayer()->setActive(false);
        $this->activePlayer++;
        if ($this->activePlayer >= count($this->players)) {
            $this->activePlayer = 0;
        }
        $this->getActivePlayer()->setActive(true);
    }

    public function roundEnds(): void
    {
        # Persist the state of the game for the next request.
        if ($this->getActivePlayer()->getScore() >= self::SCORE_TARGET) {
            $this->currentState = self::GAME_STATE_WON;
        }
    }

    public function reset(): void
    {
        $this->currentState = self::GAME_STATE_PENDING;
        $this->activePlayer = 0;
        foreach ($this->players AS $player) {
            $player->reset();
        }
    }

}

<?php

namespace Game;

/**
 * @author Andrew Fisher
 */
interface StateInterface
{
    public function persist(Manager $snapshot): void;

    public function load();
}

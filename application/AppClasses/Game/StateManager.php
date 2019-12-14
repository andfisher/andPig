<?php

namespace Game;

require_once BASEPATH. 'libraries/Session/Session.php';

/**
 * @author Andrew Fisher
 */
class StateManager extends \CI_Session implements StateInterface
{
    public function persist(Manager $snapshot): void
    {
        $data = serialize($snapshot);
        $this->set_userdata('game_state', $data);
    }

    public function load()
    {
        $snapshot = $this->userdata('game_state');
        $state = unserialize($snapshot);

        return $state === false ? null : $state;
    }

    public function destroy(): void
    {
        $this->unset_userdata('game_state');
    }
}

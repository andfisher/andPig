<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Andrew Fisher
 */
class Welcome extends CI_Controller
{
    private $manager;
    private $stateManager;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');

        $this->load->config('pig', true);

        # Load the state of the current players on each request
        $this->stateManager = new Game\StateManager();
        $this->manager = $this->stateManager->load();

        if ($this->manager === null) {
            $dice = new Die6($this->config->item('dice', 'pig'));
            $players = Player\Factory::build($this->config->item('players', 'pig'), $dice);

            $this->manager = new Game\Manager($players);
        }

        if ($this->input->method() === 'post') {
            $this->_handlePost();
        }
    }

	public function index()
	{
		$this->load->view('index/index', [
            'players' => $this->manager->getPlayers(),
            'activePlayer' => $this->manager->getActivePlayer(),
        ]);
	}

    private function _handlePost()
    {
        if ($this->input->post('restart')) {
            $this->stateManager->destroy();
        } else {

            if ($this->input->post('roll')) {
                $this->manager->roll();
            } else if ($this->input->post('pass')) {
                $this->manager->pass();
            }

            $this->manager->roundEnds();
            $this->stateManager->persist($this->manager);
        }

        # Codeigniter redirect to GET
        redirect('/', 'refresh');
    }


}

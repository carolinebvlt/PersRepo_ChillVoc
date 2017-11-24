<?php


namespace App\Backend\Modules\Players;


use Fram\BackController;

class PlayersController extends BackController
{
    public function executeIndex() /* 5 derniers inscrits */
    {
        $nombrePlayers = 5;

        $this->page->addVar('title', 'Liste des '.$nombrePlayers.' derniers inscrits');

        $manager = $this->managers->getManagerOf('Players');

        $listePlayers = $manager->getList(0, $nombrePlayers);

        $this->page->addVar('listePlayers', $listePlayers);
    }
}
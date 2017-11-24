<?php
namespace Models;

use Entities\Player;
use Fram\Manager;

class PlayersManager extends Manager
{

    public function add(Player $player)
    {
        $requete = $this->dao->prepare('INSERT INTO players(pseudo, passh, email) VALUES(:pseudo, :passh, :email)');
        $requete->execute([
            'pseudo'=>$player->pseudo(),
            'passh' =>$player->passh(),
            'email' =>$player->email()]);

    }

    public function availablePseudo($pseudo)
    {
        $req = $this->dao->prepare('SELECT id FROM players WHERE pseudo=:pseudo');
        $req->execute(['pseudo'=>$pseudo]);
        $result = $req->fetch();
        $req->closeCursor();
        return !$result;
    }

	public function checkedPass($pseudo, $passh)
	{

		$req = $this->dao->prepare('SELECT id FROM players WHERE pseudo=:pseudo AND passh=:passh');
		$req->execute(['pseudo'=>$pseudo, 'passh'=>$passh]);
		$result = $req->fetch();
		$req->closeCursor();
		if ($result)
		{
			return $result;
		}
	}

	public function count()
	{
		return $this->dao->query('SELECT COUNT(*) FROM players')->fetchColumn();
	}

    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT * FROM players ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->dao->query($sql);

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entities\Player');

        $listePlayers = $requete->fetchAll();

        $requete->closeCursor();

        return $listePlayers;
    }
}
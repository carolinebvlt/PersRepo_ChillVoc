<?php
namespace App\Frontend\Modules\Players;

use Fram\BackController;
use Fram\Request;
use Entities\Player;

class PlayersController extends BackController
{
	public function executeAdd(Request $request)
	{
		$this->page->addVar('title', 'Inscription');
		
		if($request->postExists('pseudo'))
		{
			$player = new Player([
					'pseudo'=>$request->postData('pseudo'),
					'passh' =>$request->postData('pass'), // hach� apr�s les v�rif
					'email' =>$request->postData('email')]);
			
			$manager = $this->managers->getManagerOf('Players');
			
			// v�rifications
			if($player->isNotEmpty())
			{
				if($manager->availablePseudo($request->postData('pseudo')))
				{
					$player->setPassh(sha1($request->postData('pass')));
					$manager->add($player);
					$this->app->user()->setFlash('Le joueur a bien été inscrit !');
					
					// redirection vers la connexion 
					$this->app->response()->redirect("/test/ChillVoc/Web/");
				}
				else 
				{
					$this->app->user()->setFlash('Pseudo déjà pris !');
				}
			}
			else 
			{
				//var_dump($player);
				$this->page->addVar('erreurs', $player->erreurs());
			}
			$this->page->addVar('player', $player);
		}
	}
	
	
}
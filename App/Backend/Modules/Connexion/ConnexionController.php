<?php
namespace App\Backend\Modules\Connexion;

use Fram\BackController;
use Fram\Request;

class ConnexionController extends BackController
{
	public function executeIndex(Request $request)
	{
		$this->page->addVar('title', 'connexion');
		
		if ($request->postExists('login'))
		{
			$login = $request->postData('login');
			$password = $request->postData('password');
			$passh = sha1($password);
			
		// manager
			$manager = $this->managers->getManagerOf('Players');
			$result = $manager->checkedPass($login, $passh);
			
		// v�rification match
			if ($result)
			{
				$this->app->user()->setAuthenticated(true);
				$this->app->user()->setAttribute('id', $result);
				$this->app->user()->setAttribute('pseudo', $login);
				
				//var_dump($this->app->user());
				
				$this->app->response()->redirect('/test/ChillVoc/Web/admin/DerniersInscrits');
			}
			else
			{
				$this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
			}
		}
	}
}
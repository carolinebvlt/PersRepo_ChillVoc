<?php
namespace App\Frontend\Modules\Home;

use Fram\BackController;

class HomeController extends BackController
{
	public function executeHome()
	{
		$this->page->addVar('title', 'Home Sweet Home');
	}
}
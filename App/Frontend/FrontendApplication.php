<?php

namespace App\Frontend;


use Fram\Application;

class FrontendApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Frontend';
    }

    public function run()
    {
        $controller = $this->getController();
        //echo '<pre>';var_dump($controller);echo '</pre>';
        $controller->execute();

        $this->response->setPage($controller->page());
        $this->response->send();
    }
}
<?php

namespace Fram;


abstract class Application
{
    protected $request;
    protected $response;
    protected $name;
    protected $user;
    protected $config;

    public function __construct()
    {
        $this->request = new Request($this);
        $this->response = new Response($this);
        $this->user = new User($this);
        $this->config = new Config($this);

        $this->name = '';
    }

    public function getController()
    {
        $router = new Router;

        //var_dump($this->request->requestURI());

        $xml = new \DOMDocument;
        $xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');
        //var_dump($routes->item(1));
        //<route url="/test/ChillVoc/Web/admin/Modifier-liste/([0-9]+)/" module="VocLists" action="update" vars="id" />

        // On parcourt les routes du fichier XML.
        foreach ($routes as $route)
        {
            $vars = [];

            // On regarde si des variables sont présentes dans l'URL.
            if ($route->hasAttribute('vars'))
            {
                //var_dump($route);
                //var_dump($route->getAttribute('vars'));
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // On ajoute la route au routeur.
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }

        try
        {
            // On récupère la route correspondante à l'URL.
            //var_dump($this->request->requestURI());
            $matchedRoute = $router->getRoute($this->request->requestURI());
            //echo '<pre>'; var_dump($matchedRoute); echo'</pre>';
        }
        catch (\RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE)
            {
                // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
                $this->response->redirect404();
            }
        }

        // On ajoute les variables de l'URL au tableau $_GET.
        $_GET = array_merge($_GET, $matchedRoute->vars());


        // On instancie le contrôleur.
        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        //echo '<pre>'; var_dump($controllerClass); echo'</pre>';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }

    abstract public function run();

    public function request()
    {
        return $this->request;
    }

    public function response()
    {
        return $this->response;
    }

    public function name()
    {
        return $this->name;
    }

    public function config()
    {
        return $this->config;
    }

    public function user()
    {
        return $this->user;
    }
}
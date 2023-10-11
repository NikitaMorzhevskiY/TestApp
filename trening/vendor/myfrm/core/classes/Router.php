<?php


namespace myfrm;


class Router
{

    protected $routes = []; //массив с маршрутами
    protected $uri; //строка запроса 
    protected $method; //метод

    public function __construct()
    {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/'); //получение строки запроса 
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    public function match()
    {
        $matches = false;
        foreach ($this->routes as $route) {
            if (($route['uri'] === $this->uri) && ($route['method'] === strtoupper($this->method))) {
                require CONTROLLERS . "/{$route['controller']}";
                $matches = true;
                break;
            }
        }
        if (!$matches) {
            abort();
        }
    }

    public function add($uri, $controller, $method)
    {   
        $this->routes[] =[
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];

    }

    public function get($uri, $controller)
    {
        $this->add($uri,$controller, 'GET');
    }
    public function post($uri, $controller)
    {
        $this->add($uri,$controller, 'POST');
    }
    public function delete($uri, $controller)
    {
        $this->add($uri,$controller, 'DELETE');
    }
    
}
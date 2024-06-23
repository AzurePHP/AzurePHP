<?php
namespace Core\Http\Routing;

class Router
{
    public $route;
    public $route_list;

    public function __construct($r)
    {
        $this->route_list = $r;
    }

    public function start()
    {
        $this->route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $route_list = $this->route_list;

        if (isset($route_list[$this->route])) {
            $controller = 'App\\Controllers\\' . $route_list[$this->route]['controller'];
            $object = new $controller();
            $action = $route_list[$this->route]['action'];
            $object->$action();
        } else {
            echo 'Несуществующая страница';
        }
    }
}
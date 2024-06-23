<?php
namespace Core\Http\Routing;
use FastRoute\RouteCollector as Collector;

class RouteCollector extends Collector{

    public function add($httpMethod, $route, RouteHandlerDto $handler)
    {
        $this->addRoute($httpMethod, $route, $handler);
    }
}
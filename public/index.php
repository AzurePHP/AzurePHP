<?php
require __DIR__ . '/../vendor/autoload.php';

use Core\Http\Request;
use Core\Http\Response\ResponseEnum;
use Illuminate\Container\Container;
use Core\Foundation\ProviderRegistrationTrait;

class Application extends Container
{
    use ProviderRegistrationTrait;
    //загрузилось ли приложение
    protected $booted = false;
    protected $serviceProviders = [];
    protected $loadedProviders = [];
    protected $bootingCallbacks = [];

    public function __construct()
    {
        static::setInstance($this);
        //$container = \Illuminate\Container\Container::getInstance();
        $this->instance('app', $this);
        $this->bootingCallbacks[] = function () {
            echo 'BOOTING CALLBACK';
        };
        $this->register(new \App\Providers\AppServiceProvider($this));
        //$this->register(new \App\Providers\AppServiceProvider($this));

        $x = 5;
//        $this->registerBaseBindings();
//        $this->registerBaseServiceProviders();
    }



    public function zb()
    {
        //echo 'zb';
    }
    /**
     * @throws Exception
     */
    public function run()
    {
        $request = Request::createFromGlobals();
        $response = $this->dispatch($request);
        $response->send();
    }

    /**
     * @param Request $request
     * @return mixed|string|void
     * @throws Exception
     */
    protected function dispatch(Request $request)
    {

        $container = $this;
        $container->app->zb();
        $base = $request->getBasePath();
        $path = $request->decodedPath();
        $path = mb_substr($path, 0, 1) !== '/' ? '/' . $path : $path;

        //здесь думаю мидлвейр будет
        $dispatcher = require_once __DIR__ . '/../routes/web.php';
        $routeInfo = $dispatcher->dispatch($request->server->get('REQUEST_METHOD'), $path);

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                $response = response('NOT FOUND', 'Страница не найдена', 404, ResponseEnum::fail);
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $response = response('METHOD NOT ALLOWED', 'Метод не поддерживается сервером', 405, ResponseEnum::fail);
                break;
            case FastRoute\Dispatcher::FOUND:
                $response = response($container->call($routeInfo[1][0] . '@' . $routeInfo[1][1]));
                break;
        }
        if (isset($response)) return $response;
    }
}

$x = new Application();
$x->run();
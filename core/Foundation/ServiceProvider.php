<?php
namespace Core\Foundation;

use Core\Application;
use Illuminate\Container\Container;

abstract class ServiceProvider{

    protected array $bootingCallbacks = [];
    protected array $bootedCallbacks = [];

    protected Container $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function register()
    {

    }
    public function callBootedCallbacks()
    {
        $index = 0;

        while ($index < count($this->bootedCallbacks)) {
            $this->app->call($this->bootedCallbacks[$index]);

            $index++;
        }
    }

    public function callBootingCallbacks()
    {
        $index = 0;

        while ($index < count($this->bootingCallbacks)) {
            $this->app->call($this->bootingCallbacks[$index]);

            $index++;
        }
    }
}
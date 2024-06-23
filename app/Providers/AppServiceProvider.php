<?php
namespace App\Providers;

use Core\Foundation\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    public $singletons = [
        \App\Interfaces\UserInterface::class => \App\Actions\UserAction::class,
    ];

    public function register()
    {
        $this->bootingCallbacks[] = function (){
            echo 'register provider 1<br>';
        };
        $this->bootedCallbacks[] = function (){
            echo 'register provider 2<br>';
        };

        echo 'register provider 3<br>';
    }

    public function boot()
    {
        echo 'boot provider <br>';
//        $x = function($item): int {
//            return strlen($item);
//        };
        //return $x('dfgdfgdf');
    }
}
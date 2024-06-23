<?php
namespace App\Controllers;

use App\Data\Dto\Dto;

class Controller{

    public function render($view, $params = array())
    {
        $test = '';
        require $_SERVER['DOCUMENT_ROOT'] . $test . '/app/views/' . $view . '.php';
    }

    public function action(string $action, ?Dto $dto = null): mixed
    {
        //$action = app($action);
        //return $action->exec($dto);
    }
}
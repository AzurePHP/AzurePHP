<?php

namespace App\Controllers;

use App\Actions\User\GetOneAction;
use App\Interfaces\UserInterface;
use App\Repositories\UserRepository;

class ContactsController extends Controller
{

    public $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function testInterface(UserInterface $interfaceOrClass)
    {
        echo $interfaceOrClass->handler();
    }
    /**
     * @throws \Exception
     */
    public function index(GetOneAction $action)
    {
        $x = $this->repository->test();
        response()->json(['x' => $x])->send();
//        try{
//            throw new \Exception('тест');
//        }catch(\Exception $ex){
//            $response = response(['<h1>Test test test </h1>'], 'получилось', 200, ResponseEnum::fail);
//            //$x = $response;
//            $response->send();
//        }

    }
}
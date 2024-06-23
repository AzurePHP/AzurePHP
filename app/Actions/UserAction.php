<?php
namespace App\Actions;

use App\Interfaces\UserInterface;

class UserAction implements UserInterface
{
    public function handler()
    {
        return 'interface';
    }
}
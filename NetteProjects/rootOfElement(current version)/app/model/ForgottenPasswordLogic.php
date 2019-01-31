<?php

namespace App\Model;

use Nette;
use Nette\Utils\Random;


class ForgottenPasswordLogic
{

    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function generateRandomString($size)
    {
        return Random::generate($size);
    }

    public function updateUserPassword($username, $password)
    {
        $this->database->table('users')->where('username', $username)->update([
            'password' => \Nette\Security\Passwords::hash($password),
        ]);
    }

    public function selectUser($username)
    {
        return $this->database->table('users')->where('username', $username)->fetch();
    }

    public function checkUserExistence($username)
    {
        $usernameCount =  $this->database->table('users')->where('username', $username)->count();

        if($usernameCount >= 1)
        {
            return true;
        } else {
            return false;
        }

    }

}
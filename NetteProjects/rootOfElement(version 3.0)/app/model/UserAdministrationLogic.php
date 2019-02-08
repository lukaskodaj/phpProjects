<?php

namespace App\Model;

use Nette;

class UserAdministrationLogic
{

    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function deleteUser($userId)
    {
        $user =  $this->database->table('users')->where('id', $userId)->fetch();

        $this->database->table('userelements')->where('owner', $user->username)->delete();

        $this->database->table('users')->where('id', $userId)->delete();
    }

    public function selectUsers()
    {
        return $this->database->table('users');
    }

    public function insertUser($values)
    {
        $this->database->table('users')->insert([
            'username' => $values->username,
            'password' => \Nette\Security\Passwords::hash($values->pwd),
            'role' => "user",
            'name' => $values->name,
            'surname' => $values->surname,
            'email' => $values->email,
            'city' => $values->city,
            'state' => $values->state,
        ]);
    }

}
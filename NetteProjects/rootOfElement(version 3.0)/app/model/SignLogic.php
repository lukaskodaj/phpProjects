<?php

namespace App\Model;

use Nette;


class SignLogic
{

    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
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

    public function insertElements($username)
    {
        $defaultElements = $this->database->table('elements');

        foreach ($defaultElements as $key => $item)
        {
            $this->database->table('userelements')->insert([
                'elementId' => $item->id,
                'properties' => 'Sem môžte vložiť vlastnosti',
                'note' => 'Sem môžte vložiť poznámku',
                'owner' => $username,
            ]);
        }
    }

}
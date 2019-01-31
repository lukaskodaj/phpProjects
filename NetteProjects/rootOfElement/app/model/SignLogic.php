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
        $defaultElements = $this->database->table('elements')->where('owner', 'default');

        foreach ($defaultElements as $key => $item)
        {
            $this->database->table('elements')->insert([
                'circleRadius' => $item->circleRadius,
                'latinName' => $item->latinName,
                'englishName' => $item->englishName,
                'slovakName' => $item->slovakName,
                'atomicNumber' => $item->atomicNumber,
                'period' => $item->period,
                'chemicalSymbol' => $item->chemicalSymbol,
                'electronConfiguration' => $item->electronConfiguration,
                'relativeAtomicMass' => $item->relativeAtomicMass,
                'classificationName' => $item->classificationName,
                'classificationKeyName' => $item->classificationKeyName,
                'density' => $item->density,
                'meltingPoint' => $item->meltingPoint,
                'boilingPoint' => $item->boilingPoint,
                'criticalTemperature' => $item->criticalTemperature,
                'ignitionTemperature' => $item->ignitionTemperature,
                'criticalPressure' => $item->criticalPressure,
                'atomicRadius' => $item->atomicRadius,
                'properties' => $item->properties,
                'note' => $item->note,
                'owner' => $username,
                'color' => $item->color,
            ]);
        }
    }

}
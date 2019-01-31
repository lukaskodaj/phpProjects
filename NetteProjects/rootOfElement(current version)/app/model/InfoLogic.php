<?php

namespace App\Model;

use Nette;


class InfoLogic
{

    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function insertSupportNote($email, $supportText)
    {
        $this->database->table('supportnotes')->insert([
            'email' => $email,
            'note' => $supportText,
        ]);
    }

    public function getNumberOfLastSupportNote()
    {
        return $this->database->table('supportnotes')->max('id');
    }

}
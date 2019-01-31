<?php

namespace App\Model;

use Nette;


class HomepageLogic
{

    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function selectElementsByOwnerAndClassification($owner, $classificationKeyName)
    {
        return $this->database->table('elements')->where('owner = ? AND classificationKeyName LIKE ?', $owner, '%'.$classificationKeyName.'%');
    }

    public function selectElementById($id)
    {
        return $this->database->table('elements')->where('id', $id)->fetch();
    }

    public function selectMenuItemsByOwner($owner)
    {
        return $this->database->table('menu')->where('owner', $owner);
    }

    public function updateElementProperties($elementId, $elementProperties)
    {
        $this->database->table('elements')->where('id', $elementId)->update([
            'properties' => $elementProperties,
        ]);
    }

    public function updateElementNote($elementId, $elementNote)
    {
        $this->database->table('elements')->where('id', $elementId)->update([
            'note' => $elementNote,
        ]);
    }

}
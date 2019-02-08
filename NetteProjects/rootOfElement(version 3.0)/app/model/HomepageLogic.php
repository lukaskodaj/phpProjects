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
        return $this->database->table('elements')->where('classificationKeyName LIKE ?','%'.$classificationKeyName.'%');
    }

    public function selectElementById($id, $owner)
    {
        $result = array();

        //relacia has one 1:1
        $result['userElement'] = $this->database->table('userelements')->where('elementId LIKE ? AND owner LIKE ?', $id, $owner)->fetch();
        $result['element'] = $result['userElement']->ref('elements', 'elementId');

        return $result;
    }

    public function selectMenuItemsByOwner($owner)
    {
        return $this->database->table('menu')->where('owner', $owner);
    }

    public function updateElementProperties($elementId, $elementProperties, $owner)
    {
        $this->database->table('userelements')->where('elementId LIKE ? AND owner LIKE ?', $elementId, $owner)->update([
            'properties' => $elementProperties,
        ]);
    }

    public function updateElementNote($elementId, $elementNote, $owner)
    {
        $this->database->table('userelements')->where('elementId LIKE ? AND owner LIKE ?', $elementId, $owner)->update([
            'note' => $elementNote,
        ]);
    }

    public function getCurrentUsername($id)
    {
        $user = $this->database->table('users')->where('id', $id)->fetch();
        return $user->username;
    }


}
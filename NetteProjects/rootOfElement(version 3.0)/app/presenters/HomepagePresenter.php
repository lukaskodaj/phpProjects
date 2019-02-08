<?php

namespace App\Presenters;

use App\Model\HomepageLogic;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;


class HomepagePresenter extends BasePresenter
{


    private $perTable;
    private $classificationKeyName;
    private $currentElement;

    private $homepageLogic;

    public function __construct(HomepageLogic $homepageLogic)
    {
        $this->homepageLogic = $homepageLogic;
        $this->perTable = array();
    }

    public function handleChangePeriodicContent($classificationKeyName)
    {
        if (!$this->getUser()->isLoggedIn())
        {
            $this->perTable = $this->homepageLogic->selectElementsByOwnerAndClassification('default', $classificationKeyName);
        } else {
            $this->perTable = $this->homepageLogic->selectElementsByOwnerAndClassification($this->getUser()->getIdentity()->username, $classificationKeyName);
        }

        $this->classificationKeyName = $classificationKeyName;

        if ($this->isAjax()) {
            $this->redrawControl('ajaxChangePerTab');

        }

    }

    public function handleChangeElementContent($elementId)
    {

        $el = $this->homepageLogic->selectElementById($elementId, $this->getCurrentOwner());

        if($this->currentElement != $el )
        {
            $this->currentElement = $el;
        }

        if($this->isAjax())
        {
            $this->redrawControl('ajaxChangeCurrentElementContent');
        }
    }

    public function renderDefault()
	{
        $this->template->menu = $this->homepageLogic->selectMenuItemsByOwner('default');

        if ($this->perTable == null) {
            $this->classificationKeyName = "#all";
            if (!$this->getUser()->isLoggedIn())
            {
                $this->perTable = $this->homepageLogic->selectElementsByOwnerAndClassification('default', $this->classificationKeyName);
            } else {
                $this->perTable = $this->homepageLogic->selectElementsByOwnerAndClassification($this->getUser()->getIdentity()->username, $this->classificationKeyName);
            }

        }

        if($this->currentElement == null)
        {
            $this->currentElement = $this->homepageLogic->selectElementById(4, $this->getCurrentOwner());
        } else {
            $this->currentElement = $this->homepageLogic->selectElementById($this->currentElement['element']->id, $this->getCurrentOwner());
        }

        $this->template->classificationKeyName = $this->classificationKeyName;
        $this->template->perTable = $this->perTable;
        $this->template->currentElement = $this->currentElement;
	}

    public function createComponentEditElementPropertiesForm()
    {
        return new Multiplier(function ($elementId) {

            $form = new Form;

            $form->getElementPrototype()->class('ajax');

            $currentElement = $this->homepageLogic->selectElementById($elementId, $this->getCurrentOwner());


            $form->addHidden('elementId', $elementId);

            $form->addTextArea('propertiesText', "Properties")->setRequired(false)->setDefaultValue($currentElement['userElement']->properties);;

            $form->addSubmit('save', 'Uložiť vlastnosti');

            $form->onSuccess[] = [$this, 'EditElementPropertiesFormSucceeded'];

            return $form;

        });

    }

    public function EditElementPropertiesFormSucceeded($form, $values)
    {
        $this->homepageLogic->updateElementProperties($values->elementId, $values->propertiesText, $this->getCurrentOwner());
    }

    public function createComponentEditElementNoteForm()
    {
        return new Multiplier(function ($elementId) {

            $form = new Form;

            $form->getElementPrototype()->class('ajax');

            $currentElement = $this->homepageLogic->selectElementById($elementId, $this->getCurrentOwner());

            $form->addHidden('elementId', $elementId);

            $form->addTextArea('noteText', "Note")->setRequired(false)->setDefaultValue($currentElement['userElement']->note);;

            $form->addSubmit('save', 'Uložiť poznámku');

            $form->onSuccess[] = [$this, 'EditElementNoteFormSucceeded'];

            return $form;

        });

    }

    public function EditElementNoteFormSucceeded($form, $values)
    {
        $this->homepageLogic->updateElementNote($values->elementId, $values->noteText, $this->getCurrentOwner());
    }

    public function getCurrentOwner()
    {
        $username = "default";

        if($this->getUser()->isLoggedIn())
        {
            $username = $this->homepageLogic->getCurrentUsername($this->getUser()->getIdentity()->id);
        }

        return $username;

    }

}


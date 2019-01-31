<?php

namespace App\Presenters;

use Nette\Application\UI\Form;
use App\Model\UserAdministrationLogic;

class UserAdministrationPresenter extends BasePresenter
{

    private $currentUsers;

    private $userAdministrationLogic;

    public function __construct(UserAdministrationLogic $userAdministrationLogic)
    {
        $this->userAdministrationLogic = $userAdministrationLogic;
    }

    public function handleDeleteUser($userId)
    {

        $this->userAdministrationLogic->deleteUser($userId);

        $this->currentUsers = $this->userAdministrationLogic->selectUsers();

        if($this->isAjax())
        {
            $this->redrawControl('ajaxChangeUsersViewContent');
        }
    }

    public function renderUsersView()
    {
        if($this->currentUsers == null)
        {
            $this->currentUsers = $this->userAdministrationLogic->selectUsers();
        }

        $this->template->currentUsers = $this->currentUsers;
    }

    public function createComponentAddUserForm()
    {

            $form = new Form;

            $form->addText('name', 'Meno')->setRequired('Prosim zadajte svoje meno');

            $form->addText('surname', 'Priezvisko')->setRequired('Prosim zadajte svoje priezvisko');

            $form->addText('username', 'Užívateľské meno')->setRequired('Prosim vyplnte svoje uzivatelske meno');

            $form->addEmail('email', 'Email')->setRequired('Prosím vyplňte svoj email');

            $form->addText('city', 'Mesto')->setRequired('Prosím vyplňte svoje mesto');

            $states = [
                'slovakia' => 'Slovensko',
                'czechRepulic' => 'Česká republika',
                'poland' => 'Poľsko'
            ];

            $form->addSelect('state', 'Štát', $states);

            $passwordInput = $form->addPassword('pwd', 'Heslo')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí obsahovať minimálne 10 znakov', 10)
                ->setRequired('Prosím zadajte heslo');

            $form->addPassword('pwd2', 'Heslo(overenie)')->setRequired('Prosím zadajte heslo pre overenie')
                ->addRule($form::EQUAL, 'Heslá sa nezhodujú', $passwordInput);

            $form->addSubmit('add', 'Add user');

            $form->onSuccess[] = [$this, 'AddUserFormSucceeded'];

            return $form;

    }

    public function AddUserFormSucceeded($form, $values)
    {

        $this->userAdministrationLogic->insertUser($values);

        $this->redirect('UserAdministration:usersView', "registrated");

    }


}
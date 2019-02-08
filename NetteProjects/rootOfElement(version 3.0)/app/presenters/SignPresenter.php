<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\SignLogic;

class SignPresenter extends BasePresenter
{

    private $signLogic;

    public function __construct(SignLogic $signLogic)
    {
        $this->signLogic = $signLogic;
    }

    public function renderIn($state)
    {
        if($state == "registered")
        {
            $this->template->state = "registered";
        } else if($state == "incorrectData")
        {
            $this->template->state = "incorrectData";
        }
        else {
            $this->template->state = "normal";
        }
    }

    public function renderUp()
    {
        $this->template->users = $this->signLogic->selectUsers();
    }


    protected function createComponentSignInForm()
    {
        $form = new Form;

        $form->addText('username', 'Uzivatelske meno:')->setHtmlAttribute('placeholder', 'Užívateľské meno')
            ->setRequired('Prosím vyplňte užívateľské meno');

        $form->addPassword('password', 'Heslo:')->setHtmlAttribute('placeholder', 'Heslo')
            ->setRequired('Prosím vyplňte svoje heslo.');

        $form->addSubmit('send', 'Prihlásiť');

        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = null;
        $renderer->wrappers['pair']['container'] = null;
        $renderer->wrappers['label']['container'] = null;
        $renderer->wrappers['control']['container'] = null;

        $form->onSuccess[] = [$this, 'signInFormSucceeded'];

        return $form;
    }

    public function signInFormSucceeded(Form $form, Nette\Utils\ArrayHash $values)
    {
        try {

            $user = $this->getUser();

            $user->login($values['username'], $values['password']);

            $user->setExpiration('600 minutes');

            $this->redirect('Homepage:');


        } catch (Nette\Security\AuthenticationException $e) {
            $this->redirect('Sign:in', "incorrectData");
        }

    }

    public function createComponentSignUpForm()
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

        $form->addSubmit('send', 'Zaregistrovať');

        $form->onSuccess[] = [$this, 'signUpFormSucceeded'];

        return $form;
    }

    public function signUpFormSucceeded(Form $form, Nette\Utils\ArrayHash $values)
    {

        $this->signLogic->insertUser($values);

        $this->signLogic->insertElements($values->username);

        $this->flashMessage('Dakujeme za Vasu registraciu', 'success');

        $this->redirect('Sign:in', "registrated");

    }

    public function actionCreate()
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in', 'registered');
        }
    }

    public function actionOut()
    {
        $this->getUser()->logout();
        $this->redirect('Homepage:');
    }

}
<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\Mailer;
use App\Model\ForgottenPasswordLogic;


class ForgottenPasswordPresenter extends BasePresenter
{

    public $authenticator;

    private $mailer;
    private $forgottenPasswordLogic;

    public function __construct(Mailer $mailer, ForgottenPasswordLogic $forgottenPasswordLogic)
    {
        $this->mailer = $mailer;
        $this->forgottenPasswordLogic = $forgottenPasswordLogic;
    }


    public function renderNewPassword($usernameValidate)
    {

        $this->template->usernameValidate = 'none';

        if($usernameValidate == 'usernameValidate')
        {
            $this->template->usernameValidate = 'usernameValidate';
        }

        if($usernameValidate == 'usernameNonvalidate'){
            $this->template->usernameValidate = 'usernameNonvalidate';
        }

    }

    protected function createComponentResetPasswordForm()
    {
        $form = new Form;

        $form->addText('username', 'Uzivatelske meno:')->setHtmlAttribute('placeholder', 'Užívateľské meno')
            ->setRequired('Prosím vyplňte užívateľské meno');

        $form->addSubmit('send', 'Odoslať');

        $form->addSubmit('sendAgain', 'Odoslať znovu');

        $form->onSuccess[] = [$this, 'ResetPasswordFormSucceeded'];

        return $form;
    }


    public function ResetPasswordFormSucceeded($form, $values)
    {

        if($this->forgottenPasswordLogic->checkUserExistence($values->username) == true)
        {

            $user = $this->forgottenPasswordLogic->selectUser($values->username);

            $randomString =  $this->forgottenPasswordLogic->generateRandomString(10);

            $this->forgottenPasswordLogic->updateUserPassword($values->username, $randomString);

            $params['newPassword'] = $randomString;
            $params['username'] = $user->username;

            $this->mailer->sendMail($user->email,
                                    'Root of Element <support@rootofelement.com>',
                                    $params,
                                    'Obnova zabudnutého hesla',
                                    __DIR__.'/templates/NewPasswordMail/resetPassword.latte'
            );

            $this->redirect('ForgottenPassword:newPassword', 'usernameValidate');

        } else {

            $this->redirect('ForgottenPassword:newPassword', 'usernameNonvalidate');

        }

    }

}
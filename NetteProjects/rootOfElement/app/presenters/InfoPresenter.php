<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Mail\Message;
use App\Model\InfoLogic;
use App\Model\Mailer;

class InfoPresenter extends BasePresenter
{

    private $mailer;
    private $infoLogic;

    public function __construct(Mailer $mailer, InfoLogic $infoLogic)
    {
        $this->mailer = $mailer;
        $this->infoLogic = $infoLogic;
    }

    public function renderInformations($state)
    {
        if($state == "send")
        {
            $this->template->state = "send";
        } else if($state == "notSend") {
            $this->template->state = "notSend";
        }
    }

    protected function createComponentSupportForm()
    {
        $form = new Form;

        $form->addEmail('email', 'E-mail')
            ->setHtmlAttribute('placeholder', 'E-mail')
            ->setRequired('Prosím zadajte Váš e-mail');

        $form->addTextArea('supportText', 'text')
            ->setHtmlAttribute('placeholder', 'Sem napíšte poznámku')
            ->setRequired('Prosím pole pre poznámku');

        $form->addSubmit('send', 'Odoslať');

        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = null;
        $renderer->wrappers['pair']['container'] = null;
        $renderer->wrappers['label']['container'] = null;
        $renderer->wrappers['control']['container'] = null;

        $form->onSuccess[] = [$this, 'supportFormSucceeded'];

        return $form;
    }

    public function supportFormSucceeded(Form $form, Nette\Utils\ArrayHash $values)
    {

        $this->infoLogic->insertSupportNote($values->email, $values->supportText);

        $params['questionNumber'] = $this->infoLogic->getNumberOfLastSupportNote();
        $params['supportText'] = $values->supportText;

        $this->mailer->sendMail('support@rootofelement.com',
                               'Root of Element <'.$values->email.'>',
                                $params,
                               'Otázka č. '.$params['questionNumber'],
                               __DIR__.'/templates/SupportMail/supportNoteMail.latte', $params);

        $this->redirect('Info:informations', "send");

    }

}
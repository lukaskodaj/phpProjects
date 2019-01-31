<?php

namespace App\Model;

use Nette;
use Nette\Mail\Message;


class Mailer
{

    private $mailer;

    public function __construct()
    {
       $this->mailer = new Nette\Mail\SmtpMailer;
    }

    public function sendMail($mailTo, $mailFrom, $content, $subject, $latteLink)
    {
        $latte = new \Latte\Engine;

        $mail = new Message;
        $mail->setFrom($mailFrom)
            ->addTo($mailTo)
            ->setSubject($subject)
            ->setHtmlBody($latte->renderToString($latteLink, $content));

        $this->mailer->send($mail);
    }

}
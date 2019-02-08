<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\MyAuthenticator;

class RoeManagementPresenter extends BasePresenter
{

    public $authenticator;

    public function __construct(Nette\Database\Context $database)
    {
        parent::__construct($database);
    }

    public function renderManagement()
    {

    }

}
<?php

namespace App\Model;

use Nette;
use Nette\Utils\ArrayList;
use Nette\Http\Session;

class BasketManager
{
    use Nette\SmartObject;
	private $session;
	private $basketSection;

    public function __construct(Nette\Http\Session $session)
    {
		$this->session = $session;
		$this->basketSection = $session->getSection('basketSection');
		$this->basketSection->myBasket = array();
    }
	
	public function addItem($item)
	{	
		$this->basketSection->myBasket[] = $item;	
	}
	
	public function deleteItem($index)
	{
		unset($this->basketSection->myBasket[0]);
	}
	
}
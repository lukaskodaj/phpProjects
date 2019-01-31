<?php

namespace App;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;
		$router[] = new Route('<presenter>/<action>', 'Homepage:default');

        $router = new Route('<presenter>/<action>[/<state>]', [
            'presenter' => [
                Route::VALUE => 'Homepage',
                Route::FILTER_TABLE => [
                    'account' => 'Sign',
                    'ucet' => 'Sign',
                    'domov' => 'Homepage',
                    'informacie' => 'Info',
                    'zabudnute-heslo' => 'ForgottenPassword',
                    'roe-manazment' => 'RoeManagement',
                    'sprava-uzivatelov' => 'UserAdministration',
                ],
            ],
            'action' => [
                Route::VALUE => 'default',
                Route::FILTER_TABLE => [
                    'sign-in' => 'in',
                    'sign-up' => 'up',
                    'prihlasenie' => 'in',
                    'registracia' => 'up',
                    'otazka' => 'informations',
                    'nove-heslo' => 'newPassword',
                    'moznosti' => 'management',
                    'prehlad-pouzivatelov' => 'usersView',
                    null => 'default',
                ],
            ],
            'state' =>  [
                Route::FILTER_TABLE => [
                    'neodoslana' => 'notSend',
                    'odoslana' => 'send',
                    'nespravne-udaje' => 'incorrectData',
                    'registrovany' => 'registrated',
                ],
            ],
        ]);

		return $router;
	}
}

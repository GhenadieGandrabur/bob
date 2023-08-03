<?php
namespace Ijdb;

use Ijdb\Controllers\Currency;
use Ijdb\Repositories\RateRepository;
use Ninja\DatabaseTable;
use Ninja\Authentication;

class IjdbRoutes implements \Ninja\Routes {
	private $authorsTable;
	private $currenciesTable;
	private $ratesTable;
	private $authentication;

	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

		$this->currenciesTable = new DatabaseTable($pdo, 'currencies', 'id');
		$this->authorsTable = new DatabaseTable($pdo, 'author', 'id');
		$this->ratesTable = new RateRepository($pdo, 'rates', 'id');
		$this->authentication = new Authentication($this->authorsTable, 'email', 'password');
	}

	public function getRoutes(): array {
		$currencyController = new Currency($this->currenciesTable, $this->authentication);
		$authorController = new \Ijdb\Controllers\Register($this->authorsTable);
		$rateController = new \Ijdb\Controllers\Rates($this->ratesTable,$this->currenciesTable);
		$loginController = new \Ijdb\Controllers\Login($this->authentication);

		$routes = [
			'author/register' => [
				'GET' => [
					'controller' => $authorController,
					'action' => 'registrationForm'
				],
				'POST' => [
					'controller' => $authorController,
					'action' => 'registerUser'
				]
			],
			'author/success' => [
				'GET' => [
					'controller' => $authorController,
					'action' => 'success'
				]
			],
			'currency/edit' => [
				'POST' => [
					'controller' => $currencyController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $currencyController,
					'action' => 'edit'
				],
				'login' => true
				
			],
			'currency/delete' => [
				'POST' => [
					'controller' => $currencyController,
					'action' => 'delete'
				],
				'login' => true
			],
			'currency/list' => [
				'GET' => [
					'controller' => $currencyController,
					'action' => 'list'
				]
			],
			'rate/edit' => [
				'POST' => [
					'controller' => $rateController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $rateController,
					'action' => 'edit'
				],
				'login' => true
				
			],
			'rate/delete' => [
				'POST' => [
					'controller' => $rateController,
					'action' => 'delete'
				],
				'login' => true
			],
			'rate/list' => [
				'GET' => [
					'controller' => $rateController,
					'action' => 'list'
				]
			],
			
			'login/error' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'error'
				]
			],
			'login/success' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'success'
				]
			],
			'logout' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'logout'
				]
			],
			'login' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'loginForm'
				],
				'POST' => [
					'controller' => $loginController,
					'action' => 'processLogin'
				]
			],
			'' => [
				'GET' => [
					'controller' => $currencyController,
					'action' => 'home'
				]
			]
		];

		return $routes;
	}

	public function getAuthentication(): \Ninja\Authentication {
		return $this->authentication;
	}

}
<?php
namespace Ijdb;

use Ijdb\Controllers\Currency;
use Ijdb\Repositories\RateRepository;
use Ijdb\Repositories\IncomesRepository;
use Ninja\DatabaseTable;
use Ninja\Authentication;

class IjdbRoutes implements \Ninja\Routes {
	private $authorsTable;
	private $currenciesTable;
	private $ratesTable;
	private $incomesTable;
	private $authentication;

	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

		$this->currenciesTable = new DatabaseTable($pdo, 'currencies', 'id');
		$this->ratesTable = new RateRepository($pdo, 'rates', 'id');
		$this->incomesTable = new IncomesRepository($pdo, 'income', 'id');		
		$this->authorsTable = new DatabaseTable($pdo, 'author', 'id');
		$this->authentication = new Authentication($this->authorsTable, 'email', 'password');
		
	}

	public function getRoutes(): array {
		$currencyController = new Currency($this->currenciesTable, $this->authentication);
		$incomeController = new Controllers\Incomes($this->incomesTable, $this->currenciesTable);
		$authorController = new Controllers\Register($this->authorsTable);
		$rateController = new Controllers\Rates($this->ratesTable,$this->currenciesTable);
		$loginController = new Controllers\Login($this->authentication);
		$routes = [
			'author/register' => [
				'GET' => [
					'controller' => $authorController,
					'action' => 'registrationForm'
				],
				'POST' => [
					'controller' => $authorController,
					'action' => 'registerUser'
				],'login' => true
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
				],'login' => true				
			],
			'currency/delete' => [
				'POST' => [
					'controller' => $currencyController,
					'action' => 'delete'
				],'login' => true
			],
			'currency/list' => [
				'GET' => [
					'controller' => $currencyController,
					'action' => 'list'
				],'login' => true
			],
			'rate/edit' => [
				'POST' => [
					'controller' => $rateController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $rateController,
					'action' => 'edit'
				], 'login' => true
				
			],
			'rate/delete' => [
				'POST' => [
					'controller' => $rateController,
					'action' => 'delete'
				],	'login' => true
			],
			'rate/list' => [
				'GET' => [
					'controller' => $rateController,
					'action' => 'list'
				],'login' => true
			],
			'rate/last' => [
				'GET' => [
					'controller' => $rateController,
					'action' => 'lastRates'
				]
			],
			'income/edit' => [
				'POST' => [
					'controller' => $incomeController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $incomeController,
					'action' => 'edit'
				], 'login' => true
				
			],
			'income/delete' => [
				'POST' => [
					'controller' => $incomeController,
					'action' => 'delete'
				],	'login' => true
			],	
			'income/list' => [
				'GET' => [
					'controller' => $incomeController,
					'action' => 'list'
				],'login' => true
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
				],'login' => true
			]
		];

		return $routes;
	}

	public function getAuthentication(): \Ninja\Authentication {
		return $this->authentication;
	}

}
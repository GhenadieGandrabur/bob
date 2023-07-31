<?php
namespace Ijdb;

class IjdbRoutes implements \Ninja\Routes {
	private $authorsTable;
	private $currencisesTable;
	private $authentication;

	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

		$this->currencisesTable = new \Ninja\DatabaseTable($pdo, 'currencises', 'id');
		$this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
		$this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
	}

	public function getRoutes(): array {
		$currencyController = new \Ijdb\Controllers\Currency($this->currencisesTable, $this->authentication);
		$authorController = new \Ijdb\Controllers\Register($this->authorsTable);
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
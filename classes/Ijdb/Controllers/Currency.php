<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Currency {	
	private $currencisesTable;
	private $authentication;

	public function __construct(DatabaseTable $currencyTable, Authentication $authentication) {
		$this->currencisesTable = $currencyTable;		
		$this->authentication = $authentication;
	}

	public function list() {
	
		return ['template' => 'currencises.html.php', 
				'title' => "Currency list", 
				'variables' => [
						'totalcurrencises' => $this->currencisesTable->total(),
						'currencises' => $this->currencisesTable->findAll()						
					]
				];
	}
	public function home()
	{
		if (!$this->authentication->isLoggedIn()) {
			header('Location: /login');
			exit;
		}
	
		// Dacă e logat → redă pagina principală (incomes list sau altceva)
		return [
			'template' => 'home.html.php',
			'title' => 'Home',
			'variables' => []
		];
	}
	

	public function delete() {
		$currency = $this->currencisesTable->findById($_POST['id']);
		$this->currencisesTable->delete($_POST['id']);
		header('location: /currency/list'); 
	}

	public function saveEdit() {
	
		$currency = $_POST['currency'];		 

		$this->currencisesTable->save($currency);
		
		header('location: /currency/list'); 
	}

	public function edit() {
		if (isset($_GET['id'])) {
			$currency = $this->currencisesTable->findById($_GET['id']);			    
		}
		return ['template' => 'currencyedit.html.php',
				'title' => "header",
				'variables' => [
						'currency' => $currency ?? null,
						'header' => $header ?? null
					]
				];
	}
	
}
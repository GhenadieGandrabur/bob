<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Currency {
	//private $authorsTable;
	private $currencisesTable;
	private $authentication;

	public function __construct(DatabaseTable $currencyTable/*, DatabaseTable $authorsTable*/, Authentication $authentication) {
		$this->currencisesTable = $currencyTable;
		//$this->authorsTable = $authorsTable;
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

	public function home() {
		$title = 'Home';

		return ['template' => 'home.html.php', 'title' => $title];
	}

	public function delete() {
		$currency = $this->currencisesTable->findById($_POST['id']);
		$this->currencisesTable->delete($_POST['id']);
		header('location: /currency/list'); 
	}

	public function saveEdit() {
		// if (isset($_GET['id'])) {
		// 	$currency = $this->currencisesTable->findById($_GET['id']);			
		// }

		$currency = $_POST['currency'];
		//$currency['date'] = new \DateTime();
		 

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
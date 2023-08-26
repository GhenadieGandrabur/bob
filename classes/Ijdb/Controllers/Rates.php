<?php
namespace Ijdb\Controllers;

use Ijdb\Repositories\RateRepository;
use \Ninja\Authentication;
use \Ninja\DatabaseTable;

class Rates
{
    private $currenciesTable;
    private $ratesTable;
    //private $authentication;

    public function __construct(RateRepository $rateTable, DatabaseTable $currenciesTable /*DatabaseTable $authorsTable//, Authentication $authentication*/)
    {
        $this->ratesTable = $rateTable;        
        $this->currenciesTable = $currenciesTable;
       // $this->authentication = $authentication;
    }

    function list() {

        return ['template' => 'rates.html.php',
            'title' => "Rates list",
            'variables' => [
                'totalrates' => $this->ratesTable->total(),
                'rates' => $this->ratesTable->getAll(),
            ],
        ];
    }



    public function delete()
    {
        $rate = $this->ratesTable->findById($_POST['id']);
        $this->ratesTable->delete($_POST['id']);
        header('location: /rate/list');
    }

    public function saveEdit()
    {
        $rate = $this->$currenciesTable->getName();
        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();
        $author->addJoke($joke);
        header('location: /rate/list');

    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $rate = $this->ratesTable->findById($_GET['id']);
            $currencies = $this->currenciesTable->findAll();  
            $header = "Edit rate";       
        }else{
            $currencies = $this->currenciesTable->findAll();
            $header = "New rate";
                }        
		
        return ['template' => 'rateedit.html.php',
            'title' => $header,
            'variables' => [
                'rate' => $rate ?? null,
                'currencies' => $currencies ?? null,
                'header'=>$header
                
            ],
        ];
    }

}

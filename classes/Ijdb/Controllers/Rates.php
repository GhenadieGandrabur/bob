<?php
namespace Ijdb\Controllers;
use \Ninja\Authentication;
use \Ninja\DatabaseTable;

class Rates
{
    private $currensisesTable;
    private $ratesTable;
    //private $authentication;

    public function __construct(DatabaseTable $rateTable, DatabaseTable $currensisesTable /*DatabaseTable $authorsTable//, Authentication $authentication*/)
    {
        $this->ratesTable = $rateTable;        
        $this->currensisesTable = $currensisesTable;
       // $this->authentication = $authentication;
    }

    function list() {

        return ['template' => 'rates.html.php',
            'title' => "Rates list",
            'variables' => [
                'totalrates' => $this->ratesTable->total(),
                'rates' => $this->ratesTable->findAll(),
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
        // if (isset($_GET['id'])) {
        //     $rate = $this->ratesTable->findById($_GET['id']);
        // }

        $rate = $_POST['rate'];
        $rate['date'] = new \DateTime();

        $this->ratesTable->save($rate);

        header('location: /rate/list');
    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $rate = $this->ratesTable->findById($_GET['id']);
            $currency = $this->currensisesTable->findById($rate->currency_id);   
            //$rate->currency_id = $currency->name;
                   
            $header = "Rate edit";
        }else{
            $header = "Add a new rate";
		}
        return ['template' => 'rateedit.html.php',
            'title' => "header",
            'variables' => [
                'rate' => $rate ?? null,
                'currency' => $currensy ?? null,
                'header' => $header ?? null,
            ],
        ];
    }

}

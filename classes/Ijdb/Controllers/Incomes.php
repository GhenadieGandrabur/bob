<?php
namespace Ijdb\Controllers;

use Ijdb\Repositories\RateRepository;
use \Ninja\Authentication;
use \Ninja\DatabaseTable;

class Incomes
{
    private $currenciesTable;
    private $ratesTable;
    private $incomesTable;

    public function __construct(DatabaseTable $rateTable, DatabaseTable $currenciesTable, DatabaseTable $incomesTable)
    {
        $this->ratesTable = $rateTable;        
        $this->currenciesTable = $currenciesTable;
        $this->incomesTable = $incomesTable;
    }

    function list() {
        return ['template' => 'incomes.html.php',
            'title' => "Incomes list",
            'variables' => [
                'totalIcomes' => $this->incomesTable->total(),
                'incomes' => $this->incomesTable->findAll()
            ],
        ];
    }



    public function delete()
    {
        $income = $this->incomesTable->findById($_POST['id']);
        $this->incomesTable->delete($_POST['id']);
        header('location: /income/list');
    }

    public function saveEdit()
    {
        $income = $_POST['income'];       
      
        $this->incomesTable->save($income);

        header('location: /income/list');
    }

    public function edit()
    {
        if (isset($_GET['id']))
        {                        
            $incomes = $this->incomesTable->findAll();
            $curensies = $this->currenciesTable->findAll();                  
        } 
		
        return ['template' => 'incomeedit.html.php',
            'title' => "Incomes",
            'variables' => [                                
                'incomes' => $incomes ?? null,
                'currensies'=>$curensies?? null                
            ],
        ];
    }

}

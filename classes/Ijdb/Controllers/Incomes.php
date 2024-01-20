<?php



namespace Ijdb\Controllers;

use Ijdb\Repositories\IncomesRepository;
use \Ninja\Authentication;
use \Ninja\DatabaseTable;

class Incomes
{  
    private $currenciesTable;
   // private $ratesTable;
    private $incomesTable;


    public function __construct(IncomesRepository $incomesTable, DatabaseTable $currenciesTable)
    {
        //$this->ratesTable = $ratesTable;        
        $this->currenciesTable = $currenciesTable;
        $this->incomesTable = $incomesTable;
    }

  

    function list() {         
        return ['template' => 'incomes.html.php',
            'title' => "Incomes list",
            'variables' => [
                'totalIcomes' => $this->incomesTable->total(),
                'incomes' => $this->incomesTable->getAll()                              
            ],
        ];
    }

    public function delete()
    {
        
        $this->incomesTable->delete($_POST['id']);
        header('location: /income/list');
    }

    public function saveEdit()
    {
        $income = $_POST['income'];       
        $income['created'] = date('Y-m-d', time());
        $income['id'] = 0;
        $this->incomesTable->save($income); 

        header('location: /income/list');
    }

    
    public function edit()
    {
        $currencies = $this->incomesTable->getAllCurrencies();
        $facevalues = [];
        if (isset($_GET['id']))
        {                        
            $income = $this->incomesTable->findById($_GET['id']);      
            $facevalues = $this->incomesTable->getFacevaluesByIncomeId($_GET['id']);  
        } 
    
            
        return ['template' => 'incomeedit.html.php',
            'title' => "Incomes",
            'variables' => [                                
                'income' => $income?? null,
                'currencies' => $currencies ?? null,
                'facevalues' => $facevalues
            ],
        ];
    }


}

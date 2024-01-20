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
                'incomess' => $this->incomesTable->getAll()                              
            ],
        ];
    }

    public function delete()
    {
        $incomes = $this->incomesTable->findById($_POST['id']);
        $this->incomesTable->delete($_POST['id']);
        header('location: /income/list');
    }

    public function saveEdit()
    {
        $income = $_POST['income'];       
        $income['date'] = date('Y-m-d', time());
        $income['id'] = 0;
        $this->incomesTable->save($income);
        print '<pre>'. print_r($income, true).'</pre>';
        die;

        header('location: /income/list');
    }

    
        public function edit()
{
    if (isset($_GET['id']))
    {                        
        $income = $this->incomesTable->findById($_GET['id']);      
        $currencies = $this->incomesTable->getAllCurrencies();
            // $this->incomesTable->debug($income);
            // $this->incomesTable->debug($currencies);         
    } 
    else
    {
         empty($income); // Initialize an empty array if no incomes is found
         $currencies = $this->incomesTable->getAllCurrencies();
         
    }
		
    return ['template' => 'incomeedit.html.php',
        'title' => "Incomes",
        'variables' => [                                
            'income' => $income?? null,
            'currencies' => $currencies ?? null
        ],
    ];
}


}

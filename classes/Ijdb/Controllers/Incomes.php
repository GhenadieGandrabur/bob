<?php



namespace Ijdb\Controllers;

use Ijdb\Repositories\IncomesRepository;
use \Ninja\Authentication;
use \Ninja\DatabaseTable;

class Incomes
{
  //  private $currenciesTable;
   // private $ratesTable;
    private $incomesTable;


    public function __construct(IncomesRepository $incomesTable)
    {
        //$this->ratesTable = $ratesTable;        
       // $this->currenciesTable = $currenciesTable;
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
        $income = $this->incomesTable->findById($_POST['id']);
        $this->incomesTable->delete($_POST['id']);
        header('location: /income/list');
    }

    public function saveEdit()
    {
        $income = $_POST['income'];

        $income['date'] = new \DateTime();     
      
        $this->incomesTable->save($income);

        header('location: /income/list');
    }

    
        public function edit()
{
    if (isset($_GET['id']))
    {                        
        $incomes = $this->incomesTable->findById($_GET['id']);
        $currencies = $this->incomesTable->getAllCurrencies();
    } 
    else
    {
        $incomes = []; // Initialize an empty array if no income is found
        $currencies = $this->incomesTable->getAllCurrencies();
    }
		
    return ['template' => 'incomeedit.html.php',
        'title' => "Incomes",
        'variables' => [                                
            'incomes' => $income?? null,
            'currencies' => $currencies ?? null
        ],
    ];
}




}

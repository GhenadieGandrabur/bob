<?php



namespace Ijdb\Controllers;

use Ijdb\Repositories\IncomesRepository;
use \Ninja\Authentication;
use \Ninja\DatabaseTable;
use tidy;

class Incomes
{  
    private $currenciesTable;
    private $incomesTable;


    public function __construct(IncomesRepository $incomesTable, DatabaseTable $currenciesTable)
    {   
        $this->currenciesTable = $currenciesTable;
        $this->incomesTable = $incomesTable;
    }

  

    function list() {   
        $start  = $_GET['start'] ?? date('Y-m-d', strtotime('-1 month'));
        $finish  = $_GET['finish'] ?? date('Y-m-d', time());
        $incomes = $this->incomesTable->getAllFaceValue($start, $finish);
        $totalSum = 0;
        foreach($incomes as $income)
        {
            $totalSum += $income['total_amount'];
        }
        

        return ['template' => 'incomes.html.php',
            'title' => "Incomes list",
            'variables' => [
                'totalIcomes' => $this->incomesTable->total(),
                'incomes' => $incomes,
                'totalAmount' => $totalSum                            
            ],
        ];
    }

    public function delete()
    {
        $incomeId = intval($_POST['id']);
        $this->incomesTable->clearFacevaluesByIncomeId($incomeId);
        $this->incomesTable->delete($incomeId);
        header('location: /income/list');
    }

    public function saveEdit()
    {
        $data = $_POST['income']; 
        $incomeId = $data['id'] ?? null;
        $created = $data['created'] ?? date('Y-m-d', time());
       
        $incomeId = $this->incomesTable->save([
            'id' => $incomeId,
            'created' => $created,
            'total_amount' => $data['total_amount']
        ]);
        if(empty($incomeId))
        {
            $incomeId = $this->incomesTable->find('created', $created)[0]->id;
        }

        $incomes = [];
        for($i = 0; $i < sizeof($data['facevalue']); $i++)
        {  
            if(empty(empty($data['currency_id'][$i]) || empty($data['rate'][$i]) || $data['facevalue'][$i]) || empty($data['quantity'][$i]) || empty($data['amount'][$i]) || empty($data['summ'][$i]))
            {
                continue;
            }          
            $incomes[] = [
                'income_id' => $incomeId,
                'currency_id' => $data['currency_id'][$i],
                'facevalue' => $data['facevalue'][$i],
                'quantity' => $data['quantity'][$i],
                'amount' => $data['amount'][$i],
                'rate' => $data['rate'][$i],
                'summ' => $data['summ'][$i]
            ];
        }
        $this->incomesTable->clearFacevaluesByIncomeId($incomeId);
        if(count($incomes) > 0)
        {
            $this->incomesTable->saveFacevalues($incomes);
        }          
        

        header('location: /income/list');
    }

    
    public function edit()
    {
        $currencies = $this->incomesTable->getAllCurrencies();
        $facevalues = [];
        $income = null;
        if (isset($_GET['id']))
        {                        
            $income = $this->incomesTable->findById($_GET['id']);      
            $facevalues = $this->incomesTable->getFacevaluesByIncomeId($_GET['id']);  
        } 
        // $totalAmount = 0;
        // foreach($facevalues as $facevalue)
        // {
        //     $totalAmount+= $facevalue->summ;
        // }    
            
        return ['template' => 'incomeedit.html.php',
            'title' => "Incomes",
            'variables' => [                                
                'income' => $income?? null,
                'currencies' => $currencies ?? null,
                'facevalues' => $facevalues,
                'totalAmount' => $income->total_amount?? null
            ],
        ];
    }


}

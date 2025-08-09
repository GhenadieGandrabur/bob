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
        // Interval implicit: luna curentă
        $start  = $_GET['start']  ?? date('Y-m-01'); // prima zi a lunii
        $finish = $_GET['finish'] ?? date('Y-m-t');  // ultima zi a lunii
    
        // (opțional) Validare rapidă a formatului YYYY-MM-DD
        foreach (['start' => &$start, 'finish' => &$finish] as $k => &$v) {
            $dt = \DateTime::createFromFormat('Y-m-d', $v);
            if (!$dt || $dt->format('Y-m-d') !== $v) {
                $v = ($k === 'start') ? date('Y-m-01') : date('Y-m-t');
            }
        }
    
        // Ia încasările din interval
        $incomes = $this->incomesTable->getAllFaceValue($start, $finish);
    
        // Sortează descrescător după data creării (ajustează cheia dacă la tine e alta)
        if (is_array($incomes)) {
            usort($incomes, function ($a, $b) {
                return strcmp($b['created'] ?? '', $a['created'] ?? '');
            });
        } else {
            $incomes = [];
        }
    
        // Total sigur numeric
        $totalSum = 0.0;
        foreach ($incomes as $income) {
            $totalSum += (float)($income['total_amount'] ?? 0);
        }
    
        return [
            'template' => 'incomes.html.php',
            'title'    => 'Incomes list',
            'variables'=> [
                'totalIcomes' => $this->incomesTable->total(),
                'incomes'     => $incomes,
                'totalAmount' => $totalSum,
                'start'       => $start,
                'finish'      => $finish,
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

    // Curățăm suma totală: înlăturăm spații și înlocuim virgule cu punct
    $totalAmount = str_replace([' ', ','], ['', '.'], $data['total_amount']);

    // Salvăm în tabelul principal "income"
    $incomeId = $this->incomesTable->save([
        'id' => $incomeId,
        'created' => $created,
        'total_amount' => $totalAmount
    ]);

    // Dacă nu s-a întors un ID valid, îl căutăm după dată
    if (empty($incomeId)) {
        $incomeId = $this->incomesTable->find('created', $created)[0]->id;
    }

    $incomes = [];

    for ($i = 0; $i < count($data['facevalue']); $i++) {
        // Curățăm fiecare valoare
        $currency_id = $data['currency_id'][$i] ?? null;
        $rate       = str_replace([' ', ','], ['', '.'], $data['rate'][$i] ?? '');
        $facevalue  = $data['facevalue'][$i] ?? null;
        $quantity   = str_replace([' ', ','], ['', '.'], $data['quantity'][$i] ?? '');
        $amount     = str_replace([' ', ','], ['', '.'], $data['amount'][$i] ?? '');
        $summ       = str_replace([' ', ','], ['', '.'], $data['summ'][$i] ?? '');

        // Verificăm că toate sunt completate și numerice
        if (
            empty($currency_id) ||
            !is_numeric($rate) || !is_numeric($facevalue) ||
            !is_numeric($quantity) || !is_numeric($amount) || !is_numeric($summ)
        ) {
            continue;
        }

        $incomes[] = [
            'income_id' => $incomeId,
            'currency_id' => $currency_id,
            'facevalue' => $facevalue,
            'quantity' => $quantity,
            'amount' => $amount,
            'rate' => $rate,
            'summ' => $summ
        ];
    }

    // Ștergem înregistrările anterioare ale rândurilor pentru această încasare
    $this->incomesTable->clearFacevaluesByIncomeId($incomeId);

    // Salvăm doar dacă avem ceva valid
    if (count($incomes) > 0) {
        $this->incomesTable->saveFacevalues($incomes);
    }

    header('Location: /income/list');
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

    public function print()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Location: /income/list');
        exit;
    }

    $income = $this->incomesTable->findById($id);

    if (!$income) {
        header('Location: /income/list');
        exit;
    }

    // presupunem că ai o metodă getFaceValues($id)
    $facevalues = $this->incomesTable->getFaceValues($id);

    // obținem toate valutele ca [id => name] pentru afișare
    $currencies = $this->currenciesTable->findAll();
    $currenciesById = [];
    foreach ($currencies as $c) {
        $currenciesById[$c->id] = $c->name;
    }

    return [
        'template' => 'income-print.html.php',
        'title' => 'Print income',
        'variables' => [
            'income' => $income,
            'facevalues' => $facevalues,
            'currenciesById' => $currenciesById
        ]
    ];
}



}

<?php
namespace Ijdb\Repositories;

use Ninja\DatabaseTable;

class IncomesRepository extends DatabaseTable{
    
    public function getAll()
    {
        return $this->query("SELECT * FROM income")->fetchAll();
    }

    public function getAllCurrencies()
    {
        return $this->query("SELECT * FROM currencies")->fetchAll();
    }   

    public function getFacevaluesByIncomeId($income_id)
    {
        return $this->query("SELECT * FROM income_facevalues WHERE income_id = $income_id")->fetchAll(\PDO::FETCH_OBJ);
    }    

    public function saveFacevalues($facevalues)
    {
        foreach($facevalues as $facevalue)
        {
            $this->query(sprintf("INSERT INTO income_facevalues (income_id, currency_id, facevalue, quantity,  amount, rate, summ) 
                VALUES (%d, %d, %d, %d, %d, %.2f, %.2f)", $facevalue['income_id'], $facevalue['currency_id'], $facevalue['facevalue'], 
                $facevalue['quantity'], $facevalue['amount'], $facevalue['rate'], $facevalue['summ']));
        }
    }

    public function clearFacevaluesByIncomeId($incomeId)
    {
        $this->query("DELETE FROM income_facevalues WHERE income_id = $incomeId");
    }
}
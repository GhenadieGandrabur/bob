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

    public function getAllFaceValue($start, $finish)
    {
        return $this->query("SELECT * FROM income WHERE created BETWEEN '$start' AND '$finish' ")->fetchAll(\PDO::FETCH_ASSOC);
    }    

    public function saveFacevalues($facevalues)
    {
        foreach($facevalues as $facevalue)
        {
            $query = sprintf("INSERT INTO income_facevalues (income_id, currency_id, facevalue, quantity,  amount, rate, summ) 
                VALUES (%d, %d, %d, %d, %d, %.2f, %.2f)", $facevalue['income_id'], $facevalue['currency_id'], $facevalue['facevalue'], 
                $facevalue['quantity'], $facevalue['amount'], $facevalue['rate'], $facevalue['summ']);                
            $this->query($query);
        }
    }

    public function clearFacevaluesByIncomeId($incomeId)
    {
        $this->query("DELETE FROM income_facevalues WHERE income_id = $incomeId");
    }

    public function getFaceValues($incomeId)
    {
        $query = 'SELECT * FROM income_facevalues WHERE income_id = :income_id';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['income_id' => $incomeId]);
    
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
    

}
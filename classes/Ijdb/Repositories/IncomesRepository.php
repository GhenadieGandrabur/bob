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

}
<?php
namespace Ijdb\Repositories;

use Ninja\DatabaseTable;

class IncomesRepository extends DatabaseTable{
    
    public function getAll()
    {
        return $this->query("select i.*, c.name as currency_name from incomes i left join currencies c on i.currency_id=c.id;");
    }

    public function getAllCurrencies()
    {
        return $this->query("SELECT * FROM currencies")->fetchAll();
    }    

}
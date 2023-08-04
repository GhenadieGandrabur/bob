<?php
namespace Ijdb\Repositories;

use Ninja\DatabaseTable;

class RateRepository extends DatabaseTable{
    
    public function getAll()
    {
        return $this->query("select r.*, c.name as currency_name from rates r left join currencies c on r.currency_id=c.id");
    }
}
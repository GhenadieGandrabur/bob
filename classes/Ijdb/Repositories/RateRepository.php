<?php
namespace Ijdb\Repositories;

use Ninja\DatabaseTable;

class RateRepository extends DatabaseTable{
    
    public function getAll()
    {
        return $this->query("select r.*, c.name as currency_name from rates r left join currencies c on r.currency_id=c.id");
    }

    public function getLastRates()
    {
       $query = "SELECT 
       c.name,
       r2.*
       FROM rates r2
       INNER JOIN (SELECT currency_id, max(`date`) as `date` FROM rates  GROUP BY currency_id) r1
       ON r2.currency_id = r1.currency_id AND r2.date = r1.date
       LEFT JOIN currencies c ON r2.currency_id = c.id";

        $result =  $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        $rates = [];
        foreach($result??[] as $row)
        {            
            $rates[$row['name']] = $row['rate'];
        }
        return $rates;
    }
}
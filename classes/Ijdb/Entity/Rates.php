<?php
namespace Ijdb\Entity;

class Rates {

    public $id;
    public $date;
    public $currency_id;
    public $rate;

    public function __construct(\Ninja\DatabaseTable $ratesTable)
    {
        $this->ratesTable = $ratesTable;
    }

    public function getRate()
    {
        return $this->ratesTable->find('currency_id', $this->id);
    }   

    public function addRate($rate) {

    $rate['currency_id'] = $this->id;

    $this->ratesTable->save($rate);
}

}
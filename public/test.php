<?php
$pdo = new PDO('mysql:host=localhost;dbname=zp;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class Rate
{
   private $table;
   public function __construct($table)
   {
    $this->table = $table;
   }

   public function findAll(){
    $result = ('SELECT * FROM ' . $this->table);
    return $result;
}
   

}

$rates = new Rate('rates');

foreach($rates as $rare)
{
    echo "Rate " . $rate['rate'];
}

<?php
class Squar
{
    public $width; 
    public $height; 

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function area()
    {
        return $this->width * $this->height;
    }
}

$s = new Squar(30,80);
echo $s->area();



?>
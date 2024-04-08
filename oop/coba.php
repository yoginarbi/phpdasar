<?php
class Coba
{
    public $pemain, $umur, $footbalteam;

    public function getLabel()
    {
        return "$this->pemain, $this->umur, $this->footbalteam";
    }
}

$a = new Coba();
$a->pemain = "Cristiano Ronaldo";
$a->umur = 23;
$a->footbalteam = "Al Nassr";
echo $a->getLabel();

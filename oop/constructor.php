<?php

class Komik
{
    public $judul, $penulis, $harga;

    public function __construct($judul = "Judul", $penulis = "Penulis", $harga = 0)
    {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->harga = $harga;
    }

    public function getLabel()
    {
        return "$this->judul, $this->harga";
    }
}

$komik1 = new Komik("Captain Tsubasa", "Minamino", 30000);
$komik2 = new Komik("Naruto");
echo "Komik : " . $komik1->getLabel();
echo "<br>";
echo "Komik : " . $komik2->getLabel();

<?php
class Produk
{
    public $judul = "penulis",
        $penulis = "penulis",
        $penerbit = "penerbit",
        $harga = 0;

    public function getLabel()
    {
        return "$this->judul, $this->penulis";
    }
}
$produk1 = new Produk();
$produk1->judul = "Captain Tsubasa";
$produk1->penulis = "Minamino";
echo "Komik : " . $produk1->getLabel();
echo "<br>";

$produk2 = new Produk();
$produk2->judul = "Naruto";
$produk2->penulis = "Sasuke";
echo "Komik : " . $produk2->getLabel();

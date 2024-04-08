<?php
class Komik
{
    public $judul, $penulis, $penerbit, $harga;

    public function __construct($judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0)
    {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->harga = $harga;
    }

    public function getLabel()
    {
        return "$this->penulis, $this->penerbit";
    }
}

class InfoKomik
{
    public function cetak(Komik $komik)
    {
        $str = "{$komik->judul} | {$komik->getLabel()} (Rp. {$komik->harga})";
        return $str;
    }
}

$komik1 = new Komik("Captain Tsubasa", "Yoichi Takahashi", "Takeshi", 40000);
$infoproduk1 = new InfoKomik();
echo "Komik : " . $infoproduk1->cetak($komik1);

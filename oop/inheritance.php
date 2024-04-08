<?php
class Produk
{
    public $judul, $penulis, $penerbit, $harga, $jmlHalaman, $waktuMain;

    public function __construct($judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0, $jmlHalaman = 0, $waktuMain = 0)
    {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->harga = $harga;
        $this->jmlHalaman = $jmlHalaman;
        $this->waktuMain = $waktuMain;
    }

    public function getLabel()
    {
        return "$this->penulis, $this->penerbit";
    }

    public function infoLengkap()
    {
        $str = "{$this->tipe} : {$this->judul} | {$this->getLabel()}  (Rp. {$this->harga})";
        return $str;
    }
}

class Komik extends Produk
{
    public function infoLengkap()
    {
        $str = "Komik : {$this->judul} | {$this->getLabel()}  (Rp. {$this->harga}) - {$this->jmlHalaman} Halaman";
        return $str;
    }
}

class Game extends Produk
{
    public function infoLengkap()
    {
        $str = "Game : {$this->judul} | {$this->getLabel()}  (Rp. {$this->harga}) ~ {$this->waktuMain} Jam";
        return $str;
    }
}

class InfoProduk
{
    public function cetak(Produk $produk)
    {
        $str = "{$produk->judul} | {$produk->getLabel()} (Rp. {$produk->harga})";
        return $str;
    }
}

$produk1 = new Komik("Captain Tsubasa", "Yoichi Takahashi", "Takeshi", 40000, 100, 0, "Komik");
$produk2 = new Game("FIFA 23", "Shao Yamamoto", "Airlangga", 20000, 0, 50, "Game");
echo $produk1->infoLengkap();
echo "<br>";
echo $produk2->infoLengkap();

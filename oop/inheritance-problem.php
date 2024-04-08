<?php
class Produk
{
    public $judul, $penulis, $penerbit, $harga, $jmlHalaman, $waktuMain, $tipe;

    public function __construct($judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0, $jmlHalaman = 0, $waktuMain = 0, $tipe = "Tipe")
    {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->harga = $harga;
        $this->jmlHalaman = $jmlHalaman;
        $this->waktuMain = $waktuMain;
        $this->tipe = $tipe;
    }

    public function getLabel()
    {
        return "$this->penulis, $this->penerbit";
    }

    public function infoLengkap()
    {
        $str = "{$this->tipe} : {$this->judul} | {$this->getLabel()}  (Rp. {$this->harga})";
        if ($this->tipe == "Komik") {
            $str .= " ~ {$this->jmlHalaman} Halaman";
        } else if ($this->tipe == "Game") {
            $str .= " ~ {$this->waktuMain} Jam";
        }
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

$produk1 = new Produk("Captain Tsubasa", "Yoichi Takahashi", "Takeshi", 40000, 100, 0, "Komik");
$produk2 = new Produk("FIFA 23", "Shao Yamamoto", "Airlangga", 20000, 0, 50, "Game");
$infoProduk = new InfoProduk();
echo $infoProduk->cetak($produk1);
echo "<br>";
echo $infoProduk->cetak($produk2);

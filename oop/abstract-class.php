<?php
abstract class Produk
{
    private $judul, $penulis, $penerbit;
    private $diskon = 0;

    private $harga;

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

    abstract public function infoLengkap();

    public function infoL()
    {
        $str = "{$this->judul} | {$this->getLabel()}  (Rp. {$this->harga})";
        return $str;
    }

    public function getHarga()
    {
        return $this->harga - ($this->harga * $this->diskon / 100);
    }
}

class Komik extends Produk
{
    public $jmlHalaman;
    public function __construct($judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0, $jmlHalaman = 0)
    {
        parent::__construct($judul, $penulis, $penerbit, $harga);
        $this->jmlHalaman = $jmlHalaman;
    }
    public function infoLengkap()
    {
        $str = "Komik : " . $this->infoL() . " ~ {$this->jmlHalaman}";
        return $str;
    }

    public function setDiskon($diskon)
    {
        $this->diskon = $diskon;
    }
}

class Game extends Produk
{
    public $waktuMain;

    public function __construct($judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0, $waktuMain = 0)
    {
        parent::__construct($judul, $penulis, $penerbit, $harga);
        $this->waktuMain = $waktuMain;
    }

    public function infoLengkap()
    {
        $str = "Game : " . $this->infoL() . " ~ {$this->waktuMain}";
        return $str;
    }

    public function setDiskon($diskon)
    {
        $this->diskon = $diskon;
    }
}

class CetakInfoProduk
{
    public $daftarProduk = array();

    public function tambahProduk(Produk $produk)
    {
        $this->daftarProduk[] = $produk;
    }

    public function cetak()
    {
        $str = "Daftar Produk : <br>";

        foreach ($this->daftarProduk as $p) {
            $str .= "- {$p->infoLengkap()} <br>";
        }
        return $str;
    }
}

$produk1 = new Komik("Captain Tsubasa", "Yoichi Takahashi", "Takeshi", 40000, 100);
$produk2 = new Game("FIFA 23", "Shao Yamamoto", "Airlangga", 20000, 50);

$infoProduk = new CetakInfoProduk();
$infoProduk->tambahProduk($produk1);
$infoProduk->tambahProduk($produk2);
echo $infoProduk->cetak();

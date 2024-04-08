<?php
session_start();
require 'functions.php';
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// pagination
$jmlDataPerHalaman = 3;
$jmlData = count(query("SELECT * FROM mahasiswa"));
$jmlHalaman = ceil($jmlData / $jmlDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jmlDataPerHalaman * $halamanAktif) - $jmlDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jmlDataPerHalaman");
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <a href="logout.php">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a>
    <h1>DAFTAR MAHASISWA</h1>
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>
    <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian ..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>
        <img src="img/loader.gif" class="loader">
    </form>
    <br>

    <?php if ($halamanAktif > 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jmlHalaman; $i++) : ?>
        <?php if ($i == $halamanAktif) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($halamanAktif < $jmlHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>

    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 4px;">
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>NRP</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>Foto</th>
            </tr>
            <?php $angka = 1; ?>
            <?php foreach ($mahasiswa as $mhs) : ?>
                <tr>
                    <td><?= $angka; ?></td>
                    <td>
                        <a href="ubah.php?id=<?= $mhs["id"]; ?>">Edit</a>
                        <a href="hapus.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('yakin data dihapus ?');">Delete</a>
                    </td>
                    <td><?= $mhs["nama"]; ?></td>
                    <td><?= $mhs["nrp"]; ?></td>
                    <td><?= $mhs["jurusan"]; ?></td>
                    <td><?= $mhs["email"]; ?></td>
                    <td>
                        <img src="img/<?= $mhs["gambar"]; ?>" alt="">
                    </td>
                </tr>
                <?php $angka++; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
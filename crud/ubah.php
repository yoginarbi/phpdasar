<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = '$id'")[0];

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo '
            <script>
                alert("Data berhasil diubah");
                document.location.href = "index.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Data gagal diubah");
                document.location.href = "index.php";
            </script>
        ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Ubah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li class="jarak">
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" value="<?= $mhs["nama"]; ?>">
            </li>
            <li class="jarak">
                <label for="nrp">NRP : </label>
                <input type="number" name="nrp" id="nrp" value="<?= $mhs["nrp"]; ?>">
            </li>
            <li class="jarak">
                <label for="email">E-mail : </label>
                <input type="text" name="email" id="email" value="<?= $mhs["email"]; ?>">
            </li>
            <li class="jarak">
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"]; ?>">
            </li>
            <li class="jarak">
                <label for="gambar">Gambar : </label><br>
                <img src="img/<?= $mhs["gambar"]; ?>" width="40"><br>
                <input type="file" name="gambar" id="gambar">
            </li>
        </ul>
        <button type="submit" name="submit">Ubah Data</button>
    </form>
</body>

</html>
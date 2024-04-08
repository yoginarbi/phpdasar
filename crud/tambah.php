<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo '
            <script>
                alert("Data berhasil ditambahkan");
                document.location.href = "index.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Data gagal ditambahkan");
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
    <title>Tambah Data</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li class="jarak">
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li class="jarak">
                <label for="nrp">NRP : </label>
                <input type="number" name="nrp" id="nrp" required>
            </li>
            <li class="jarak">
                <label for="email">E-mail : </label>
                <input type="text" name="email" id="email" required>
            </li>
            <li class="jarak">
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li class="jarak">
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
        </ul>
        <button type="submit" name="submit">Tambah Data</button>
    </form>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = intval($_GET["id"]); // Pastikan id adalah angka
$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$mhs = $result->fetch_assoc();

if (isset($_POST["submit"])) {
    if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        die("CSRF token tidak valid");
    }
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
    if (!isset($_SESSION["csrf_token"])) {
        $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"]; ?>">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li class="jarak">
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($mhs["nama"]); ?>">
            </li>
            <li class="jarak">
                <label for="nrp">NRP : </label>
                <input type="number" name="nrp" id="nrp" value="<?= htmlspecialchars($mhs["nrp"]); ?>">
            </li>
            <li class="jarak">
                <label for="email">E-mail : </label>
                <input type="text" name="email" id="email" value="<?= htmlspecialchars($mhs["email"]); ?>">
            </li>
            <li class="jarak">
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" value="<?= htmlspecialchars($mhs["jurusan"]); ?>">
            </li>
            <li class="jarak">
                <label for="gambar">Gambar : </label><br>
                <img src="img/<?= $mhs["gambar"]; ?>" width="40"><br>
                <input type="file" name="gambar" id="gambar" accept=".jpg, .jpeg, .png">
            </li>
        </ul>
        <button type="submit" name="submit">Ubah Data</button>
    </form>
</body>

</html>

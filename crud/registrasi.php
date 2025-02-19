<?php
require 'functions.php';

if (isset($_POST["register"])) {
    // Validasi input sebelum diteruskan ke fungsi registrasi
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if (empty($username) || empty($password) || empty($password2)) {
        echo "<script>alert('Semua field harus diisi!');</script>";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo "<script>alert('Username hanya boleh mengandung huruf, angka, dan underscore!');</script>";
    } elseif ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
    } else {
        if (registrasi($_POST) > 0) {
            echo "<script>
                    alert('User baru berhasil ditambahkan');
                    document.location.href = 'login.php';
                </script>";
            exit;
        } else {
            echo "<script>alert('Registrasi gagal!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Halaman Registrasi</h1>
    <form action="" method="post">
        <ul>
            <li class="jarak">
                <label for="username">Username : </label>
                <input type="text" name="username" id="username" required pattern="[a-zA-Z0-9_]+" title="Hanya huruf, angka, dan underscore yang diperbolehkan">
            </li>
            <li class="jarak">
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" required minlength="6" title="Minimal 6 karakter">
            </li>
            <li class="jarak">
                <label for="password2">Konfirmasi Password : </label>
                <input type="password" name="password2" id="password2" required>
            </li>
        </ul>
        <button type="submit" name="register">Register</button>
        <a href="login.php">Login</a>
    </form>
</body>

</html>

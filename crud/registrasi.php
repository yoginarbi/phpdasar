<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan');
                document.location.href = 'login.php';
            </script>";
        exit;
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <input type="text" name="username" id="username" required>
            </li>
            <li class="jarak">
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" required>
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
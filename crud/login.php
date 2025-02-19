<?php
session_start();
require "functions.php";

if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = intval($_COOKIE["id"]);
    $key = $_COOKIE["key"];

    $stmt = mysqli_prepare($conn, "SELECT username FROM user WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && hash_equals($key, hash('sha256', $row["username"]))) {
        $_SESSION["login"] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM user WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;

            if (isset($_POST["remember"])) {
                setcookie('id', $row["id"], time() + 86400, "", "", true, true);
                setcookie('key', hash('sha256', $row["username"]), time() + 86400, "", "", true, true);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Halaman Login</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">Username / Password salah</p>
    <?php endif; ?>
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
            <li>
                <label for="remember">Remember me</label>
                <input type="checkbox" name="remember" id="remember">
            </li>
        </ul>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>

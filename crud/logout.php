<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// Menghapus cookie dengan opsi yang lebih aman
setcookie('id', '', time() - 3600, '/', '', true, true);
setcookie('key', '', time() - 3600, '/', '', true, true);

header("Location: login.php");
exit;

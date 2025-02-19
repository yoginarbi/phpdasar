<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET["id"]);

// Pastikan pengguna memiliki izin untuk menghapus data ini (IDOR Prevention)
// Misalnya, cek apakah ID mahasiswa milik user yang login
$user_id = $_SESSION['user_id'] ?? 0; 
$result = query("SELECT user_id FROM mahasiswa WHERE id = ?", ["i", $id]);
if (empty($result) || $result[0]['user_id'] !== $user_id) {
    echo '<script>alert("Anda tidak memiliki izin untuk menghapus data ini");</script>';
    header("Location: index.php");
    exit;
}

if (hapus($id) > 0) {
    $_SESSION['message'] = "Data berhasil dihapus";
} else {
    $_SESSION['message'] = "Data gagal dihapus";
}

header("Location: index.php");
exit;
?>

<?php
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h1>Daftar Mahasiswa</h1>
    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 4px;">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NRP</th>
            <th>Jurusan</th>
            <th>Email</th>
            <th>Foto</th>
        </tr>';
$i = 1;
foreach ($mahasiswa as $row) {
    $html .= '<tr>
        <td>' . $i++ . '</td>
        <td>' . $row["nama"] . '</td>
        <td>' . $row["nrp"] . '</td>
        <td>' . $row["jurusan"] . '</td>
        <td>' . $row["email"] . '</td>
        <td><img src="img/' . $row["gambar"] . '" width="50"></td>
    </tr>';
}

$html .= '</table>
</body>

</html>';
$mpdf->WriteHTML($html);
$mpdf->Output("daftar-mahasiswa.pdf", "I");

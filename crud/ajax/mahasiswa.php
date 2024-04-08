<?php
require '../functions.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM mahasiswa WHERE
        nama LIKE '%$keyword%' OR
        nrp LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
        ";
$mahasiswa = query($query);
?>
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
<?php
if (isset($_GET['angka'])) {
    $angka = $_GET['angka'];
    $angkaArr = explode(",", $angka);
    $frekuensi = array_count_values($angkaArr);
    $modus = array_search(max($frekuensi), $frekuensi);
    echo "Angka yang di inputkan : " . $angka . "<br>";
    foreach ($frekuensi as $f => $a) {
        echo $f . " muncul sebanyak " . $a . " x <br>";
    }
    echo "Modus = " . $modus;
    echo "<br>";
}
?>

<form method="get">
    Input Angka : <input type="text" name="angka">
    <input type="submit" value="Masukkan Angka">
</form>
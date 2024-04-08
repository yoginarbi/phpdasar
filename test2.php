<?php
if (isset($_GET['angka'])) {
    $angka = $_GET['angka'];

    $total = 0;
    for ($i = 0; $i < $angka; $i++) {
        echo $total . " + " . ($angka - $i) . " = ";
        $total += $angka - $i;
        echo $total;
        echo "<br>";
    }
}
?>
<form method="get">
    Input Angka: <input type="number" name="angka">
    <input type="submit" value="submit">
</form>
<?php

function formatNumber($number)
{
    $number = str_replace('.', '', $number);
    $number = strrev($number);

    $formatted = '';
    $length = strlen($number);

    for ($i = $length - 1; $i >= 0; $i--) {
        $formatted .= $number[$i] * pow(10, $i) . "<br>";
    }

    return trim($formatted);
}

$number = '1.225.441';
$result = formatNumber($number);
echo $result;

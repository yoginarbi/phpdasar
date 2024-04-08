<?php
function countCharacters($inputString)
{
    $currentChar = '';
    for ($i = 0; $i < strlen($inputString); $i++) {
        echo $char = $inputString[$i];

        if ($char === $currentChar) {
            echo "Benar";
        } else {
            echo "Salah";
        }
    }

    return $char;
}

$input = "aaabbcccaaaac";
$output = countCharacters($input);
echo $output;

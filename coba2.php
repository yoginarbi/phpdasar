<?php

function countCharacters($inputString)
{
    $result = '';
    $currentChar = '';
    $count = 0;

    for ($i = 0; $i < strlen($inputString); $i++) {
        $char = $inputString[$i];

        if ($char === $currentChar) {
            $count++;
        } else {
            if ($count > 0) {
                $result .= "$currentChar=$count <br>";
            }
            $currentChar = $char;
            $count = 1;
        }
    }

    if ($count > 0) {
        $result .= "$currentChar=$count <br>";
    }

    return $result;
}

$input = "aaabbcccaaaac";
$output = countCharacters($input);
echo $output;

<?php

echo 'AoC Day 1 <br />';
$inputs = array_map('intval', file('input_01.txt'));

foreach ($inputs as $input) {
    $search = 2020 - $input;
    $key = array_search($search, $inputs);
    if (!empty($key) && $inputs[$key] + $input === 2020) {
        $output = $inputs[$key] * $input;
        echo 'Solution Day 1: '. $output. '<br />';
        break;
    }
}

// ------------------------------------------------------------------

$output = 0;
foreach ($inputs as $number1) {
    foreach ($inputs as $number2) {
        foreach ($inputs as $number3) {
            if ($number1 + $number2 + $number3 === 2020) {
                $output = $number1 * $number2 * $number3;
                break;
            }
        }
    }
}
echo 'Solution Day 2: '. $output. '<br />';
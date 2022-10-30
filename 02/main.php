<?php

$rows = file('input_02.txt');

$count1 = 0;
foreach ($rows as $row) {
    $elements = explode(' ', $row);
    $range = explode('-', $elements[0]);
    $min = intval($range[0]);
    $max = intval($range[1]);
    $letter = substr($elements[1], 0, -1);
    $pass = $elements[2];

    $check = substr_count($pass, $letter);

    if ($check >= $min && $check <= $max) {
        $count1 += 1;
    }
}

echo 'Solution 1 Day 2: '.$count1.'<br />';

//-----------------------------------------------------------------

$count2 = 0;
foreach ($rows as $row) {
    $elements = explode(' ', $row);
    $range = explode('-', $elements[0]);
    $pos1 = intval($range[0]);
    $pos2 = intval($range[1]);
    $letter = substr($elements[1], 0, -1);
    $pass = str_split($elements[2]);

    if ($pass[$pos1 - 1] === $letter xor $pass[$pos2 - 1] === $letter) {
        $count2 += 1;
    }
}
echo 'Solution 2 Day 2: '.$count2;

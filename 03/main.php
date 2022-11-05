<?php

/**
 * keine ahnung input ist evtl falsch
 * martin hat dort einen anderen input
 * lege das erstmal zur seite
 * oder habe probleme mit array versatz und index
 */

$rows = file('input_03.txt');

$length = strlen($rows[0]);

$posX = 0;
$rest = 0;
$skip = true;
$treeCount = 0;

foreach ($rows as $row) {
    if ($skip) {
       $skip = false;
       continue;
    }
    $line = str_split($row);
    $posX = $posX + 3;
    if ($posX >= $length) {
        $rest = $posX - $length;
        $posX = $rest + 3;
    }
    if ($line[$posX] === '#') {
        $treeCount++;
    }
}

echo $treeCount;

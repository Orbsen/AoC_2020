<?php

$boardingInfos = file('input_05.txt');
$rowNumber = range(0, 127);
$row = range(0, 7);
$sequence1 = [64, 32, 16, 8, 4, 2, 1];
$sequence2 = [4, 2, 1];
$seatIds = [];
$allSeatIds = range(0 * 8 + 0, 127 * 8 + 7);

$highestSeatId = 0;
foreach ($boardingInfos as $boardingInfo) {
    $result = getSeatingInformation($boardingInfo, $rowNumber, $row, $sequence1, $sequence2);
    $highestSeatId = max($highestSeatId, $result['seatId']);
    $seatIds[] = $result['seatId'];
}

echo 'solution Day 5-1: '. $highestSeatId . '<br />';

$solution2 = findMySeatId($allSeatIds, $seatIds);

echo 'solution Day 5-2: '. $solution2;

function getSeatingInformation($boardingInfo, $rowNumber, $row, $sequence1, $sequence2): array
{
    $info = array_chunk(str_split($boardingInfo), count($sequence1));

    for ($i = 0; $i < count($sequence1); $i++) {
        $rowNumber = array_chunk($rowNumber, $sequence1[$i]);
        if ($info[0][$i] === 'F') {
            $rowNumber = $rowNumber[0];
        } else {
            $rowNumber = $rowNumber[1];
        }
    }

    for ($i = 0; $i < count($sequence2); $i++) {
        $row = array_chunk($row, $sequence2[$i]);
        if ($info[1][$i] === 'L') {
            $row = $row[0];
        } else {
            $row = $row[1];
        }
    }

    $seatId = $rowNumber[0] * 8 + $row[0];

    return [
        'rowNumber' => $rowNumber[0],
        'row' => $row[0],
        'seatId' => $seatId,
    ];
}

function findMySeatId ($allSeatIds, $seatIds): mixed
{
    $compare = array_diff($allSeatIds, $seatIds);
    foreach ($compare as $item) {
        if (in_array($item +1, $seatIds) && in_array($item -1, $seatIds)) {
            return $item;
        }
    }
    return false;
}


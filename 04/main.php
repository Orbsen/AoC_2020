<?php

/**
 * ich bin off bei 1 bei der zweiten Lösung .. warscheinlich irgendein Edgecase noch nicht abgedeckt
 * leider noch nicht gefunden welcher dies sein sollte
 */

$rows = file('input_04.txt', FILE_IGNORE_NEW_LINES);
$passports = convertToArray($rows);
$eclColors = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];
$result1 = checkPassports1($passports);
$result2 = checkPassports2($passports, $eclColors);

echo 'Solution Day 4-1: '.$result1.'<br />';
echo 'Solution Day 4-2: '.$result2.'<br />';

function convertToArray ($rows): array
{
    $return = [];
    $counter = 0;
    foreach ($rows as $row) {
        if (empty($row)) {
            $counter++;
            continue;
        }
        $elements = explode(' ', $row);
        foreach ($elements as $element) {
            $item = explode(':', $element);
            $return[$counter][$item[0]] = $item[1];
        }
    }
    return $return;
}

function checkPassports1($passports): int
{
    $counter = 0;

    foreach ($passports as $passport) {
        $eyr = array_key_exists('eyr', $passport);
        $iyr = array_key_exists('iyr', $passport);
        $byr = array_key_exists('byr', $passport);
        $ecl = array_key_exists('ecl', $passport);
        $pid = array_key_exists('pid', $passport);
        $hcl = array_key_exists('hcl', $passport);
        $hgt = array_key_exists('hgt', $passport);
        $cit = array_key_exists('cit', $passport);

        if ($eyr && $iyr && $byr && $ecl && $pid && $hcl && $hgt) {
            $counter++;
        }
    }

    return $counter;
}

function checkPassports2($passports, $eclColors): int
{
    $counter = 0;

    foreach ($passports as $passport) {
        $eyr = false;
        $iyr = false;
        $byr = false;
        $ecl = false;
        $pid = false;
        $hcl = false;
        $hgt = false;

        echo '<pre>';
        print_r($passport);
        echo '<pre />';

        if (
            array_key_exists('hgt', $passport) &&
            str_contains($passport['hgt'], 'cm') &&
            in_array(substr($passport['hgt'], 0, -2), range(150, 193))
        ) {
            $hgt = true;
        } elseif (
            array_key_exists('hgt', $passport) &&
            str_contains($passport['hgt'], 'in') &&
            in_array(substr($passport['hgt'], 0, -2), range(59, 76))
        ) {
            $hgt = true;
        }

        if (array_key_exists('eyr', $passport) && in_array($passport['eyr'], range(2020, 2030))) {
            $eyr = true;
        }

        if (array_key_exists('iyr', $passport) && in_array($passport['iyr'], range(2010, 2020))) {
            $iyr = true;
        }

        if (array_key_exists('byr', $passport) && in_array($passport['byr'], range(1920, 2002))) {
            $byr = true;
        }

        if (array_key_exists('ecl', $passport) && in_array($passport['ecl'], $eclColors)) {
            $ecl = true;
        }

        if (array_key_exists('pid', $passport) && preg_match('/[0-9]{9}/', $passport['pid'])) {
            $pid = true;
        }

        if (array_key_exists('hcl', $passport) && preg_match('/^#[0-9a-fA-F]{6}/', $passport['hcl'])) {
            $hcl = true;
        }

        if ($eyr && $iyr && $byr && $ecl && $pid && $hcl && $hgt) {
            $counter++;
        }
    }

    return $counter;
}


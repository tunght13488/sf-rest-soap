<?php

// #1
$a = 4;
$b = 13;
function my_swap(&$a, &$b) {
    list($a, $b) = [$b, $a];
}
my_swap($a, $b);
echo $a . "\n";
echo $b . "\n";

echo "--------\n";

// #2
function my_strlen($str) {
    for ($i = 0; ; $i++) {
        if (!isset($str[$i])) {
            return $i;
        }
    }
}
$tests = [
    'abc',
    'asdf',
];
foreach ($tests as $test) {
    echo "my_strlen('$test') = ".my_strlen($test) . "\n";
    echo "strlen('$test') = ".strlen($test) . "\n";
}

echo "--------\n";

// #3
function my_strpos($haystack, $needle) {
    $haystack_len = my_strlen($haystack);
    $needle_len = my_strlen($needle);
    for ($i = 0; $i < $haystack_len - $needle_len + 1; $i++) {
        $found = true;
        for ($j = 0; $j < $needle_len; $j++) {
            // printf("Comparing haystack[%s+%s]='%s' vs needle[%s]=%s\n", $i, $j, $haystack[$i+$j], $j, $needle[$j]);
            if ($haystack[$i + $j] !== $needle[$j]) {
                $found = false;
                break;
            }
        }
        if ($found) {
            return $i;
        }
    }
    return false;
}
$tests = [
    ['abcabc', 'ca'],
    ['abc', 'd'],
];
foreach ($tests as $test) {
    echo "my_strpos('" . $test[0] . "', '" . $test[1] . "') = " . my_strpos($test[0], $test[1]) . "\n";
    echo "strpos('" . $test[0] . "', '" . $test[1] . "') = " . strpos($test[0], $test[1]) . "\n";
}

echo "--------\n";

// #4
/*
an array of single digit numbers: $numbersArray = array(1,7,3,9,5,8);
and a number of switches allowed ($numberOfSwitchesAllowed).
Considering the fact that executing a switch means moving 2 adjacent items in the array to each other's positions (i.e. swapping them), complete the function in such a way, that by executing no more than the number of switches allowed, it will output the greatest possible number at the end.
 */
function calculateHighestNumber(array $numbersArray, $numberOfSwitchesAllowed = 5) {

    $max = 0;
    $trySwappingElements = function ($numbers, $switchesLeft, $previousSwitch = null) use (&$trySwappingElements, &$max) {
        // echo 'numbers: ' . implode('', $numbers) . "\n";
        // echo 'switchesLeft: ' . $switchesLeft . "\n";
        // echo 'previousSwitch: ' . $previousSwitch . "\n";
        if ($switchesLeft === 0) {
            $value = (int) implode('', $numbers);
            // echo 'value: ' . $value . "\n";
            if ($value > $max) {
                $max = $value;
                // echo 'max: ' . $max . "\n";
            }
            return;
        }
        for ($i = 0; $i < count($numbers) - 1; $i++) {
            if ($i === $previousSwitch) {
                continue;
            }
            my_swap($numbers[$i], $numbers[$i + 1]);
            $trySwappingElements($numbers, $switchesLeft - 1, $i);
        }
    };
    $trySwappingElements($numbersArray, $numberOfSwitchesAllowed);
    return $max;
}
echo calculateHighestNumber([1, 7, 3, 9, 5, 8]) . "\n";

echo "--------\n";

// #5
// original
$a = array('bla' => 1, '2' => 0, 'test' => 'testVal', '3' => 3);
$b = array();
for ($i = 1; $i <= count($a); $i++) {
    $b[$i] = !empty($a[$i]) ? $a[$i] : 0;
}
print_r($b);
// optimized
$a = array('bla' => 1, '2' => 0, 'test' => 'testVal', '3' => 3);
$b = array();
$count_a = count($a);
for ($i = 1; $i <= $count_a; $i++) {
    $b[$i] = !empty($a[$i]) ? $a[$i] : 0;
}
print_r($b);

echo "--------\n";

// #6
// Write an algorithm that will parse a multidimensional array with n rows and columns in a spiral starting from the centre. The n will always be an odd number.
$n = 5;
$a = [];
$visited = [];
// generate the matrix
for ($i = 0; $i < $n; $i++) {
    $a[$i] = [];
    $visited[$i] = [];
    for ($j = 0; $j < $n; $j++) {
        $a[$i][$j] = rand(0, $n * $n);
        $visited[$i][$j] = false;
    }
}
// show the matrix
echo implode("\n", array_map(function ($row) {
    return implode(' ', array_map(function ($number) {
        return str_pad($number, 3, " ", STR_PAD_LEFT);
    }, $row));
}, $a)) . "\n";

$x = $y = ($n - 1) / 2; // starting point
$directions = [
    [0, -1],    // left
    [-1, 0],     // up
    [0, 1],     // right
    [1, 0],    // down
];
$turnRightDirections = [
    0 => 1, // going left, check if can go up
    1 => 2, // going up, check if can go right
    2 => 3, // going right, check if can go down
    3 => 0, // going down, check if can go left
];
$direction = 0; // left
$steps = [$a[$x][$y]];  // first step at the centre
$visited[$x][$y] = true;
// echo "----\nstarting\n";
$walk = function ($x, $y, $direction) use ($a, &$visited, &$steps, $directions, $turnRightDirections, &$walk) {
    // printf("on %s-%s, going %s\n", $x, $y, $direction);

    // func to check if steping on $x, $y, can we go in $direction
    $canStepOn = function ($x, $y, $direction) use ($a, $visited, $directions) {
        $x = $x + $directions[$direction][0];
        $y = $y + $directions[$direction][1];
        if (!isset($a[$x]) || !isset($a[$x][$y]) || $visited[$x][$y] === true) {
            return false;
        }
        return true;
    };

    // check if we can walk
    // printf("canStepOn('%s', '%s', '%s') = %s\n", $x, $y, $direction, $canStepOn($x, $y, $direction) ? 'true' : 'false');
    if (!$canStepOn($x, $y, $direction)) {
        return;
    }

    // walk
    $x = $x + $directions[$direction][0];
    $y = $y + $directions[$direction][1];
    $steps[] = $a[$x][$y];
    $visited[$x][$y] = true;
    // printf("walked to %s-%s\n", $x, $y);
    // printf("steps: %s\n", json_encode($steps));

    // check if we can turn right
    $rightDirection = $turnRightDirections[$direction];
    if ($canStepOn($x, $y, $rightDirection)) {
        $direction = $rightDirection;
        // printf("going %s\n", $direction);
    }

    // go on
    $walk($x, $y, $direction);
};
$walk($x, $y, $direction);
echo 'steps: ' . implode(' ', $steps) . "\n";

echo "--------\n";

// #7
// Build an API
// Build a web service providing information about books.
// It should be possible to ask that service for books by a given ISBN, author, title, between a given date range or by minimum rating.
// We expect a good entity/model design where data entities and business logic are encapsulated.
// We will be looking for design decisions that will allow the solution to be technology agnostic, modular, following OOP principles, for a solution that is tested against error conditions and bad returns.
// By technology agnostic we mean that without a major refactor it should be possible to introduce another transport layer (SOAP/XML/REST), storage layer or swap out any other of the components.
// Your code should have functional tests as well as unit tests.
// Feel free to use any readily available components, but remember that it's your code that will ultimately be checked.
// We are expecting a PHP5.5 compatible code, backwards compatibility is not required.
// We are keen to see fresh thinking, clean, easy to follow, modern code.
// We really like to read lorem ipsums - please don't spend time looking for real life data.
// Please provide instructions how to run and test.


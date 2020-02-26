<?php

declare(strict_types=1);

function foo($a)
{
    return $a . $a;
}

foo('bar');

if (1 === 2) {
    return 2;
}

if (1 === 2) {
    return 2;
}

    return 1;
$a = (1 * 3) / 7;
$b = 3;
$c *= 2;
$d = true || false;

++$b;

$b += 3;

try {
    $a = 2;
} catch (Exception $exception) {
    echo 'gonna ' . 'break' . 'now!';
}

foreach (['a', 'b', 'c'] as $letter) {
    break;
}

$b = new stdClass();

$c = new class() {
    public static function foo()
    {
        return 'foo';
    }
};

$c::foo();

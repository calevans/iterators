<?php
$dwarves = [
    1 => 'Grumpy',
    2 => 'Happy',
    3 => 'Sleepy',
    4 => 'Bashful',
    5 => 'Sneezy',
    6 => 'Dopey',
    7 => 'Doc'
];

$it = new CachingIterator(new ArrayIterator($dwarves),
    CachingIterator::FULL_CACHE);
foreach ($it as $v) {
    ;
}

$it->offsetUnset(4);
$it->offsetSet('Cal', 'Kathy');
$it[5] = 'Surly';

foreach ($it as $offset => $value) {
    echo 'Original: ' . $offset . ' == ' . $value . "\n";
}

foreach ($it->getCache() as $offset => $value) {
    echo 'Cache: ' . $offset . ' == ' . $value . "\n";
}


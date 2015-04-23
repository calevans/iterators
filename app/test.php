<?php

$alphabetIterator = new ArrayIterator(range("A", "Z"));
$it = new CachingIterator($alphabetIterator,
    CachingIterator::FULL_CACHE);
foreach ($it as $v) {
    // Do something with the iterator
    echo $v . "\n";
}
$it->rewind();
$it[3] = 'Cal';
echo "The fourth letter of the alphabet is: " . $it[3] . PHP_EOL;

print_r($it);

echo "\n\n";

print_r($it->getInnerIterator());

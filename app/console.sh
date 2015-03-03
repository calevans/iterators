#!/usr/bin/env php
<?php
require_once __DIR__.'/../vendor/autoload.php'; 

use Iterators\Command;
use Symfony\Component\Console\Application;

$app = new Application('Iterators', '1.0.0');

$app->addCommands([new Command\ArrayIteratorCommand(),
				   new Command\CachingIteratorCommand(),
				   new Command\FizzBuzzCommand(),
				   new Command\FizzBuzzFilteredCommand(),
				   new Command\IteratorInterfaceCommand(),
                   new Command\GeneratorCommand(),
				   new Command\OuterIteratorCommand()]);
$app->run();
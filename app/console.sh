#!/usr/bin/env php
<?php
require_once __DIR__.'/../vendor/autoload.php'; 

use Iterators\Command;
use Symfony\Component\Console\Application;

$app = new Application('SigTest', '1.0.0');

$app->addCommands([new Command\IteratorInterfaceCommand()]);
$app->run();
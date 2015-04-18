<?php
namespace Iterators\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class RecursiveCommand extends Command
{

    protected function configure()
    {

        $this->setName("recursive")
            ->setDescription("Demonstrate a Recrusive Iterator")
            ->setHelp("Iterate over a multi-dimensional array using ther RecursiveIteratorIterator");
    }


    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $characters = include '../examples/southparkCharacters.php';

        $output->writeln("Source Array:");
        print_r($characters);

        $output->writeln("Iterator Output");
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($characters));

        foreach ($iterator as $key => $value) {
            $output->writeln($key . " : " . $value);;
        }

        $output->writeln("Done");
        return;

    }

}


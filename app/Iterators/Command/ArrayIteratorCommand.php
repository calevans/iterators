<?php
namespace Iterators\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class ArrayIteratorCommand extends Command
{

    protected function configure()
    {
        $this->setName("arrayIterator")
            ->setDescription("Does something clever.")
            ->setHelp("Demonstrates the use of PHP's built-in ArrayIterator");
    }


    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $fraggles = include '../examples/fraggles.php';
        $arrayIterator = new \ArrayIterator($fraggles);

        // Print the array
        $output->writeln("The array in natural order");
        foreach ($arrayIterator as $thisFraggle) {
            $output->writeln("  " . $thisFraggle);
        }

        // print the array sorted
        $output->writeln("The array in alphabetical order");
        $arrayIterator->asort();
        foreach ($arrayIterator as $thisFraggle) {
            $output->writeln("  " . $thisFraggle);
        }


        // print the array sorted
        $output->writeln("Emprorer First order");
        $arrayIterator->uasort([$this, 'emperorFirst']);

        foreach ($arrayIterator as $thisFraggle) {
            $output->writeln("  " . $thisFraggle);
        }


        $output->writeln("Done");
        return;
    }

    public function emperorFirst($a, $b)
    {
        return (substr($a, 0, 3) == "Emp" ? 0 : 1);
    }
}
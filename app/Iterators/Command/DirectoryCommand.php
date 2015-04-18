<?php
namespace Iterators\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class DirectoryCommand extends Command
{

    protected function configure()
    {

        $definition = [
            new InputOption('directory', 'd', InputOption::VALUE_REQUIRED, 'The direcotry to display.'),
            new InputOption('method', 'm', InputOption::VALUE_REQUIRED,
                'The method to use to iterate over the directory (1|2).')
        ];
        $this->setName("directory")
            ->setDescription("Demonstrate PHP's DirectoryIterator")
            ->setDefinition($definition)
            ->setHelp("Recurse a directory and print out all the files in it and all subdirectories.");

    }


    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {

        $startingPoint = $input->getOption('directory');
        $method = (int)$input->getOption('method');

        $output->writeln("Iterating over " . $startingPoint);

        switch ($method) {

            case 1:
                $this->method1($startingPoint);
                break;

            case 2:
                $this->method2($startingPoint);

        }

        $output->writeln("\nDone");
        return;

    }

    protected function method1($dir, $padLength = 0)
    {
        $thisDir = new \DirectoryIterator($dir);

        foreach ($thisDir as $value) {
            if ($thisDir->isDot()) {
                // Skip the dot directories
                continue;
            } else {
                if ($thisDir->isDir()) {

                    if ($thisDir->isReadable()) {
                        // if this is a new directory AND we have permission to read it, recurse into it.
                        echo str_repeat(' ', $padLength * 2) . $value . "\\\n";
                        $this->method1($dir . '/' . $value, $padLength + 1);
                    }

                } else {
                    // output the file
                    echo str_repeat(' ', $padLength * 2) . $value . "\n";
                }
            }
        }
        return;
    }


    protected function method2($dir, $padLength = 0)
    {

        try {
            $thisDir = new \FilesystemIterator($dir);
        } catch (\UnexpectedValueException $e) {
            return;
        }

        foreach ($thisDir as $value) {

            if ($value->isDir()) {
                echo str_repeat(' ', $padLength * 2) . $value . "\\\n";
                $this->method2($value->getPathname(), $padLength + 1);
            }

            echo str_repeat(' ', $padLength * 2) . $value->getPathname() . "\n";
        }

        return;
    }


}

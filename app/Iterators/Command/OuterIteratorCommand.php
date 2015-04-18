<?PHP
namespace Iterators\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class OuterIteratorCommand extends Command
{

    protected function configure()
    {
        $definition = [new InputOption('filter', 'f', InputOption::VALUE_REQUIRED, 'The letter to check for.')];

        $this->setName("outerIterator")
            ->setDescription("Filters the Seven Dwarfs")
            ->setDefinition($definition)
            ->setHelp("Demonstrates how an Outer Iterator works.");
    }


    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $filter = substr((string)$input->getOption('filter'), 0, 1);
        $dwarves = ['Grumpy ', 'Happy ', 'Sleepy ', 'Bashful ', 'Sneezy ', 'Dopey ', 'Doc '];
        $dwarfIterator = new \Iterators\Classes\DwarfIterator(new \ArrayIterator($dwarves), $filter);

        foreach ($dwarfIterator as $thisDwarf) {
            $output->writeln($thisDwarf);
        } // foreach($dwarfIterator as $thisDwarf)

        $output->writeln("Done");
        return;
    }

}
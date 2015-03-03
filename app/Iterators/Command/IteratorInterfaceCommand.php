<?PHP
namespace Iterators\Command;

use Iterators\Classes\IteratorDemo;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class IteratorInterfaceCommand extends Command
{

    protected function configure()
    {
        $this->setName("iteratorInterface")
		     ->setDescription("Shows a list of the recent committers to PHP")
		     ->setHelp("Demonstrates building a custom Iterator using PHP's built in IteratorInterface");
	}


    protected function execute(InputInterface $input, 
							   OutputInterface $output)
	{
		$iteratableClass = new \Iterators\Classes\IteratorDemo();

		if ($output->getVerbosity()>=OutputInterface::VERBOSITY_VERBOSE) {
    		$iteratableClass->setVerbose(true);
		}

		$output->writeln("Looks like we've got " . count($iteratableClass) . " recent committers.");

		foreach($iteratableClass as $committer) {
			$output->writeln("  Commiter : ".$committer['name'] . ' from ' . $committer['location']);
		} // foreach($iteratableClass as $committer)

		$output->writeln("Done");
		return;
	}

}
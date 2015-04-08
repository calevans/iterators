<?PHP
namespace Iterators\Command;

use Iterators\Classes\PrettyBits;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class BitMathCommand extends Command
{

    protected function configure()
    {
    	   $definition = [
               new InputOption('number', 'u', InputOption::VALUE_REQUIRED, 'The number to display',1024)
    	                 ];

        $this->setName("bitmath")
		     ->setDescription("Displays a 14 bit integer as individual flags")
		     ->setDefinition($definition)
		     ->setHelp("Quick demonstration of how bitmath works. ");
	}


    protected function execute(InputInterface $input, 
							   OutputInterface $output)
	{
		$number = (int)$input->getOption('number');

        PrettyBits::printIt($number);

		$output->writeln("Done");
		return;
	}

}
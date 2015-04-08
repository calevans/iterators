<?PHP
namespace Iterators\Command;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;
use Iterators\Classes\SeekableIterator;

class SeekCommand extends Command
{

    protected function configure()
    {

        $this->setName("seek")
             ->setDescription("Demonstrate PHP's SeekIterator")
             ->setHelp("Runs a simple demo to show how to use PHP's SeekIterator.");
    }


    protected function execute(InputInterface $input, 
                               OutputInterface $output)
    {
        $fraggles = include '../examples/fraggles.php';

        $fraggleIterator = new SeekableIterator($fraggles,false);        

        /*
         * This will nt produce the results you expect.
         */
        for ($lcvA=0;$lcvA<count($fraggleIterator);$lcvA++) {
            $fraggleIterator->seek($lcvA);
            echo $lcvA . " : " . $fraggleIterator->current(). "\n";
        }

        $output->writeln("Done");
        return;

    }

}


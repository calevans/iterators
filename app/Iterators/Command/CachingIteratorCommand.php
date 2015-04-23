<?php
namespace Iterators\Command;

use Iterators\Classes\CustomArrayIterator;
use Iterators\Classes\CustomCachingIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class CachingIteratorCommand extends Command
{

    protected function configure()
    {

        $this->setName("cachingIterator")
            ->setDescription("Output the seven dwarfs in CSV format.")
            ->setHelp("Demonstrates how a Caching Iterator works.");
    }


    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $dwarves = [
            1 => 'Grumpy',
            2 => 'Happy',
            3 => 'Sleepy',
            4 => 'Bashful',
            5 => 'Sneezy',
            6 => 'Dopey',
            7 => 'Doc'
        ];
        $output->writeln('Look ahead exampe. Build a CSV the hard way.');

        $dwarfIterator = new \ArrayIterator($dwarves);
        $cachingDwarfIterator = new \CachingIterator($dwarfIterator);
        $dwarfListOutput = '';

        foreach ($cachingDwarfIterator as $thisDwarf) {
            $dwarfListOutput .= $thisDwarf;

            if ($cachingDwarfIterator->hasNext()) {
                $dwarfListOutput .= ',';
            }

        } // foreach($dwarfIterator as $thisDwarf)

        $output->writeln($dwarfListOutput);
        $output->writeln(' ');

        $dwarfIterator = null;
        $cachingDwarfIterator = null;


        $output->writeln('Set the TOSTRING_USE_KEY flag');
        $dwarfIterator = new \ArrayIterator($dwarves);
        $cachingDwarfIterator = new \CachingIterator($dwarfIterator, \CachingIterator::TOSTRING_USE_KEY);

        foreach ($cachingDwarfIterator as $key => $thisDwarf) {
            var_dump((string)$cachingDwarfIterator);
            echo "\n";
        } // foreach($dwarfIterator as $thisDwarf)

        $dwarfIterator = null;
        $cachingDwarfIterator = null;

        $output->writeln(' ');
        $output->writeln('Setting the TOSTRING_USE_CURRENT flag');

        $dwarfIterator = new \ArrayIterator($dwarves);
        $cachingDwarfIterator = new \CachingIterator($dwarfIterator, \CachingIterator::TOSTRING_USE_CURRENT);

        foreach ($cachingDwarfIterator as $key => $thisDwarf) {
            var_dump((string)$cachingDwarfIterator);
            echo "\n";
        } // foreach($dwarfIterator as $thisDwarf)


        $output->writeln(' ');
        $output->writeln('Setting the TOSTRING_USE_INNER flag');

        $dwarfIterator = new CustomArrayIterator($dwarves);
        $cachingDwarfIterator = new \CachingIterator($dwarfIterator, \CachingIterator::TOSTRING_USE_INNER);

        foreach ($cachingDwarfIterator as $key => $thisDwarf) {
            var_dump((string)$cachingDwarfIterator);
            echo "\n";
        } // foreach($dwarfIterator as $thisDwarf)


        $output->writeln(' ');
        $output->writeln('Setting the FULL_CACHE flag');
        $dwarfIterator = new \ArrayIterator($dwarves);
        $cachingDwarfIterator = new CustomCachingIterator($dwarfIterator, \CachingIterator::FULL_CACHE);

        // Load the cache;
        foreach ($cachingDwarfIterator as $thisDwarf) {
        };

        $cachingDwarfIterator->removeBashful();

        $output->writeln(' ');
        $output->writeln('  Cached');

        foreach ($cachingDwarfIterator->getCache() as $key => $thisDwarf) {
            $output->writeln($key . " : " . $thisDwarf);
        } // foreach($dwarfIterator as $thisDwarf)

        $output->writeln(' ');
        $output->writeln('  This is the original iterator');
        foreach ($cachingDwarfIterator as $key => $thisDwarf) {
            $output->writeln($key . " - " . $thisDwarf);
        } // foreach($dwarfIterator as $thisDwarf)


        $output->writeln(' ');
        $output->writeln("  Now that we've modified an element, \n  let's modify an element");

        $dwarfIterator = new \ArrayIterator($dwarves);
        $cachingDwarfIterator = new \CachingIterator($dwarfIterator, \CachingIterator::FULL_CACHE);
        // Load the cache;
        foreach ($cachingDwarfIterator as $thisDwarf) {
        };

        $cachingDwarfIterator[5] = 'Surley';

        $output->writeln(' ');
        $output->writeln('  Now let\'s out the inner cache');
        foreach ($cachingDwarfIterator->getCache() as $key => $thisDwarf) {
            $output->writeln($key . " : " . $thisDwarf);
        } // foreach($dwarfIterator as $thisDwarf)


        $output->writeln("Done");
        return;
    }

}

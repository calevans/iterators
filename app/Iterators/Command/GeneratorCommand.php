<?php
namespace Iterators\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class GeneratorCommand extends Command
{

    protected function configure()
    {

        $this->setName("generator")
            ->setDescription("Use PHP's Generator to output recent contributors to the core.")
            ->setHelp("Demonstrates how a Generator works.");
    }


    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        \Guzzle\Http\StaticClient::mount();

        $commits = \Guzzle::get('https://api.github.com/repos/php/php-src/commits')->json();
        $commitGenerator = $this->gatherCommits($commits, $output->getVerbosity());

        /*
         * If the verbose flag is passed, prove that generators are an object.
         */
        if ($output->getVerbosity() === OutputInterface::VERBOSITY_DEBUG) {
            print_r($commitGenerator);
            print_r(class_implements($commitGenerator));
            $output->writeln("Done");
            return;
        }

        foreach ($commitGenerator as $thisCommit) {
            echo $thisCommit['committer']['name'] . " : " . $thisCommit['committer']['location'] . "\n";
        }

        $output->writeln("Done");
        return;
    }


    protected function gatherCommits($gatheredComits, $verbosity)
    {
        $committers = [];

        foreach ($gatheredComits as $thisCommit) {

            if (!isset($committers[$thisCommit['author']['id']])) {
                $committers[$thisCommit['author']['id']] = \Guzzle::get('https://api.github.com/user/' . $thisCommit['author']['id'])->json();
            }

            $payload = ['commit' => $thisCommit, 'committer' => $committers[$thisCommit['author']['id']]];

            if ($verbosity === OutputInterface::VERBOSITY_VERBOSE) {
                echo "Pre Yeild\n";
            }

            yield $payload;

            if ($verbosity === OutputInterface::VERBOSITY_VERBOSE) {
                echo "Post Yeild\n";
            }

        }
    }
}


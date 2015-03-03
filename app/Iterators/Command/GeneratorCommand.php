<?PHP
namespace Iterators\Command;

use Iterators\Classes\OuterIteratorDemo;
use Iterators\Classes\CustomCachingIterator;
use Iterators\Classes\CustomArrayIterator;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface as InputInterface;
use Symfony\Component\Console\Output\OutputInterface as OutputInterface;

class GeneratorCommand extends Command
{
    protected $commits    = [];
    protected $committers = [];

    protected function configure()
    {

        $this->setName("generator")
             ->setDescription("Use PHP's Generator to output recent contributors to the core.")
             ->setHelp("Demonstrates how a Generator works.");
    }


    protected function execute(InputInterface $input, 
                               OutputInterface $output)
    {
        \Guzzle\Http\StaticClient::mount();

        $this->commits = \Guzzle::get('https://api.github.com/repos/php/php-src/commits')->json();
        $commitGenerator = $this->gatherCommits();
print_r($commitGenerator);
die();
        foreach( $commitGenerator as $thisCommit) {
            echo $thisCommit['committer']['name'] . " : " . $thisCommit['committer']['location'] . "\n" . $thisCommit['commit']['commit']['message'] ."\n\n";
        }

        $output->writeln("Done");
        return;
    }



    protected function gatherCommits()
    {
        $committers = [];

        foreach($this->commits as $thisCommit) {

            if (!isset($committers[$thisCommit['author']['id']])) {
              $committers[$thisCommit['author']['id']] = $this->getAuthor($thisCommit['author']['id']);
            }

            $payload = ['commit' =>$thisCommit,'committer'=>$committers[$thisCommit['author']['id']]];

            yield $payload;
        }
    }


    protected function getAuthor($id)
    {
        return \Guzzle::get('https://api.github.com/user/'.$id)->json();
    }
}

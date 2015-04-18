<?php
namespace Iterators\Classes;

class IteratorDemo implements \Iterator, \Countable
{

    protected $committers = [];
    protected $verbose = false;
    protected $pointer = -1;

    public function __construct()
    {
        \Guzzle\Http\StaticClient::mount();
        $this->populate();
        $this->rewind();
        return;
    }


    public function count()
    {
        if ($this->verbose) {
            echo "-- Count\n";
        }
        return count($this->committers);
    }


    public function key()
    {
        if ($this->verbose) {
            echo "-- Key\n";
        }
        return $this->pointer;
    }


    public function next()
    {
        if ($this->verbose) {
            echo "-- Next\n";
        }
        $this->pointer++;
        if ($this->valid()) {
            $this->committers[$this->pointer]['location'] = $this->fetchLocation($this->pointer);
        }

        return;
    }


    public function rewind()
    {
        if ($this->verbose) {
            echo "-- Rewind\n";
        }
        $this->pointer = 0;

        if (count($this->committers) > 0) {
            $this->committers[$this->pointer]['location'] = $this->fetchLocation($this->pointer);
        }

        return;
    }


    public function valid()
    {
        if ($this->verbose) {
            echo "-- Valid\n";
        }

        return isset($this->committers[$this->pointer]);
    }


    public function current()
    {
        if ($this->verbose) {
            echo "-- Current\n";
        }
        return $this->committers[$this->pointer];
    }


    /*
     * These are not part of the IteratorInterface.
     */
    protected function checkCommiters($email)
    {
        if ($this->verbose) {
            echo "-- Check Committers\n";
        }
        $returnValue = false;
        foreach ($this->committers as $commiter) {
            if ($commiter['email'] === $email) {
                $returnValue = true;
                break;
            }
        }

        return $returnValue;

    }


    protected function populate()
    {
        if ($this->verbose) {
            echo "-- Populate\n";
        }

        $response = \Guzzle::get('https://api.github.com/repos/php/php-src/commits');
        $commits = $response->json();

        foreach ($commits as $thisCommit) {
            if (!$this->checkCommiters($thisCommit['commit']['author']['email'])) {
                $user = [
                    'email' => $thisCommit['commit']['author']['email'],
                    'name' => $thisCommit['commit']['author']['name']
                ];

                if (is_array($thisCommit['author'])) {
                    $user['id'] = $thisCommit['author']['id'];
                }

                $this->committers[] = $user;
            }
        }
        return;
    }


    protected function fetchLocation($pointer)
    {
        if ($this->verbose) {
            echo "-- Fetch Location\n";
        }
        $returnValue = '';
        if (empty($this->committers[$pointer]['id'])) {
            return 'Unknown';
        }

        if (!isset($this->committers[$pointer]['location'])) {
            $response = \Guzzle::get('https://api.github.com/user/' . $this->committers[$pointer]['id']);
            $githubUser = $response->json();
            $returnValue = $githubUser['location'];
        } else {
            $returnValue = $this->committers[$pointer]['location'];
        }
        return $returnValue;
    }


    public function setVerbose($newValue = false)
    {
        $this->verbose = (bool)$newValue;
        return;
    }

}
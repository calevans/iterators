<?php
namespace Iterators\Classes;

class FizzBuzz implements \Iterator
{
    protected $pointer = 0;
    protected $numbers = [];

    public function __construct($numbers = [])
    {
        $this->numbers = $numbers;
        return;
    }

    public function current()
    {
        $returnValue = '';
        $returnValue .= ($this->numbers[$this->pointer] % 3 === 0 ? 'Fizz' : '');
        $returnValue .= ($this->numbers[$this->pointer] % 5 === 0 ? 'Buzz' : '');
        $returnValue = (empty($returnValue) ? $this->numbers[$this->pointer] : $returnValue);
        return $returnValue;
    }

    public function key()
    {
        return $this->pointer;
    }


    public function next()
    {
        $this->pointer++;
        return;
    }


    public function rewind()
    {
        $this->pointer = 0;
        return;
    }


    public function valid()
    {
        return isset($this->numbers[$this->pointer]);
    }

}
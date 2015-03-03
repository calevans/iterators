<?php

namespace Iterators\Classes;

class CustomArrayIterator extends \ArrayIterator
{
    public function __toString()
    {
        return $this->key() . ' - ' . $this->current();
    }

}

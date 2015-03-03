<?php

namespace Iterators\Classes;

class CustomCachingIterator extends \CachingIterator
{

    public function removeBashful()
    {
        $this->offsetUnset(4);

        return;
    }

}

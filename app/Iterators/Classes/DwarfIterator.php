<?PHP
namespace Iterators\Classes;

class DwarfIterator extends \FilterIterator
{
    protected $filter = '';

    public function __construct($innerIterator, $filter = " ")
    {
        parent::__construct($innerIterator);
        $this->filter = $filter;
        return;
    }

    public function accept()
    {
        return (strpos($this->getInnerIterator()->current(), $this->filter) !== false);
    }

}
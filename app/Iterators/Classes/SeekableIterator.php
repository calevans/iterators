<?PHP
namespace Iterators\Classes;

class SeekableIterator implements  \Iterator, \Countable
{
	
	protected $data = [];
	protected $verbose    = false;
	protected $pointer    = -1;

	function __construct($data,$verbose=false) 
	{
		$this->setVerbose($verbose);
		$this->data=$data;
	}


	public function count()
	{
		if ($this->verbose) {
			echo "-- Count\n";
		}
		return count($this->data);
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
		
		return;
	}


	public function rewind()
	{
		if ($this->verbose) {
			echo "-- Rewind\n";
		}
		$this->pointer=0;

		return;
	}


	public function valid()
	{
		if ($this->verbose) {
			echo "-- Valid\n";
		}

		return isset($this->data[$this->pointer]);
	}


	public function current()
	{
		if ($this->verbose) {
			echo "-- Current\n";
		}
		return $this->data[$this->pointer];
	}


	public function seek($position) 
	{

		$position = rand(0,count($this->data)-1);

		if (!isset($this->data[$position])) {
		  throw new OutOfBoundsException("invalid seek position ($pointer)");
		}

		$this->pointer = $position;

		return;
	}

	/*
	 * Not part of the Seekable interface
	 */
	public function setVerbose($newValue=false)
	{
		$this->verbose = (bool)$newValue;
		return;
	}

}
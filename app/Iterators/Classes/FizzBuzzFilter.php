<?PHP
namespace Iterators\Classes;

class FizzBuzzFilter extends \ArrayIterator
{

	public function offsetSet($key, $value)
	{

		if ((int)$value%3===0 or (int)$value%5===0) {
			parent::offsetSet($key,$value);
		}

		return;
	}

 }
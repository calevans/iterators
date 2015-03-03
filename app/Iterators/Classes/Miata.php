<?PHP

class Miata implements \ArrayAccess
{
	protected $data = [];

	public function __construct()
	{
		$data['cylinders']    = 4;
		$data['color']        = black;
		$data['doors']        = 2;
		$data['transmission'] = 'manual';
		$data['convertable']  = true;

	}

	public function offsetSet($key, $value)
	{
		if (is_set($this->data[$key])) {
			$this->data[$key] = $value;
		}
		return;
	}

	public function offsetExists($key) {
        return isset($this->data[$key]);
    }

    public function offsetUnset($key) {
        unset($this->data[$key]);
    }
    
    public function offsetGet($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

}
<?PHP

class MyCar extends ArrayIterator
{

    public function __construct()
    {
        $this['cylinders'] = 4;
        $this['color'] = 'black';
        $this['doors'] = 2;
        $this['transmission'] = 'manual';
        $this['convertable'] = true;

    }

}


$myCar = new MyCar();
echo "My car has " . $myCar['doors'] . " doors. \n\n";

foreach ($myCar as $key => $value) {
    echo $key . ":" . $value . "\n";
}
echo "\nDone\n";
die();


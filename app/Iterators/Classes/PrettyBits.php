<?PHP
namespace Iterators\Classes;

class PrettyBits 
{

    public static function printIt($number)
    {
        PrettyBits::printTableEnd();
        PrettyBits::printTableLegend();
        PrettyBits::printTableEnd();
        PrettyBits::printTableLine($number);
        PrettyBits::printTableEnd();
        return;
    }

    public static function printTableEnd()
    {
        echo "        +----|----|----|----|----|----|----|----|----|----|----|----|----|----+\n";
        return;
    }

    public static function printTableLegend()
    {
        echo " Number +   1|   2|   4|   8|  16|  32|  64| 128| 256| 512|1024|2048|4096|8192+\n";
        return;
    }

    public static function printTableLine($number)
    {

        $output = str_pad($number,7, ' ',STR_PAD_LEFT);
        $output .= ' ';
        
        $binary = str_pad(strrev(decbin($number)),14,'0');

        for($lcvA=0; $lcvA<strlen($binary);$lcvA++) {
            $output .= '|' . str_pad($binary[$lcvA],4,' ',STR_PAD_LEFT);
        }

        $output .= '|';
        echo $output ."\n";
        return;
    }
}
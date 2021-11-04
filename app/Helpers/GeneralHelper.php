<?php 
namespace App\Helpers;

class GeneralHelper {
    /**
     * Convert normal number into money format xx.xxx,xx
     * @param string
     * @return string
     */
    public static function moneyFormat($number) {
        return number_format($number,0,',','.');
    }
}

?>
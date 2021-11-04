<?php 
namespace App\Helpers;

class GeneralHelper {
    public static function moneyFormat($number) {
        return number_format($number,0,',','.');
    }
}

?>
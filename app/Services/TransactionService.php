<?php 
namespace App\Services;

use App\Utils\Constant;

class TransactionService {
    public static function generateTransactionNumber($id, $type) {
        $number = $id;
        return 'W'.$type.str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}

?>
<?php 
namespace App\Helpers;

use App\Models\WalletStatus;

class SelectHelper {
    
    public static function getWalletStatus() {
        return WalletStatus::all();
    }

}

?>
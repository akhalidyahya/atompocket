<?php 
namespace App\Helpers;

use App\Models\CategoryStatus;
use App\Models\WalletStatus;

class SelectHelper {
    
    public static function getWalletStatus() {
        return WalletStatus::all();
    }

    public static function getCategoryStatus() {
        return CategoryStatus::all();
    }

}

?>
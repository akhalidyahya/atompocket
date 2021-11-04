<?php 
namespace App\Helpers;

use App\Models\Category;
use App\Models\CategoryStatus;
use App\Models\Wallet;
use App\Models\WalletStatus;

class SelectHelper {
    
    public static function getWalletStatus() {
        return WalletStatus::all();
    }

    public static function getCategoryStatus() {
        return CategoryStatus::all();
    }

    public static function getCategories() {
        return Category::where('status_id',1)->orderBy('name','asc')->get();
    }

    public static function getWallets() {
        return Wallet::where('wallet_status_id',1)->orderBy('name','asc')->get();
    }

}

?>
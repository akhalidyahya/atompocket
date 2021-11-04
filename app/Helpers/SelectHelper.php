<?php 
namespace App\Helpers;

use App\Models\Category;
use App\Models\CategoryStatus;
use App\Models\TransactionStatus;
use App\Models\Wallet;
use App\Models\WalletStatus;

class SelectHelper {
    
    /**
     * Function to get all dompet status
     * @return WalletStatus
     */
    public static function getWalletStatus() {
        return WalletStatus::all();
    }

    /**
     * Function to get all kategori status
     * @return CategoryStatus
     */
    public static function getCategoryStatus() {
        return CategoryStatus::all();
    }

    /**
     * Function to get all kategori where active and ordered by name ascending
     * @return Category
     */
    public static function getCategories() {
        return Category::where('status_id',1)->orderBy('name','asc')->get();
    }

    /**
     * Function to get all wallet where active and ordered by name ascending
     * @return Wallet
     */
    public static function getWallets() {
        return Wallet::where('wallet_status_id',1)->orderBy('name','asc')->get();
    }

    /**
     * Function to get all transaksi status
     * @return TransactionStatus
     */
    public static function getTransactionType() {
        return TransactionStatus::all();
    }

}

?>
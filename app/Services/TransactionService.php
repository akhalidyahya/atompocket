<?php 
namespace App\Services;

use App\Utilities\Constants;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionService {
    public static function isAdmin() {
        if(Auth::user()->role == Constants::ROLE_ADMIN) {
            return true;
        } else {
            return false;
        }
    }

    public static function isTryOutOnGoing($start_time,$end_time) {
        if($start_time < Date('Y-m-d H:i') && $end_time > Date('Y-m-d H:i')) {
            return true;
        }
        return false;
    }

    public static function isTryOutComingSoon($start_time,$end_time) {
        if($start_time > Date('Y-m-d H:i')) {
            return true;
        }
        return false;
    }

    public static function isTryOutOnGoingOrDone($start_time) {
        if($start_time < Date('Y-m-d H:i')) {
            return true;
        }
        return false;
    }

    public static function isTryoutDone($end_time) {
        if($end_time < Date('Y-m-d H:i')) {
            return true;
        }
        return false;
    }

    public static function isTryOutTimeOut($type,$start_time) {
        if($start_time == NULL ){
            return false;
        }
        if($type == Constants::QUESTION_TYPE_TBI) {
            $minutes = Constants::TBI_TIME;
        } else {
            $minutes = Constants::TPA_TIME;
        }
        if(Carbon::parse($start_time)->addMinutes($minutes) <= Carbon::now()) {
            return true;
        }
        return false;
    }

    public static function censorName($name) {
        if(empty($name)) {
            return '';
        }
        $name_array = explode(' ',$name);
        $new = [];
        foreach($name_array as $name_string) {
            $chars = floor(strlen($name_string)/2);
            $replace = '';
            for ($i=0; $i < $chars; $i++) { 
                $replace .= '*';
            }
            $new[] = substr_replace($name_string,$replace,$chars);
        }
        return implode(' ',$new);
    }

    public static function censorNumber($number) {
        if(empty($number)) {
            return '';
        }
        $chars = floor(strlen($number)/2);
        $replace = '';
        for ($i=0; $i < $chars; $i++) { 
            $replace .= '*';
        }
        return substr_replace($number,$replace,$chars);
    }

}

?>